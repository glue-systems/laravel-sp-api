<?php

namespace Tests\Feature;

use Glue\SpApi\Laravel\Facades\SpApi;
use Tests\TestCase;

class SpApiFunctionTest extends TestCase
{
    public function test_it_instantiates_new_sp_api_executions_on_each_call()
    {
        $spApi1 = sp_api();
        $spApi2 = sp_api();

        $this->assertNotSame($spApi1, $spApi2);
    }

    public function test_it_uses_same_instance_when_facade_is_mocked()
    {
        SpApi::shouldReceive()->zeroOrMoreTimes();
        $spApi1 = sp_api();
        SpApi::shouldReceive()->zeroOrMoreTimes();
        $spApi2 = sp_api();

        $this->assertSame($spApi1, $spApi2);
    }
}
