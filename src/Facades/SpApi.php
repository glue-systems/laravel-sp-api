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
 * @method static static aplusContentV20201101() Set target API to `\Glue\SpApi\OpenAPI\Clients\AplusContentV20201101\Api\AplusContentApi`
 * @method static static authorizationV1() Set target API to `\Glue\SpApi\OpenAPI\Clients\AuthorizationV1\Api\AuthorizationApi`
 * @method static static catalogItemsV0() Set target API to `\Glue\SpApi\OpenAPI\Clients\CatalogItemsV0\Api\CatalogApi`
 * @method static static catalogItemsV20201201() Set target API to `\Glue\SpApi\OpenAPI\Clients\CatalogItemsV20201201\Api\CatalogApi`
 * @method static static definitionsProductTypesV20200901() Set target API to `\Glue\SpApi\OpenAPI\Clients\DefinitionsProductTypesV20200901\Api\DefinitionsApi`
 * @method static static easyShipV20220323() Set target API to `\Glue\SpApi\OpenAPI\Clients\EasyShipV20220323\Api\EasyShipApi`
 * @method static static fbaInboundEligibilityV1() Set target API to `\Glue\SpApi\OpenAPI\Clients\FbaInboundEligibilityV1\Api\FbaInboundApi`
 * @method static static fbaInventoryV1() Set target API to `\Glue\SpApi\OpenAPI\Clients\FbaInventoryV1\Api\FbaInventoryApi`
 * @method static static fbaSmallAndLightV1() Set target API to `\Glue\SpApi\OpenAPI\Clients\FbaSmallAndLightV1\Api\SmallAndLightApi`
 * @method static static feedsV20200904() Set target API to `\Glue\SpApi\OpenAPI\Clients\FeedsV20200904\Api\FeedsApi`
 * @method static static feedsV20210630() Set target API to `\Glue\SpApi\OpenAPI\Clients\FeedsV20210630\Api\FeedsApi`
 * @method static static financesV0() Set target API to `\Glue\SpApi\OpenAPI\Clients\FinancesV0\Api\DefaultApi`
 * @method static static fulfillmentInboundV0() Set target API to `\Glue\SpApi\OpenAPI\Clients\FulfillmentInboundV0\Api\FbaInboundApi`
 * @method static static fulfillmentOutboundV20200701() Set target API to `\Glue\SpApi\OpenAPI\Clients\FulfillmentOutboundV20200701\Api\FbaOutboundApi`
 * @method static static listingsItemsV20200901() Set target API to `\Glue\SpApi\OpenAPI\Clients\ListingsItemsV20200901\Api\ListingsApi`
 * @method static static listingsItemsV20210801() Set target API to `\Glue\SpApi\OpenAPI\Clients\ListingsItemsV20210801\Api\ListingsApi`
 * @method static static listingsRestrictionsV20210801() Set target API to `\Glue\SpApi\OpenAPI\Clients\ListingsRestrictionsV20210801\Api\ListingsApi`
 * @method static static merchantFulfillmentV0() Set target API to `\Glue\SpApi\OpenAPI\Clients\MerchantFulfillmentV0\Api\MerchantFulfillmentApi`
 * @method static static notificationsV1() Set target API to `\Glue\SpApi\OpenAPI\Clients\NotificationsV1\Api\NotificationsApi`
 * @method static static ordersV0() Set target API to `\Glue\SpApi\OpenAPI\Clients\OrdersV0\Api\OrdersV0Api`
 * @method static static ordersV0Shipment() Set target API to `\Glue\SpApi\OpenAPI\Clients\OrdersV0\Api\ShipmentApi`
 * @method static static productFeesV0() Set target API to `\Glue\SpApi\OpenAPI\Clients\ProductFeesV0\Api\FeesApi`
 * @method static static productPricingV0() Set target API to `\Glue\SpApi\OpenAPI\Clients\ProductPricingV0\Api\ProductPricingApi`
 * @method static static replenishmentV20221107Offers() Set target API to `\Glue\SpApi\OpenAPI\Clients\ReplenishmentV20221107\Api\OffersApi`
 * @method static static replenishmentV20221107Sellingpartners() Set target API to `\Glue\SpApi\OpenAPI\Clients\ReplenishmentV20221107\Api\SellingpartnersApi`
 * @method static static reportsV20200904() Set target API to `\Glue\SpApi\OpenAPI\Clients\ReportsV20200904\Api\ReportsApi`
 * @method static static reportsV20210630() Set target API to `\Glue\SpApi\OpenAPI\Clients\ReportsV20210630\Api\ReportsApi`
 * @method static static salesV1() Set target API to `\Glue\SpApi\OpenAPI\Clients\SalesV1\Api\SalesApi`
 * @method static static sellersV1() Set target API to `\Glue\SpApi\OpenAPI\Clients\SellersV1\Api\SellersApi`
 * @method static static servicesV1() Set target API to `\Glue\SpApi\OpenAPI\Clients\ServicesV1\Api\ServiceApi`
 * @method static static shipmentInvoicingV0() Set target API to `\Glue\SpApi\OpenAPI\Clients\ShipmentInvoicingV0\Api\ShipmentInvoiceApi`
 * @method static static supplySourcesV20200701() Set target API to `\Glue\SpApi\OpenAPI\Clients\SupplySourcesV20200701\Api\SupplySourcesApi`
 * @method static static tokensV20210301() Set target API to `\Glue\SpApi\OpenAPI\Clients\TokensV20210301\Api\TokensApi`
 * @method static static uploadsV20201101() Set target API to `\Glue\SpApi\OpenAPI\Clients\UploadsV20201101\Api\UploadsApi`
 * @method static static vendorDirectFulfillmentInventoryV1() Set target API to `\Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentInventoryV1\Api\UpdateInventoryApi`
 * @method static static vendorDirectFulfillmentOrdersV1() Set target API to `\Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentOrdersV1\Api\VendorOrdersApi`
 * @method static static vendorDirectFulfillmentOrdersV20211228() Set target API to `\Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentOrdersV20211228\Api\VendorOrdersApi`
 * @method static static vendorDirectFulfillmentPaymentsV1() Set target API to `\Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentPaymentsV1\Api\VendorInvoiceApi`
 * @method static static vendorDirectFulfillmentSandboxDataV20211228() Set target API to `\Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentSandboxDataV20211228\Api\VendorDFSandboxApi`
 * @method static static vendorDirectFulfillmentSandboxDataV20211228transactionstatus() Set target API to `\Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentSandboxDataV20211228\Api\VendorDFSandboxtransactionstatusApi`
 * @method static static vendorDirectFulfillmentShippingV1CustomerInvoices() Set target API to `\Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentShippingV1\Api\CustomerInvoicesApi`
 * @method static static vendorDirectFulfillmentShippingV1() Set target API to `\Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentShippingV1\Api\VendorShippingApi`
 * @method static static vendorDirectFulfillmentShippingV1Labels() Set target API to `\Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentShippingV1\Api\VendorShippingLabelsApi`
 * @method static static vendorDirectFulfillmentShippingV20211228CustomerInvoices() Set target API to `\Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentShippingV20211228\Api\CustomerInvoicesApi`
 * @method static static vendorDirectFulfillmentShippingV20211228() Set target API to `\Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentShippingV20211228\Api\VendorShippingApi`
 * @method static static vendorDirectFulfillmentShippingV20211228Labels() Set target API to `\Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentShippingV20211228\Api\VendorShippingLabelsApi`
 * @method static static vendorDirectFulfillmentTransactionsV1() Set target API to `\Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentTransactionsV1\Api\VendorTransactionApi`
 * @method static static vendorDirectFulfillmentTransactionsV20211228() Set target API to `\Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentTransactionsV20211228\Api\VendorTransactionApi`
 * @method static static vendorTransactionStatusV1() Set target API to `\Glue\SpApi\OpenAPI\Clients\VendorTransactionStatusV1\Api\VendorTransactionApi`
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
