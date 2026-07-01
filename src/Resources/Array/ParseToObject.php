<?php

namespace Src\Resources\Array;

final class ParseToObject
{
    public static function execute(
        array $array
    ): object {
        return (object) json_decode(json_encode($array), false);
    }
}
