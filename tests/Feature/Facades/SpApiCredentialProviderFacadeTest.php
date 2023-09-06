<?php

namespace Tests\Feature\Facades;

use Glue\SpApi\Laravel\Facades\SpApiCredentialProvider;
use Tests\TestCase;

class SpApiCredentialProviderFacadeTest extends TestCase
{
    public function test_it_uses_same_instance_on_each_static_call()
    {
        $spApiCredentialProvider1 = SpApiCredentialProvider::getFacadeRoot();
        $spApiCredentialProvider2 = SpApiCredentialProvider::getFacadeRoot();

        $this->assertSame($spApiCredentialProvider1, $spApiCredentialProvider2);
    }

    public function test_it_uses_same_instance_when_facade_is_mocked()
    {
        SpApiCredentialProvider::shouldReceive()->zeroOrMoreTimes();
        $spApiCredentialProvider1 = SpApiCredentialProvider::getFacadeRoot();
        SpApiCredentialProvider::shouldReceive()->zeroOrMoreTimes();
        $spApiCredentialProvider2 = SpApiCredentialProvider::getFacadeRoot();

        $this->assertSame($spApiCredentialProvider1, $spApiCredentialProvider2);
    }
}
