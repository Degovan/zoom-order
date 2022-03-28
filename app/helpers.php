<?php

if(!function_exists('idr_format')) {
    function idr_format($total) {
        return "Rp " . number_format($total, 0, ',', '.');
    }
}
