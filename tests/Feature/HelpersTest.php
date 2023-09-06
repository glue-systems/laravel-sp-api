<?php

namespace Tests\Feature;

use Glue\SpApi\Laravel\Facades\SpApi;
use Glue\SpApi\Laravel\Facades\SpApiCredentialProvider;
use Tests\TestCase;

class HelpersTest extends TestCase
{
    public function test_sp_api_instantiates_new_sp_api_executions_on_each_call()
    {
        $spApi1 = sp_api();
        $spApi2 = sp_api();

        $this->assertNotSame($spApi1, $spApi2);
    }

    public function test_sp_api_uses_same_instance_when_facade_is_mocked()
    {
        SpApi::shouldReceive()->zeroOrMoreTimes();
        $spApi1 = sp_api();
        SpApi::shouldReceive()->zeroOrMoreTimes();
        $spApi2 = sp_api();

        $this->assertSame($spApi1, $spApi2);
    }

    public function test_sp_api_credential_provider_uses_same_instance_on_each_call()
    {
        $spApiCredentialProvider1 = sp_api_credential_provider();
        $spApiCredentialProvider2 = sp_api_credential_provider();

        $this->assertSame($spApiCredentialProvider1, $spApiCredentialProvider2);
    }

    public function test_sp_api_credential_provider_uses_same_instance_when_facade_is_mocked()
    {
        SpApiCredentialProvider::shouldReceive()->zeroOrMoreTimes();
        $spApiCredentialProvider1 = sp_api_credential_provider();
        SpApiCredentialProvider::shouldReceive()->zeroOrMoreTimes();
        $spApiCredentialProvider2 = sp_api_credential_provider();

        $this->assertSame($spApiCredentialProvider1, $spApiCredentialProvider2);
    }
}
