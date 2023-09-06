<?php

namespace Tests\Facades;

use Glue\SpApi\Laravel\Facades\SpApi;
use Tests\TestCase;

class SpApiFacadeTest extends TestCase
{
    public function test_it_instantiates_new_facade_roots_on_each_static_call()
    {
        $spApi1 = SpApi::getFacadeRoot();
        $spApi2 = SpApi::getFacadeRoot();

        $this->assertNotSame($spApi1, $spApi2);
    }

    public function test_it_uses_same_instance_when_facade_is_mocked()
    {
        SpApi::shouldReceive()->zeroOrMoreTimes();
        $spApi1 = SpApi::getFacadeRoot();
        SpApi::shouldReceive()->zeroOrMoreTimes();
        $spApi2 = SpApi::getFacadeRoot();

        $this->assertSame($spApi1, $spApi2);
    }
}
