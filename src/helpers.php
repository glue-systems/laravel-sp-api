<?php

use Glue\SpApi\Laravel\Utilities\SpApi;
use Glue\SpApi\Laravel\Utilities\SpApiCredentialProvider;
use Illuminate\Support\Facades\App;

if (!function_exists('sp_api')) {

    /**
     * Create a new SP-API execution.
     */
    function sp_api(): SpApi
    {
        return App::make(SpApi::class);
    }
}

if (!function_exists('sp_api_credential_provider')) {

    /**
     * Get the SP-API credential provider singleton.
     */
    function sp_api_credential_provider(): SpApiCredentialProvider
    {
        return App::make(SpApiCredentialProvider::class);
    }
}
