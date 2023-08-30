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
 * @method static static aplusContentV20201101() Set target API to `\Glue\SpApi\OpenAPI\Clients\AplusContentV20201101\Api\AplusContentApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (AplusContentApi $apiClient) { ... })`)
 * @method static static authorizationV1() Set target API to `\Glue\SpApi\OpenAPI\Clients\AuthorizationV1\Api\AuthorizationApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (AuthorizationApi $apiClient) { ... })`)
 * @method static static catalogItemsV0() Set target API to `\Glue\SpApi\OpenAPI\Clients\CatalogItemsV0\Api\CatalogApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (CatalogApi $apiClient) { ... })`)
 * @method static static catalogItemsV20201201() Set target API to `\Glue\SpApi\OpenAPI\Clients\CatalogItemsV20201201\Api\CatalogApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (CatalogApi $apiClient) { ... })`)
 * @method static static definitionsProductTypesV20200901() Set target API to `\Glue\SpApi\OpenAPI\Clients\DefinitionsProductTypesV20200901\Api\DefinitionsApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (DefinitionsApi $apiClient) { ... })`)
 * @method static static easyShipV20220323() Set target API to `\Glue\SpApi\OpenAPI\Clients\EasyShipV20220323\Api\EasyShipApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (EasyShipApi $apiClient) { ... })`)
 * @method static static fbaInboundEligibilityV1() Set target API to `\Glue\SpApi\OpenAPI\Clients\FbaInboundEligibilityV1\Api\FbaInboundApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (FbaInboundApi $apiClient) { ... })`)
 * @method static static fbaInventoryV1() Set target API to `\Glue\SpApi\OpenAPI\Clients\FbaInventoryV1\Api\FbaInventoryApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (FbaInventoryApi $apiClient) { ... })`)
 * @method static static fbaSmallAndLightV1() Set target API to `\Glue\SpApi\OpenAPI\Clients\FbaSmallAndLightV1\Api\SmallAndLightApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (SmallAndLightApi $apiClient) { ... })`)
 * @method static static feedsV20200904() Set target API to `\Glue\SpApi\OpenAPI\Clients\FeedsV20200904\Api\FeedsApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (FeedsApi $apiClient) { ... })`)
 * @method static static feedsV20210630() Set target API to `\Glue\SpApi\OpenAPI\Clients\FeedsV20210630\Api\FeedsApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (FeedsApi $apiClient) { ... })`)
 * @method static static financesV0() Set target API to `\Glue\SpApi\OpenAPI\Clients\FinancesV0\Api\DefaultApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (DefaultApi $apiClient) { ... })`)
 * @method static static fulfillmentInboundV0() Set target API to `\Glue\SpApi\OpenAPI\Clients\FulfillmentInboundV0\Api\FbaInboundApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (FbaInboundApi $apiClient) { ... })`)
 * @method static static fulfillmentOutboundV20200701() Set target API to `\Glue\SpApi\OpenAPI\Clients\FulfillmentOutboundV20200701\Api\FbaOutboundApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (FbaOutboundApi $apiClient) { ... })`)
 * @method static static listingsItemsV20200901() Set target API to `\Glue\SpApi\OpenAPI\Clients\ListingsItemsV20200901\Api\ListingsApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (ListingsApi $apiClient) { ... })`)
 * @method static static listingsItemsV20210801() Set target API to `\Glue\SpApi\OpenAPI\Clients\ListingsItemsV20210801\Api\ListingsApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (ListingsApi $apiClient) { ... })`)
 * @method static static listingsRestrictionsV20210801() Set target API to `\Glue\SpApi\OpenAPI\Clients\ListingsRestrictionsV20210801\Api\ListingsApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (ListingsApi $apiClient) { ... })`)
 * @method static static merchantFulfillmentV0() Set target API to `\Glue\SpApi\OpenAPI\Clients\MerchantFulfillmentV0\Api\MerchantFulfillmentApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (MerchantFulfillmentApi $apiClient) { ... })`)
 * @method static static notificationsV1() Set target API to `\Glue\SpApi\OpenAPI\Clients\NotificationsV1\Api\NotificationsApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (NotificationsApi $apiClient) { ... })`)
 * @method static static ordersV0() Set target API to `\Glue\SpApi\OpenAPI\Clients\OrdersV0\Api\OrdersV0Api`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (OrdersV0Api $apiClient) { ... })`)
 * @method static static ordersV0Shipment() Set target API to `\Glue\SpApi\OpenAPI\Clients\OrdersV0\Api\ShipmentApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (ShipmentApi $apiClient) { ... })`)
 * @method static static productFeesV0() Set target API to `\Glue\SpApi\OpenAPI\Clients\ProductFeesV0\Api\FeesApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (FeesApi $apiClient) { ... })`)
 * @method static static productPricingV0() Set target API to `\Glue\SpApi\OpenAPI\Clients\ProductPricingV0\Api\ProductPricingApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (ProductPricingApi $apiClient) { ... })`)
 * @method static static replenishmentV20221107Offers() Set target API to `\Glue\SpApi\OpenAPI\Clients\ReplenishmentV20221107\Api\OffersApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (OffersApi $apiClient) { ... })`)
 * @method static static replenishmentV20221107Sellingpartners() Set target API to `\Glue\SpApi\OpenAPI\Clients\ReplenishmentV20221107\Api\SellingpartnersApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (SellingpartnersApi $apiClient) { ... })`)
 * @method static static reportsV20200904() Set target API to `\Glue\SpApi\OpenAPI\Clients\ReportsV20200904\Api\ReportsApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (ReportsApi $apiClient) { ... })`)
 * @method static static reportsV20210630() Set target API to `\Glue\SpApi\OpenAPI\Clients\ReportsV20210630\Api\ReportsApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (ReportsApi $apiClient) { ... })`)
 * @method static static salesV1() Set target API to `\Glue\SpApi\OpenAPI\Clients\SalesV1\Api\SalesApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (SalesApi $apiClient) { ... })`)
 * @method static static sellersV1() Set target API to `\Glue\SpApi\OpenAPI\Clients\SellersV1\Api\SellersApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (SellersApi $apiClient) { ... })`)
 * @method static static servicesV1() Set target API to `\Glue\SpApi\OpenAPI\Clients\ServicesV1\Api\ServiceApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (ServiceApi $apiClient) { ... })`)
 * @method static static shipmentInvoicingV0() Set target API to `\Glue\SpApi\OpenAPI\Clients\ShipmentInvoicingV0\Api\ShipmentInvoiceApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (ShipmentInvoiceApi $apiClient) { ... })`)
 * @method static static supplySourcesV20200701() Set target API to `\Glue\SpApi\OpenAPI\Clients\SupplySourcesV20200701\Api\SupplySourcesApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (SupplySourcesApi $apiClient) { ... })`)
 * @method static static tokensV20210301() Set target API to `\Glue\SpApi\OpenAPI\Clients\TokensV20210301\Api\TokensApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (TokensApi $apiClient) { ... })`)
 * @method static static uploadsV20201101() Set target API to `\Glue\SpApi\OpenAPI\Clients\UploadsV20201101\Api\UploadsApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (UploadsApi $apiClient) { ... })`)
 * @method static static vendorDirectFulfillmentInventoryV1() Set target API to `\Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentInventoryV1\Api\UpdateInventoryApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (UpdateInventoryApi $apiClient) { ... })`)
 * @method static static vendorDirectFulfillmentOrdersV1() Set target API to `\Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentOrdersV1\Api\VendorOrdersApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (VendorOrdersApi $apiClient) { ... })`)
 * @method static static vendorDirectFulfillmentOrdersV20211228() Set target API to `\Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentOrdersV20211228\Api\VendorOrdersApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (VendorOrdersApi $apiClient) { ... })`)
 * @method static static vendorDirectFulfillmentPaymentsV1() Set target API to `\Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentPaymentsV1\Api\VendorInvoiceApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (VendorInvoiceApi $apiClient) { ... })`)
 * @method static static vendorDirectFulfillmentSandboxDataV20211228() Set target API to `\Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentSandboxDataV20211228\Api\VendorDFSandboxApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (VendorDFSandboxApi $apiClient) { ... })`)
 * @method static static vendorDirectFulfillmentSandboxDataV20211228transactionstatus() Set target API to `\Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentSandboxDataV20211228\Api\VendorDFSandboxtransactionstatusApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (VendorDFSandboxtransactionstatusApi $apiClient) { ... })`)
 * @method static static vendorDirectFulfillmentShippingV1CustomerInvoices() Set target API to `\Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentShippingV1\Api\CustomerInvoicesApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (CustomerInvoicesApi $apiClient) { ... })`)
 * @method static static vendorDirectFulfillmentShippingV1() Set target API to `\Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentShippingV1\Api\VendorShippingApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (VendorShippingApi $apiClient) { ... })`)
 * @method static static vendorDirectFulfillmentShippingV1Labels() Set target API to `\Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentShippingV1\Api\VendorShippingLabelsApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (VendorShippingLabelsApi $apiClient) { ... })`)
 * @method static static vendorDirectFulfillmentShippingV20211228CustomerInvoices() Set target API to `\Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentShippingV20211228\Api\CustomerInvoicesApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (CustomerInvoicesApi $apiClient) { ... })`)
 * @method static static vendorDirectFulfillmentShippingV20211228() Set target API to `\Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentShippingV20211228\Api\VendorShippingApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (VendorShippingApi $apiClient) { ... })`)
 * @method static static vendorDirectFulfillmentShippingV20211228Labels() Set target API to `\Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentShippingV20211228\Api\VendorShippingLabelsApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (VendorShippingLabelsApi $apiClient) { ... })`)
 * @method static static vendorDirectFulfillmentTransactionsV1() Set target API to `\Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentTransactionsV1\Api\VendorTransactionApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (VendorTransactionApi $apiClient) { ... })`)
 * @method static static vendorDirectFulfillmentTransactionsV20211228() Set target API to `\Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentTransactionsV20211228\Api\VendorTransactionApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (VendorTransactionApi $apiClient) { ... })`)
 * @method static static vendorTransactionStatusV1() Set target API to `\Glue\SpApi\OpenAPI\Clients\VendorTransactionStatusV1\Api\VendorTransactionApi`. For a simpler syntax, you can also remove this setter, type-hint this class in the `execute` callback, and let the authenticated Api client object be injected for you. (E.g. `sp_api()->execute(function (VendorTransactionApi $apiClient) { ... })`)
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
