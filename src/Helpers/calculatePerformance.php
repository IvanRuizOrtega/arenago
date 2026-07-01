<?php

if (!function_exists('calculatePerformance')) {
    function calculatePerformance(int $wins, int $draws, int $played): float
    {
        return  $played > 0 ? (($wins * 3 + $draws) / ($played * 3)) * 100 : 0;
    }
}
