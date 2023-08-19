<?php

use Glue\SpApi\Laravel\Contracts\SpApiContract;
use Glue\SpApi\Laravel\Utilities\SpApiCredentialProvider;

if (!function_exists('sp_api')) {

    /**
     * Get the SP-API container.
     */
    function sp_api(): SpApiContract
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
