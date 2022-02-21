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

    /**
     * Store the access token
     * @param string $email
     * @param array $data
     * @return string $filename
     */
    public function store(string $email, array $data): ZoomAccount
    {
        $filename = self::TOKENLOCATION . "/{$email}.json";
        $this->storage->put($filename, json_encode($data));

        return ZoomAccount::create([
                'email' => $email,
                'auth_filename' => "{$email}.json"
            ]);
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
