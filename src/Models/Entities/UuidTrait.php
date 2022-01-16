<?php

namespace WalkerChiu\Core\Models\Entities;

use Exception;
use Ramsey\Uuid\Uuid;

trait UuidTrait
{
    /**
     * The UUID version to use.
     *
     * @var Int
     */
    protected $uuidVersion = 4;

    /**
     * @throws \Exception
     * @return String
     */
    protected function generateUuid(?int $uuidVersion = null): string
    {
        $version = $uuidVersion ? $uuidVersion : $this->uuidVersion;

        switch ($version) {
            case 1:
                return Uuid::uuid1()->toString();
            case 3:
                return Uuid::uuid3(Uuid::NAMESPACE_DNS, env('APP_DOMAIN', 'example.com'))->toString();
            case 4:
                return Uuid::uuid4()->toString();
            case 5:
                return Uuid::uuid5(Uuid::NAMESPACE_DNS, env('APP_DOMAIN', 'example.com'))->toString();
        }

        throw new Exception("UUID version " . $this->uuidVersion . " is not supported.");
    }
}
