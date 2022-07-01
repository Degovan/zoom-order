<?php

use App\Repository\OptionRepository;

if(!function_exists('idr_format')) {
    function idr_format($total, $format = 'Rp') {
        return "$format " . number_format($total, 0, ',', '.');
    }
}

if(!function_exists('option')) {
    function option(): OptionRepository {
        return new OptionRepository;
    }
}
