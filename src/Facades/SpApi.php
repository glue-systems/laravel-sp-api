<?php

namespace Glue\SpApi\Laravel\Facades;

use Exception;
use Glue\SpApi\OpenAPI\Clients\TokensV20210301\Model\CreateRestrictedDataTokenRequest;
use Glue\SpApi\OpenAPI\Configuration\SpApiConfig;
use Glue\SpApi\OpenAPI\Utilities\SpApiRoster;
use Glue\SpApi\OpenAPI\Exceptions\DomainApiException;
use Illuminate\Support\Facades\Facade;

/**
 * @method static SpApiConfig getSpApiConfig() Get the global SP-API config object.
 * @method static mixed execute(callable $callback)
 * @method static static withRdtRequest(CreateRestrictedDataTokenRequest $rdtRequest) Set a Restricted Data Token (RDT) request to be used for this SP-API execution.
 * @method static static pushBuilderMiddleware(callable $middleware, string|null $name) Push a middleware that will be applied to the ClientBuilder instance that is used to construct the SP-API client.
 * @method static static buildUsing(callable $builderCallback, string|null $name) Add a callback to modify the ClientBuilder instance that is used to construct the SP-API client. This is simply a quicker way to push a new builder middleware onto the pipeline without needing to manage the `next` callback.
 * @method static static aplusContentV20201101()
 * @method static static authorizationV1()
 * @method static static catalogItemsV0()
 * @method static static catalogItemsV20201201()
 * @method static static definitionsProductTypesV20200901()
 * @method static static easyShipV20220323()
 * @method static static fbaInboundEligibilityV1()
 * @method static static fbaInventoryV1()
 * @method static static fbaSmallAndLightV1()
 * @method static static feedsV20200904()
 * @method static static feedsV20210630()
 * @method static static financesV0()
 * @method static static fulfillmentInboundV0()
 * @method static static fulfillmentOutboundV20200701()
 * @method static static listingsItemsV20200901()
 * @method static static listingsItemsV20210801()
 * @method static static listingsRestrictionsV20210801()
 * @method static static merchantFulfillmentV0()
 * @method static static notificationsV1()
 * @method static static ordersV0()
 * @method static static ordersV0Shipment()
 * @method static static productFeesV0()
 * @method static static productPricingV0()
 * @method static static replenishmentV20221107Offers()
 * @method static static replenishmentV20221107Sellingpartners()
 * @method static static reportsV20200904()
 * @method static static reportsV20210630()
 * @method static static salesV1()
 * @method static static sellersV1()
 * @method static static servicesV1()
 * @method static static shipmentInvoicingV0()
 * @method static static supplySourcesV20200701()
 * @method static static tokensV20210301()
 * @method static static uploadsV20201101()
 * @method static static vendorDirectFulfillmentInventoryV1()
 * @method static static vendorDirectFulfillmentOrdersV1()
 * @method static static vendorDirectFulfillmentOrdersV20211228()
 * @method static static vendorDirectFulfillmentPaymentsV1()
 * @method static static vendorDirectFulfillmentSandboxDataV20211228()
 * @method static static vendorDirectFulfillmentSandboxDataV20211228transactionstatus()
 * @method static static vendorDirectFulfillmentShippingV1CustomerInvoices()
 * @method static static vendorDirectFulfillmentShippingV1()
 * @method static static vendorDirectFulfillmentShippingV1Labels()
 * @method static static vendorDirectFulfillmentShippingV20211228CustomerInvoices()
 * @method static static vendorDirectFulfillmentShippingV20211228()
 * @method static static vendorDirectFulfillmentShippingV20211228Labels()
 * @method static static vendorDirectFulfillmentTransactionsV1()
 * @method static static vendorDirectFulfillmentTransactionsV20211228()
 * @method static static vendorTransactionStatusV1()
 */
class SpApi extends Facade
{
    public static function fake()
    {
        static::createFreshMockInstance();
    }

    public static function shouldExecuteProviding($valueToProvideToCallback)
    {
        return static::shouldReceive('execute')
            ->andReturnUsing(function ($receivedCallbackArgument) use ($valueToProvideToCallback) {
                try {
                    $callbackReturnValue = $receivedCallbackArgument($valueToProvideToCallback);
                    return $callbackReturnValue;
                } catch (Exception $ex) {
                    if (SpApiRoster::isApiException($ex)) {
                        throw new DomainApiException($ex);
                    }
                    throw $ex;
                }
            });
    }

    public static function shouldExecuteAndThrow(
        $exception,
        $message = '',
        $code = 0,
        Exception $previous = null
    ) {
        return static::shouldReceive('execute')
            ->andThrow($exception, $message, $code, $previous);
    }

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Glue\SpApi\Laravel\Utilities\SpApi::class;
    }
}
