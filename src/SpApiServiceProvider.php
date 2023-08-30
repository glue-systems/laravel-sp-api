<?php

namespace Glue\SpApi\Laravel;

use Glue\SpApi\Laravel\Utilities\SpApi;
use Glue\SpApi\Laravel\Utilities\SpApiCredentialProvider;
use Glue\SpApi\OpenAPI\Configuration\SpApiConfig;
use Glue\SpApi\OpenAPI\Services\Authenticator\ClientAuthenticator;
use Glue\SpApi\OpenAPI\Services\Authenticator\ClientAuthenticatorInterface;
use Glue\SpApi\OpenAPI\Services\Factory\ClientFactory;
use Glue\SpApi\OpenAPI\Services\Factory\ClientFactoryInterface;
use Glue\SpApi\OpenAPI\Services\Lwa\LwaClient;
use Glue\SpApi\OpenAPI\Services\Lwa\LwaClientInterface;
use Glue\SpApi\OpenAPI\Services\Lwa\LwaService;
use Glue\SpApi\OpenAPI\Services\Lwa\LwaServiceInterface;
use Glue\SpApi\OpenAPI\Services\Rdt\RdtService;
use Glue\SpApi\OpenAPI\Services\Rdt\RdtServiceInterface;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class SpApiServiceProvider extends ServiceProvider
{
    public function register()
    {
        /**
         * The SpApi class must be instantiated once per execution, and so cannot
         * be bound as a singleton.
         */
        $this->app->bind(SpApi::class, function (Container $app) {
            return new SpApi(
                $app->make(ClientFactoryInterface::class),
                $app->make(RdtServiceInterface::class),
                $app->make(LwaServiceInterface::class),
                $this->buildSpApiConfig()
            );
        });

        $this->registerSingletons();
    }

    public function boot()
    {
        $this->offerPublishing();
    }

    protected function registerSingletons()
    {
        $this->app->singleton(SpApiCredentialProvider::class, SpApiCredentialProvider::class);

        $this->app->singleton(LwaClientInterface::class, function () {
            return new LwaClient($this->buildSpApiConfig());
        });

        $this->app->singleton(LwaServiceInterface::class, function (Container $app) {
            return new LwaService(
                $app->make(LwaClientInterface::class),
                $this->resolveCacheStore(),
                $this->buildSpApiConfig()
            );
        });

        $this->app->singleton(ClientAuthenticatorInterface::class, function (Container $app) {
            return new ClientAuthenticator(
                $app->make(LwaServiceInterface::class),
                sp_api_credential_provider()->resolveProviderViaLaravelConfig(
                    Config::get('sp_api')
                ),
                $this->buildSpApiConfig()
            );
        });

        $this->app->singleton(ClientFactoryInterface::class, function (Container $app) {
            return new ClientFactory(
                $app->make(ClientAuthenticatorInterface::class),
                $this->buildSpApiConfig()
            );
        });

        $this->app->singleton(RdtServiceInterface::class, function (Container $app) {
            return new RdtService(
                $app->make(ClientFactoryInterface::class)
            );
        });
    }

    /**
     * @return SpApiConfig
     */
    protected function buildSpApiConfig()
    {
        return SpApiConfig::make([
            'defaultBaseUrl'                       => Config::get('sp_api.default.base_url'),
            'defaultMarketplaceId'                 => Config::get('sp_api.default.marketplace_id'),
            'defaultSellerId'                      => Config::get('sp_api.default.seller_id'),
            'defaultAwsCredentialScopeRegion'      => Config::get('sp_api.default.aws_credential_scope_region'),
            'defaultAwsCredentialScopeService'     => Config::get('sp_api.default.aws_credential_scope_service'),
            'lwaOAuthBaseUrl'                      => Config::get('sp_api.lwa.o_auth_base_url'),
            'lwaRefreshToken'                      => Config::get('sp_api.lwa.refresh_token'),
            'lwaClientId'                          => Config::get('sp_api.lwa.client_id'),
            'lwaClientSecret'                      => Config::get('sp_api.lwa.client_secret'),
            'lwaAccessTokenCacheKey'               => Config::get('sp_api.cache.lwa_access_token_key'),
            'appNameAndVersion'                    => Config::get('sp_api.app_name_and_version'),
            'appLanguageAndVersion'                => Config::get('sp_api.app_language_and_version'),
            'sandbox'                              => Config::get('sp_api.sandbox'),
            'domainApiCallDebug'                   => Config::get('sp_api.debug.domain_api_call'),
            'oAuthApiCallDebug'                    => Config::get('sp_api.debug.o_auth_api_call'),
            'alwaysUnpackApiExceptionResponseBody' => Config::get('sp_api.always_unpack_api_exception_response_body'),
        ]);
    }

    /**
     * @return Repository
     */
    protected function resolveCacheStore()
    {
        $storeName = Config::get('sp_api.cache.store') === 'default'
            ? Config::get('cache.default')
            : Config::get('sp_api.cache.store');

        return Cache::store($storeName);
    }

    protected function offerPublishing()
    {
        if (!$this->app->runningInConsole()) {
            return;
        }

        if (!function_exists('config_path')) {
            // Function not available and 'publish' not relevant in Lumen (idea from Spatie)
            return;
        }

        $this->publishes([
            __DIR__ . '/../config/sp_api.php' => config_path('sp_api.php'),
        ]);
    }
}
