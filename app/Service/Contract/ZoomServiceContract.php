<?php

namespace App\Service\Contract;

interface ZoomServiceContract
{
    /**
     * Link new zoom account with authentication code
     * @param string $code
     */
    public function linkAccount(string $code);

    /**
     * Get linked account by email
     * @return object $information
     */
    public function account(): object;
}
