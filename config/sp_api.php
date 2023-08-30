<?php

return [
    /**
     * Set the default values that SP-API services can rely on for most operations,
     * which can be overwritten at runtime via the `SpApi` execution API.
     */
    'default' => [
        /**
         * The base endpoint to use for SP-API operations.
         * See: https://developer-docs.amazon.com/sp-api/docs/sp-api-endpoints
         */
        'base_url'                     => env('SP_API_DEFAULT_BASE_URL', 'https://sandbox.sellingpartnerapi-na.amazon.com'),

        /**
         * Some operations require a Marketplace ID to be included in the request. You can store it
         * here for easy access, or set the value at runtime (e.g. if selling on multiple marketplaces).
         */
        'marketplace_id'               => env('SP_API_DEFAULT_MARKETPLACE_ID'),

        /**
         * Some operations require a Seller ID to be included in the request. You can store it
         * here for easy access, or set the value at runtime.
         */
        'seller_id'                    => env('SP_API_DEFAULT_SELLER_ID'),

        /**
         * Set values related to credential scopes used for AWS Signature V4. For more information
         * on credential scopes, see: https://developer-docs.amazon.com/sp-api/docs/connecting-to-the-selling-partner-api#credential-scope
         */
        'aws_credential_scope_service' => env('SP_API_DEFAULT_AWS_CREDENTIAL_SCOPE_SERVICE', 'execute-api'),
        'aws_credential_scope_region'  => env('SP_API_DEFAULT_AWS_CREDENTIAL_SCOPE_REGION'),
    ],

    /**
     * Set the configuration values for retrieving Login with Amazon (LWA) access tokens
     * for authenticating requests. For more information, see the official SP-API documentation:
     * https://developer-docs.amazon.com/sp-api/docs/connecting-to-the-selling-partner-api#step-1-request-a-login-with-amazon-access-token
     */
    'lwa' => [
        'o_auth_base_url' => env('SP_API_LWA_O_AUTH_BASE_URL', 'https://api.amazon.com'),
        'refresh_token'   => env('SP_API_LWA_REFRESH_TOKEN'),
        'client_id'       => env('SP_API_LWA_CLIENT_ID'),
        'client_secret'   => env('SP_API_LWA_CLIENT_SECRET'),
    ],

    'cache'                        => [
        /**
         * Key by which to cache the retrieved LWA access token.
         */
        'lwa_access_token_key' => 'lwa_access_token',

        /*
         * You may optionally indicate a specific cache driver for caching values such as the
         * LWA access token, using any of the `store` drivers available in your Laravel app,
         * or 'default' to use the `default` driver configured in config/cache.php.
         */
        'store' => 'default',
    ],

    /**
     * Set values needed to configure the User Agent header in SP-API calls.
     * See: https://developer-docs.amazon.com/sp-api/docs/include-a-user-agent-header-in-all-requests
     */
    'app_name_and_version'                      => env('SP_API_APP_NAME_AND_VERSION', 'GLUE_DEV/0.0.1'),
    'app_language_and_version'                  => env('SP_API_APP_LANGUAGE_AND_VERSION', 'PHP/7.1'),

    /**
     * Set whether your environment intends to use the Sandbox endpoint. This value is validated against
     * the configured URI as an extra layer of protection against making unintended calls to production
     * endpoints.
     */
    'sandbox'                                   => env('SP_API_SANDBOX', true),

    /**
     * SP-API error responses often include JSON response bodies with more information about any
     * request or server issues. Because such response bodies are often received as streams,
     * unpacking them can result in a detaching of the stream which could hinder any automation
     * you would like to build around particular values in the error response body. If your use-case
     * does not include automated error response parsing & handling, you can set this value to true
     * so that the error response body is always included in the reported exception.
     */
    'always_unpack_api_exception_response_body' => env('SP_API_ALWAYS_UNPACK_API_EXCEPTION_RESPONSE_BODY', false),

    /**
     * Set the values of the 'debug' option used by Guzzle / cURL during SP-API calls.
     */
    'debug' => [
        /**
         * This value will turn on or off verbose debug output for calls to
         * SP-API domains such as Orders, MerchantFulfillment Reports, etc.
         */
        'domain_api_call' => env('SP_API_DOMAIN_API_CALL_DEBUG', false),

        /**
         * This value will turn on or off verbose debug output for calls to
         * LWA access token requests (the SP-API implementation of OAuth).
         */
        'o_auth_api_call' => env('SP_API_O_AUTH_API_CALL_DEBUG', false),
    ],

    /**
     * Set the credential provider to be used when authenticating with SP-API.
     * See `credential_providers` array below for a list of available providers and their configurations.
     * For more information, see the AWS SDK for PHP documentation:
     * https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/guide_credentials_provider.html
     */
    'selected_credential_provider' => env('SP_API_DEFAULT_CREDENTIAL_PROVIDER', 'from_credentials'),

    /**
     * Configuration arrays keyed by the the name of the credential provider. To select one
     * of these as the default, see the config field `selected_credential_provider` above.
     */
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
        'custom'                           => [
            /**
             * Here you can define any configuration values relevant to your custom
             * implementation of an AWS credential provider.
             */
        ],
    ],
];
