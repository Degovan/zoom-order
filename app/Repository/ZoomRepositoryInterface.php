<?php

namespace App\Repository;

interface ZoomRepositoryInterface
{
    /**
     * Get the zoom app
     * 
     * @return array $information
     */
    public function get();

    /**
     * Set zoom app configuration
     * 
     * @param array $data
     * @return void
     */
    public function store(array $data): void;
}
