<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Src\Resources\Array\ClearSearch;

class ClearSearchTest extends TestCase
{
    public function test_it_returns_attributes_from_last_element_by_default(): void
    {
        $payload = [
            ['id' => 1, 'name' => 'First'],
            [
                'id' => 2,
                'attributes' => ['title' => 'Target Array', 'active' => true]
            ]
        ];

        $result = ClearSearch::execute($payload);

        $this->assertEquals(['title' => 'Target Array', 'active' => true], $result);
    }

    public function test_it_returns_custom_key_from_last_element(): void
    {
        $payload = [
            ['id' => 1],
            [
                'id' => 3,
                'custom_search' => ['filter' => 'laravel', 'page' => 1]
            ]
        ];

        $result = ClearSearch::execute($payload, 'custom_search');

        $this->assertEquals(['filter' => 'laravel', 'page' => 1], $result);
    }

    public function test_it_returns_the_full_last_element_if_key_does_not_exist(): void
    {
        $payload = [
            ['id' => 1],
            ['id' => 4, 'slug' => 'no-attributes-here']
        ];

        $result = ClearSearch::execute($payload, 'attributes');

        $this->assertEquals(['id' => 4, 'slug' => 'no-attributes-here'], $result);
    }
}
