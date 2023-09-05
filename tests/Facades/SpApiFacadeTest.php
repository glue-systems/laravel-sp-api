<?php

namespace Tests\Facades;

use Glue\SpApi\Laravel\Facades\SpApi;
use Glue\SpApi\OpenAPI\Clients\TokensV20210301\Model\CreateRestrictedDataTokenRequest;
use Tests\TestCase;

class SpApiFacadeTest extends TestCase
{
    public function test_it_uses_new_instances_on_each_static_call()
    {
        $spApi1 = SpApi::withRdtRequest(new CreateRestrictedDataTokenRequest());
        $spApi2 = SpApi::withRdtRequest(new CreateRestrictedDataTokenRequest());

        $this->assertNotEquals($spApi1, $spApi2);
    }
}
