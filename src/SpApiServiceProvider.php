<?php

namespace Glue\SpApi\Laravel;

use Glue\SpApi\Laravel\Contracts\SpApiContract;
use Glue\SpApi\Laravel\Utilities\SpApi;
use Glue\SpApi\Laravel\Utilities\SpApiCredentialProvider;
use Glue\SpApi\OpenAPI\Services\Authenticator\ClientAuthenticator;
use Glue\SpApi\OpenAPI\Services\Authenticator\ClientAuthenticatorInterface;
use Glue\SpApi\OpenAPI\Services\Builder\ClientBuilder;
use Glue\SpApi\OpenAPI\Services\Builder\ClientBuilderInterface;
use Glue\SpApi\OpenAPI\Services\Factory\ClientFactory;
use Glue\SpApi\OpenAPI\Services\Factory\ClientFactoryInterface;
use Glue\SpApi\OpenAPI\Services\Lwa\LwaService;
use Glue\SpApi\OpenAPI\Services\Lwa\LwaServiceInterface;
use Glue\SpApi\OpenAPI\Services\Rdt\RestrictedDataTokenProvider;
use Glue\SpApi\OpenAPI\Services\Rdt\RestrictedDataTokenProviderInterface;
use Glue\SpApi\OpenAPI\SpApiConfig;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class SpApiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerContainer();
        $this->registerSingletons();
        $this->registerServices();
    }

    protected function registerContainer()
    {
        $this->app->bind(SpApiContract::class, function (Container $app) {
            return new SpApi(
                $app->make(ClientFactoryInterface::class),
                $app->make(RestrictedDataTokenProviderInterface::class),
                $this->buildSpApiConfig()
            );
        });
    }

    protected function registerSingletons()
    {
        $this->app->singleton(SpApiCredentialProvider::class, SpApiCredentialProvider::class);
    }

    protected function registerServices()
    {
        $this->app->bind(LwaServiceInterface::class, function () {
            return new LwaService($this->buildSpApiConfig());
        });

        $this->app->bind(ClientAuthenticatorInterface::class, function (Container $app) {
            return new ClientAuthenticator(
                $this->resolveCacheStore(),
                $app->make(LwaServiceInterface::class),
                sp_api_credential_provider()->resolveProviderViaLaravelConfig(
                    Config::get('sp_api')
                ),
                $this->buildSpApiConfig()
            );
        });

        $this->app->bind(ClientBuilderInterface::class, function (Container $app) {
            return new ClientBuilder(
                $app->make(ClientAuthenticatorInterface::class),
                $this->buildSpApiConfig()
            );
        });

        $this->app->bind(ClientFactoryInterface::class, function (Container $app) {
            return new ClientFactory(
                $app->make(ClientBuilderInterface::class),
                $this->buildSpApiConfig()
            );
        });

        $this->app->bind(RestrictedDataTokenProviderInterface::class, function (Container $app) {
            return new RestrictedDataTokenProvider(
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
            'spApiBaseUrl'          => Config::get('sp_api.base_url'),
            'marketplaceId'         => Config::get('sp_api.marketplace_id'),
            'sellerId'              => Config::get('sp_api.seller_id'),
            'appNameAndVersion'     => Config::get('sp_api.app_name_and_version'),
            'appLanguageAndVersion' => Config::get('sp_api.app_language_and_version'),
            'sandbox'               => Config::get('sp_api.sandbox'),
            'lwaOAuthBaseUrl'       => Config::get('sp_api.lwa.o_auth_base_url'),
            'lwaRefreshToken'       => Config::get('sp_api.lwa.refresh_token'),
            'lwaClientId'           => Config::get('sp_api.lwa.client_id'),
            'lwaClientSecret'       => Config::get('sp_api.lwa.client_secret'),
            'debugDomainApiCall'    => Config::get('sp_api.debug.domain_api_call'),
            'debugOAuthApiCall'     => Config::get('sp_api.debug.o_auth_api_call'),
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
}
