<?php

namespace Tests\Feature\Facades;

use Glue\SpApi\Laravel\Facades\SpApiCredentialProvider;
use Tests\TestCase;

class SpApiCredentialProviderFacadeTest extends TestCase
{
    public function test_it_uses_same_instance_on_each_static_call()
    {
        $spApi1 = SpApiCredentialProvider::getFacadeRoot();
        $spApi2 = SpApiCredentialProvider::getFacadeRoot();

        $this->assertSame($spApi1, $spApi2);
    }

    public function test_it_uses_same_instance_when_facade_is_mocked()
    {
        SpApiCredentialProvider::shouldReceive()->zeroOrMoreTimes();
        $spApi1 = SpApiCredentialProvider::getFacadeRoot();
        SpApiCredentialProvider::shouldReceive()->zeroOrMoreTimes();
        $spApi2 = SpApiCredentialProvider::getFacadeRoot();

        $this->assertSame($spApi1, $spApi2);
    }
}
