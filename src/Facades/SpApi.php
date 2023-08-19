<?php

namespace Glue\SpApi\Laravel\Facades;

use Exception;
use Glue\SpApi\Laravel\Contracts\SpApiContract;
use Glue\SpApi\OpenAPI\Clients\AplusContentV20201101\Api\AplusContentApi as AplusContentV20201101Api;
use Glue\SpApi\OpenAPI\Clients\AuthorizationV1\Api\AuthorizationApi as AuthorizationV1Api;
use Glue\SpApi\OpenAPI\Clients\CatalogItemsV0\Api\CatalogApi as CatalogItemsV0Api;
use Glue\SpApi\OpenAPI\Clients\CatalogItemsV20201201\Api\CatalogApi as CatalogItemsV20201201Api;
use Glue\SpApi\OpenAPI\Clients\DefinitionsProductTypesV20200901\Api\DefinitionsApi as DefinitionsProductTypesV20200901Api;
use Glue\SpApi\OpenAPI\Clients\EasyShipV20220323\Api\EasyShipApi as EasyShipV20220323Api;
use Glue\SpApi\OpenAPI\Clients\FbaInboundEligibilityV1\Api\FbaInboundApi as FbaInboundEligibilityV1Api;
use Glue\SpApi\OpenAPI\Clients\FbaInventoryV1\Api\FbaInventoryApi as FbaInventoryV1Api;
use Glue\SpApi\OpenAPI\Clients\FbaSmallAndLightV1\Api\SmallAndLightApi as FbaSmallAndLightV1Api;
use Glue\SpApi\OpenAPI\Clients\FeedsV20200904\Api\FeedsApi as FeedsV20200904Api;
use Glue\SpApi\OpenAPI\Clients\FeedsV20210630\Api\FeedsApi as FeedsV20210630Api;
use Glue\SpApi\OpenAPI\Clients\FinancesV0\Api\DefaultApi as FinancesV0Api;
use Glue\SpApi\OpenAPI\Clients\FulfillmentInboundV0\Api\FbaInboundApi as FulfillmentInboundV0Api;
use Glue\SpApi\OpenAPI\Clients\FulfillmentOutboundV20200701\Api\FbaOutboundApi as FulfillmentOutboundV20200701Api;
use Glue\SpApi\OpenAPI\Clients\ListingsItemsV20200901\Api\ListingsApi as ListingsItemsV20200901Api;
use Glue\SpApi\OpenAPI\Clients\ListingsItemsV20210801\Api\ListingsApi as ListingsItemsV20210801Api;
use Glue\SpApi\OpenAPI\Clients\ListingsRestrictionsV20210801\Api\ListingsApi as ListingsRestrictionsV20210801Api;
use Glue\SpApi\OpenAPI\Clients\MerchantFulfillmentV0\Api\MerchantFulfillmentApi as MerchantFulfillmentV0Api;
use Glue\SpApi\OpenAPI\Clients\NotificationsV1\Api\NotificationsApi as NotificationsV1Api;
use Glue\SpApi\OpenAPI\Clients\OrdersV0\Api\OrdersV0Api;
use Glue\SpApi\OpenAPI\Clients\OrdersV0\Api\ShipmentApi as OrdersV0ShipmentApi;
use Glue\SpApi\OpenAPI\Clients\ProductFeesV0\Api\FeesApi as ProductFeesV0Api;
use Glue\SpApi\OpenAPI\Clients\ProductPricingV0\Api\ProductPricingApi as ProductPricingV0Api;
use Glue\SpApi\OpenAPI\Clients\ReplenishmentV20221107\Api\OffersApi as ReplenishmentV20221107OffersApi;
use Glue\SpApi\OpenAPI\Clients\ReplenishmentV20221107\Api\SellingpartnersApi as ReplenishmentV20221107SellingpartnersApi;
use Glue\SpApi\OpenAPI\Clients\ReportsV20200904\Api\ReportsApi as ReportsV20200904Api;
use Glue\SpApi\OpenAPI\Clients\ReportsV20210630\Api\ReportsApi as ReportsV20210630Api;
use Glue\SpApi\OpenAPI\Clients\SalesV1\Api\SalesApi as SalesV1Api;
use Glue\SpApi\OpenAPI\Clients\SellersV1\Api\SellersApi as SellersV1Api;
use Glue\SpApi\OpenAPI\Clients\ServicesV1\Api\ServiceApi as ServicesV1Api;
use Glue\SpApi\OpenAPI\Clients\ShipmentInvoicingV0\Api\ShipmentInvoiceApi as ShipmentInvoicingV0Api;
use Glue\SpApi\OpenAPI\Clients\SupplySourcesV20200701\Api\SupplySourcesApi as SupplySourcesV20200701Api;
use Glue\SpApi\OpenAPI\Clients\TokensV20210301\Api\TokensApi as TokensV20210301Api;
use Glue\SpApi\OpenAPI\Clients\UploadsV20201101\Api\UploadsApi as UploadsV20201101Api;
use Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentInventoryV1\Api\UpdateInventoryApi as VendorDirectFulfillmentInventoryV1Api;
use Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentOrdersV1\Api\VendorOrdersApi as VendorDirectFulfillmentOrdersV1Api;
use Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentOrdersV20211228\Api\VendorOrdersApi as VendorDirectFulfillmentOrdersV20211228Api;
use Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentPaymentsV1\Api\VendorInvoiceApi as VendorDirectFulfillmentPaymentsV1Api;
use Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentSandboxDataV20211228\Api\VendorDFSandboxApi as VendorDirectFulfillmentSandboxDataV20211228Api;
use Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentSandboxDataV20211228\Api\VendorDFSandboxtransactionstatusApi as VendorDirectFulfillmentSandboxDataV20211228transactionstatusApi;
use Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentShippingV1\Api\CustomerInvoicesApi as VendorDirectFulfillmentShippingV1CustomerInvoicesApi;
use Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentShippingV1\Api\VendorShippingApi as VendorDirectFulfillmentShippingV1Api;
use Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentShippingV1\Api\VendorShippingLabelsApi as VendorDirectFulfillmentShippingV1LabelsApi;
use Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentShippingV20211228\Api\CustomerInvoicesApi as VendorDirectFulfillmentShippingV20211228CustomerInvoicesApi;
use Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentShippingV20211228\Api\VendorShippingApi as VendorDirectFulfillmentShippingV20211228Api;
use Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentShippingV20211228\Api\VendorShippingLabelsApi as VendorDirectFulfillmentShippingV20211228LabelsApi;
use Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentTransactionsV1\Api\VendorTransactionApi as VendorDirectFulfillmentTransactionsV1Api;
use Glue\SpApi\OpenAPI\Clients\VendorDirectFulfillmentTransactionsV20211228\Api\VendorTransactionApi as VendorDirectFulfillmentTransactionsV20211228Api;
use Glue\SpApi\OpenAPI\Clients\VendorTransactionStatusV1\Api\VendorTransactionApi as VendorTransactionStatusV1Api;
use Glue\SpApi\OpenAPI\Clients\TokensV20210301\Model\CreateRestrictedDataTokenRequest;
use Glue\SpApi\OpenAPI\Container\SpApiRoster;
use Glue\SpApi\OpenAPI\Exceptions\DomainApiException;
use Glue\SpApi\OpenAPI\SpApiConfig;
use Illuminate\Support\Facades\Facade;

