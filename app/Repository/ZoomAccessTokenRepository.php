<?php

namespace App\Repository;

use App\Factory\ZoomAuthFactory;
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
        $this->refreshIfExpired($location);

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

    private function refreshIfExpired(string $path)
    {
        $token = json_decode($this->storage->get($path));

        if($token->expires_in <= time()) {
            $newToken = (new ZoomAuthFactory)->refreshAccessToken($token);
            $newToken['expires_in'] = time() + $newToken['expires_in'];

            $this->storage->put($path, json_encode($newToken));
        }
    }
}
