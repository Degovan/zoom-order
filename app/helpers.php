<?php

if(!function_exists('idr_format')) {
    function idr_format($total, $format = 'Rp') {
        return "$format " . number_format($total, 0, ',', '.');
    }
}
