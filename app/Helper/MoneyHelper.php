<?php
if (!function_exists('moneyFormat')) {
    function moneyFormat($money)
    {
        return number_format($money, 2, '.', ',');
    }
}
