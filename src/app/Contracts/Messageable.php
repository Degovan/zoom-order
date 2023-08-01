<?php

namespace App\Contracts;

interface Messageable
{
    public function toText(): string;
}