/**
 * @method static SpApiConfig getSpApiConfig() Get the global SP-API config object.
 * @method static mixed execute(callable $callback) Wrapper for executing an SP-API operation, which will render any ApiException's thrown as DomainApiException with unpacked response body.
 * @method static AplusContentV20201101Api aplusContentV20201101()
 * @method static AuthorizationV1Api authorizationV1()
 * @method static CatalogItemsV0Api catalogItemsV0()
 * @method static CatalogItemsV20201201Api catalogItemsV20201201()
 * @method static DefinitionsProductTypesV20200901Api definitionsProductTypesV20200901()
 * @method static EasyShipV20220323Api easyShipV20220323()
 * @method static FbaInboundEligibilityV1Api fbaInboundEligibilityV1()
 * @method static FbaInventoryV1Api fbaInventoryV1()
 * @method static FbaSmallAndLightV1Api fbaSmallAndLightV1()
 * @method static FeedsV20200904Api feedsV20200904()
 * @method static FeedsV20210630Api feedsV20210630()
 * @method static FinancesV0Api financesV0()
 * @method static FulfillmentInboundV0Api fulfillmentInboundV0()
 * @method static FulfillmentOutboundV20200701Api fulfillmentOutboundV20200701()
 * @method static ListingsItemsV20200901Api listingsItemsV20200901()
 * @method static ListingsItemsV20210801Api listingsItemsV20210801()
 * @method static ListingsRestrictionsV20210801Api listingsRestrictionsV20210801()
 * @method static MerchantFulfillmentV0Api merchantFulfillmentV0(CreateRestrictedDataTokenRequest $rdtRequest = null)
 * @method static NotificationsV1Api notificationsV1()
 * @method static OrdersV0Api ordersV0(CreateRestrictedDataTokenRequest $rdtRequest = null)
 * @method static OrdersV0ShipmentApi ordersV0Shipment()
 * @method static ProductFeesV0Api productFeesV0()
 * @method static ProductPricingV0Api productPricingV0()
 * @method static ReplenishmentV20221107OffersApi replenishmentV20221107Offers()
 * @method static ReplenishmentV20221107SellingpartnersApi replenishmentV20221107Sellingpartners()
 * @method static ReportsV20200904Api reportsV20200904(CreateRestrictedDataTokenRequest $rdtRequest = null)
 * @method static ReportsV20210630Api reportsV20210630(CreateRestrictedDataTokenRequest $rdtRequest = null)
 * @method static SalesV1Api salesV1()
 * @method static SellersV1Api sellersV1()
 * @method static ServicesV1Api servicesV1()
 * @method static ShipmentInvoicingV0Api shipmentInvoicingV0(CreateRestrictedDataTokenRequest $rdtRequest = null)
 * @method static SupplySourcesV20200701Api supplySourcesV20200701()
 * @method static TokensV20210301Api tokensV20210301()
 * @method static UploadsV20201101Api uploadsV20201101()
 * @method static VendorDirectFulfillmentInventoryV1Api vendorDirectFulfillmentInventoryV1()
 * @method static VendorDirectFulfillmentOrdersV1Api vendorDirectFulfillmentOrdersV1(CreateRestrictedDataTokenRequest $rdtRequest = null)
 * @method static VendorDirectFulfillmentOrdersV20211228Api vendorDirectFulfillmentOrdersV20211228(CreateRestrictedDataTokenRequest $rdtRequest = null)
 * @method static VendorDirectFulfillmentPaymentsV1Api vendorDirectFulfillmentPaymentsV1()
 * @method static VendorDirectFulfillmentSandboxDataV20211228Api vendorDirectFulfillmentSandboxDataV20211228()
 * @method static VendorDirectFulfillmentSandboxDataV20211228transactionstatusApi vendorDirectFulfillmentSandboxDataV20211228transactionstatus()
 * @method static VendorDirectFulfillmentShippingV1CustomerInvoicesApi vendorDirectFulfillmentShippingV1CustomerInvoices(CreateRestrictedDataTokenRequest $rdtRequest = null)
 * @method static VendorDirectFulfillmentShippingV1Api vendorDirectFulfillmentShippingV1(CreateRestrictedDataTokenRequest $rdtRequest = null)
 * @method static VendorDirectFulfillmentShippingV1LabelsApi vendorDirectFulfillmentShippingV1Labels(CreateRestrictedDataTokenRequest $rdtRequest = null)
 * @method static VendorDirectFulfillmentShippingV20211228CustomerInvoicesApi vendorDirectFulfillmentShippingV20211228CustomerInvoices(CreateRestrictedDataTokenRequest $rdtRequest = null)
 * @method static VendorDirectFulfillmentShippingV20211228Api vendorDirectFulfillmentShippingV20211228(CreateRestrictedDataTokenRequest $rdtRequest = null)
 * @method static VendorDirectFulfillmentShippingV20211228LabelsApi vendorDirectFulfillmentShippingV20211228Labels(CreateRestrictedDataTokenRequest $rdtRequest = null)
 * @method static VendorDirectFulfillmentTransactionsV1Api vendorDirectFulfillmentTransactionsV1()
 * @method static VendorDirectFulfillmentTransactionsV20211228Api vendorDirectFulfillmentTransactionsV20211228()
 * @method static VendorTransactionStatusV1Api vendorTransactionStatusV1()
 */
class SpApi extends Facade
{
    public static function fake()
    {
        static::createFreshMockInstance();
    }

    public static function shouldExecuteSuccessfully(int $times = 1)
    {
        return static::shouldReceive('execute')
            ->times($times)
            ->andReturnUsing(function ($receivedCallbackArgument) {
                try {
                    $callbackReturnValue = $receivedCallbackArgument();
                    return $callbackReturnValue;
                } catch (Exception $ex) {
                    if (SpApiRoster::isApiException($ex)) {
                        throw new DomainApiException($ex->getMessage(), $ex->getCode(), $ex);
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
        return SpApiContract::class;
    }
}
