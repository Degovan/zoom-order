<?php

namespace App\Service\Contract;

interface ZoomServiceContract
{
    /**
     * Link new zoom account with authentication code
     * @param string $code
     */
    public function linkAccount(string $code);
}
