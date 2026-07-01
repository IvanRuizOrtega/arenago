<?php

namespace Src\Resources\Array;

final class ClearSearch
{
    public static function execute(
        $attributes,
        string $key = 'attributes'
    ): array {
        if (empty($attributes)) {
            return [];
        }
        $lastElement = $attributes[array_key_last($attributes)];
        if (is_array($lastElement) && array_key_exists($key, $lastElement)) {
            return $lastElement[$key];
        }
        return (array) $lastElement;
    }
}
