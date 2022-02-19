<?php

namespace App\Factory;

interface ZoomAuthFactoryContract
{
    public function generateAuthUrl(): string;
}
