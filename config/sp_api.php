<?php

return [
    'base_url'                 => env('SP_API_BASE_URL', 'https://sandbox.sellingpartnerapi-na.amazon.com'),
    'marketplace_id'           => env('SP_API_MARKETPLACE_ID'),
    'seller_id'                => env('SP_API_SELLER_ID'),
    'app_name_and_version'     => env('SP_API_APP_NAME_AND_VERSION', 'GLUE_DEV/0.0.1'),
    'app_language_and_version' => env('SP_API_APP_LANGUAGE_AND_VERSION', 'PHP/7.1'),
    'sandbox'                  => env('SP_API_SANDBOX', true),

    'lwa' => [
        'o_auth_base_url' => env('SP_API_LWA_O_AUTH_BASE_URL', 'https://api.amazon.com'),
        'refresh_token'   => env('SP_API_LWA_REFRESH_TOKEN'),
        'client_id'       => env('SP_API_LWA_CLIENT_ID'),
        'client_secret'   => env('SP_API_LWA_CLIENT_SECRET'),
    ],

    'debug' => [
        'domain_api_call' => env('SP_API_DEBUG_DOMAIN_API_CALL', false),
        'o_auth_api_call' => env('SP_API_DEBUG_O_AUTH_API_CALL', false),
    ],

    'cache'                        => [
        /*
         * You may optionally indicate a specific cache driver for caching values such as the
         * LWA access token, using any of the `store` drivers available in your Laravel app,
         * or 'default' to use the `default` driver configured in config/cache.php.
         */
        'store' => 'default',
    ],

    /**
     * Set the credential provider to be used when authenticating with SP-API.
     * See `credential_providers` array below for a list of available providers and their configurations.
     * For more information, see the AWS SDK for PHP documentation:
     * https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/guide_credentials_provider.html
     */
    'selected_credential_provider' => env('SP_API_DEFAULT_CREDENTIAL_PROVIDER', 'from_credentials'),

    'credential_providers' => [
        /**
         * Use this credential provider if your Amazon Seller Central developer account is linked to
         * a static IAM user ARN.
         */
        'from_credentials'                 => [
            'aws_access_key_id'     => env('SP_API_AWS_ACCESS_KEY_ID'),
            'aws_secret_access_key' => env('SP_API_AWS_SECRET_ACCESS_KEY'),
        ],

        /**
         * Use this credential provider if you would like to leverage the AWS SDK credential provider chain,
         * as described in their documentation: https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/guide_credentials.html.
         * Downstream, this will return the value of `\Aws\Credentials\CredentialProvider::defaultProvider()`.
         */
        'aws_sdk_default_precedence_chain' => [
            /**
         * Here you can define the config array that will be passed into `\Aws\Credentials\CredentialProvider::defaultProvider()`.
         */
        ],

        /**
         * Use this credential provider if you would like to set custom logic for retrieving
         * AWS credentials. If this value is used, you must call `SpApiCredentialProvider::setCustomProvider`
         * within a service provider `boot` method, the first argument of which is a callable function
         * that returns a Guzzle Promise with the credentials to retrieve. For more information, see
         * the documentation and/or source code for the class `\Aws\Credentials\CredentialProvider`
         * located in your vendor/aws/aws-sdk-php/src/Credentials/CredentialProvider.php.
         */
        'custom'                           => [],
    ],
];
