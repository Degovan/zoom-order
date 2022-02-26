<?php

namespace App\Repository;

class ZoomAppRepository extends ZoomRepositoryAbstract
{
    public function __construct()
    {
        parent::__construct();
        $this->createIfEmpty();
    }

    /**
     * Get zoom client app configuration
     * @return object $information
     */
    public function get(): object
    {
        $content = $this->storage->get(self::CONFIGFILE);
        return json_decode($content);
    }

    /**
     * Store zoom client configuration into json file
     * @param array $data
     * @return void
     */
    public function store(array $data): void
    {
        $oldConfig = $this->get();
        $newConfig = [
            'client_id' => $data['client_id'] ?? $oldConfig->client_id,
            'client_secret' => $data['client_secret'] ?? $oldConfig->client_secret,
            'redirect_url' => route('zoom.app')
        ];

        $this->storage->put(self::CONFIGFILE, json_encode($newConfig));
    }

    /**
     * Create zoom configuration file if empty
     */
    private function createIfEmpty()
    {
        $blueprint = [
            'client_id' => '',
            'client_secret' => '',
            'redirect_url' => route('zoom.add')
        ];

        if(!$this->storage->exists(self::CONFIGFILE)) {
            $this->storage->put(self::CONFIGFILE, json_encode($blueprint));
        }
    }
}
