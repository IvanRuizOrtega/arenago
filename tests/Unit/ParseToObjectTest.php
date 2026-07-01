<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Src\Resources\Array\ParseToObject;
use stdClass;

class ParseToObjectTest extends TestCase
{
    public function test_it_converts_an_associative_array_into_an_object(): void
    {
        $input = [
            'name' => 'Arena.go',
            'type' => 'Web App',
            'status' => 'active'
        ];
        $result = ParseToObject::execute($input);
        $this->assertInstanceOf(stdClass::class, $result);
        $this->assertEquals('Arena.go', $result->name);
        $this->assertEquals('Web App', $result->type);
        $this->assertEquals('active', $result->status);
    }

    public function test_it_converts_an_empty_array_into_an_empty_object(): void
    {
        $input = [];
        $result = ParseToObject::execute($input);
        $this->assertInstanceOf(stdClass::class, $result);
        $this->assertEmpty((array) $result);
    }

    public function test_it_handles_sequential_arrays(): void
    {
        $input = ['Laravel', 'Alpine.js'];
        $result = ParseToObject::execute($input);
        $this->assertInstanceOf(stdClass::class, $result);
        $this->assertEquals('Laravel', $result->{0});
        $this->assertEquals('Alpine.js', $result->{1});
    }
}
