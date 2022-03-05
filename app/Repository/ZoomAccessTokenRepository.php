<?php

namespace App\Repository;

use App\Models\ZoomAccount;

class ZoomAccessTokenRepository extends ZoomRepositoryAbstract
{
    private const TOKENLOCATION = '/zoom/token';

    public function __construct()
    {
        parent::__construct();
        $this->createIfEmpty();
    }

    public function get(ZoomAccount $account): object
    {
        $location = self::TOKENLOCATION . "/{$account->auth_filename}";
        return json_decode($this->storage->get($location));
    }

    /**
     * Store the access token
     * @param string $email
     * @param array $data
     * @return string $filename
     */
    public function store(string $email, array $data): string
    {
        $filename = self::TOKENLOCATION . "/{$email}.json";
        $data['expires_in'] = time() + $data['expires_in'];
        
        $this->storage->put($filename, json_encode($data));
        return "{$email}.json";
    }

    /**
     * Create zoom token location if empty
     */
    private function createIfEmpty(): void
    {
        if(!$this->storage->exists(self::TOKENLOCATION))
            $this->storage->makeDirectory(self::TOKENLOCATION);
    }
}
