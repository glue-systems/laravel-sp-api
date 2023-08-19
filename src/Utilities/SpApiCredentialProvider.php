<?php

namespace Glue\SpApi\Laravel\Utilities;

use Aws\Credentials\CredentialProvider;
use Aws\Credentials\Credentials;
use Glue\SpApi\OpenAPI\Exceptions\SpApiConfigurationException;

class SpApiCredentialProvider
{
    /**
     * @var callable
     */
    protected $customCredentialProvider = null;

    /**
     * Set the custom credential provider to be used for SP-API authentication.
     * (Note: Only applicable if config sp_api.selected_credential_provider is set to "custom").
     * For more information, see the AWS SDK for PHP documentation:
     * https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/guide_credentials_provider.html
     *
     * @param  callable  $callback  Callback that returns a Guzzle Promise with the credentials to retrieve
     * @return void
     */
    public function setCustomProvider(callable $callback)
    {
        $this->customCredentialProvider = $callback;
    }

    /**
     * Get the custom credential provider to be used for SP-API authentication.
     * (Note: Only applicable if config sp_api.selected_credential_provider is set to "custom").
     * For more information, see the AWS SDK for PHP documentation:
     * https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/guide_credentials_provider.html
     *
     * @return callable|null
     */
    public function getCustomProvider()
    {
        return $this->customCredentialProvider;
    }

    /**
     * Determine if a custom credential provider has been set for SP-API authentication.
     * (Note: Only applicable if config sp_api.selected_credential_provider is set to "custom").
     * For more information, see the AWS SDK for PHP documentation:
     * https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/guide_credentials_provider.html
     *
     * @return bool
     */
    public function hasCustomProvider()
    {
        return isset($this->customCredentialProvider);
    }

    /**
     * @param  array  $laravelConfig
     * @return callable
     * @throws SpApiConfigurationException
     */
    public function resolveProviderViaLaravelConfig(array $laravelConfig)
    {
        $providerName = $laravelConfig['selected_credential_provider'];
        if (!array_key_exists($providerName, $laravelConfig['credential_providers'])) {
            $this->throwUnsupportedProvider($providerName, $laravelConfig['credential_providers']);
        }

        switch ($providerName) {
            case 'from_credentials':
                $credentialProvider = $this->resolveProviderFromCredentials($laravelConfig['credential_providers']['from_credentials']);
                break;
            case 'aws_sdk_default_precedence_chain':
                $credentialProvider = $this->resolveProviderViaAwsSdkDefaultPrecedenceChain($laravelConfig['credential_providers']['aws_sdk_default_precedence_chain']);
                break;
            case 'custom':
                $credentialProvider = $this->resolveCustomProvider($laravelConfig['credential_providers']['custom']);
                break;
            default:
                $this->throwUnsupportedProvider($providerName, $laravelConfig['credential_providers']);
        }

        return $credentialProvider;
    }

    /**
     * @return callable
     * @throws SpApiConfigurationException
     */
    public function resolveProviderFromCredentials(array $fromCredentialsConfig)
    {
        if (empty($fromCredentialsConfig['aws_access_key_id'])) {
            throw new SpApiConfigurationException('Missing sp_api config value:'
                . ' Please set a non-empty value for `credential_providers.from_credentials.aws_access_key_id`'
                . ' when `selected_credential_provider` is set to "from_credentials".');
        }

        if (empty($fromCredentialsConfig['aws_secret_access_key'])) {
            throw new SpApiConfigurationException('Missing sp_api config value:'
                . ' Please set a non-empty value for `credential_providers.from_credentials.aws_secret_access_key`'
                . ' when `selected_credential_provider` is set to "from_credentials".');
        }

        return CredentialProvider::fromCredentials(new Credentials(
            $fromCredentialsConfig['aws_access_key_id'],
            $fromCredentialsConfig['aws_secret_access_key']
        ));
    }

    /**
     * @return callable
     * @throws SpApiConfigurationException
     */
    public function resolveCustomProvider(array $customConfig)
    {
        if (!$this->hasCustomProvider()) {
            throw new SpApiConfigurationException('Missing custom credential provider:'
                . ' Please make sure to invoke `SpApiCredentialProvider::setCustomProvider` in a service provider `boot` method'
                . ' when the sp_api config value for `selected_credential_provider` is set to "custom".');
        }

        $customCredentialProvider = $this->getCustomProvider();
        if (!is_callable($customCredentialProvider)) {
            throw new SpApiConfigurationException('Invalid custom credential provider:'
                . ' The first argument of `SpApiCredentialProvider::setCustomProvider` must be'
                . ' a callable function that returns a Guzzle Promise with the credentials to retrieve.'
                . ' For more info, see the AWS SDK for PHP documentation:'
                . ' https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/guide_credentials_provider.html');
        }

        return $customCredentialProvider;
    }

    /**
     * @return callable
     */
    public function resolveProviderViaAwsSdkDefaultPrecedenceChain(array $awsSdkDefaultPrecedenceChainConfig)
    {
        return CredentialProvider::defaultProvider($awsSdkDefaultPrecedenceChainConfig);
    }

    /**
     * @param  string  $providerName
     * @param  array  $credentialProvidersConfig
     * @throws SpApiConfigurationException
     */
    protected function throwUnsupportedProvider($providerName, array $credentialProvidersConfig)
    {
        $supportedCredentialProviders = array_keys($credentialProvidersConfig);
        throw new SpApiConfigurationException("Unsupported credential provider"
            . " '{$providerName}' in sp_api config `selected_credential_provider`: Must be one of ["
            . implode(', ', $supportedCredentialProviders)
            . "].");
    }
}
