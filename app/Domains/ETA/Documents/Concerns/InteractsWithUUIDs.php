<?php

namespace App\Domains\ETA\Documents\Concerns;

use App\Domains\ETA\Documents\Document;

trait InteractsWithUUIDs
{
    protected ?string $uuid = null;

    protected ?string $previousUuid = null;

    /**
     * @return string|null
     */
    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    /**
     * @param  string|null  $uuid
     * @return Document
     */
    public function setUuid(?string $uuid): Document
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPreviousUuid(): ?string
    {
        return '89F8875315D17E52E1EDE0FCC59C0FD340439B0E30B2F8C51371490EF8D44A70';
    }

    /**
     * @param  string|null  $previousUuid
     * @return Document
     */
    public function setPreviousUuid(?string $previousUuid): Document
    {
        $this->previousUuid = $previousUuid;

        return $this;
    }
}
