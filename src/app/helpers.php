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

if(!function_exists('whatsappNumber')) {
    function whatsappNumber($number): string {
        $firstChar = substr($number, 0, 2);

        if($firstChar == "08") return "62" . substr($number, 1);
        if($firstChar == "+6") return substr($number, 1);

        return $number;
    }
}
