<?php

namespace Glue\SpApi\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void setCustomProvider(callable $callback) Set the custom credential provider to be used for SP-API authentication. (Note: Only applicable if config sp_api.selected_credential_provider is set to "custom"). For more information, see the AWS SDK for PHP documentation: https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/guide_credentials_provider.html
 * @method static callable getCustomProvider() Get the custom credential provider to be used for SP-API authentication. (Note: Only applicable if config sp_api.selected_credential_provider is set to "custom"). For more information, see the AWS SDK for PHP documentation: https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/guide_credentials_provider.html
 * @method static bool hasCustomProvider() Determine if a custom credential provider has been set for SP-API authentication. (Note: Only applicable if config sp_api.selected_credential_provider is set to "custom"). For more information, see the AWS SDK for PHP documentation: https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/guide_credentials_provider.html
 * @method static callable resolveProviderViaLaravelConfig(array $laravelConfig)
 * @method static callable resolveProviderFromCredentials(array $fromCredentialsConfig)
 * @method static callable resolveCustomProvider(array $customConfig)
 * @method static callable resolveProviderViaAwsSdkDefaultPrecedenceChain(array $awsSdkDefaultPrecedenceChainConfig)
 */
class SpApiCredentialProvider extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Glue\SpApi\Laravel\Utilities\SpApiCredentialProvider::class;
    }
}
