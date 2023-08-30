<?php

use Glue\SpApi\Laravel\Utilities\SpApi;
use Glue\SpApi\Laravel\Utilities\SpApiCredentialProvider;

if (!function_exists('sp_api')) {

    /**
     * Create a new SP-API execution.
     */
    function sp_api(): SpApi
    {
        return \Glue\SpApi\Laravel\Facades\SpApi::getFacadeRoot();
    }
}

if (!function_exists('sp_api_credential_provider')) {

    /**
     * Get the SP-API credential provider singleton.
     */
    function sp_api_credential_provider(): SpApiCredentialProvider
    {
        return \Glue\SpApi\Laravel\Facades\SpApiCredentialProvider::getFacadeRoot();
    }
}
