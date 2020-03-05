<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle;

class Configuration
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var int
     */
    private $campaignsId;

    /**
     * @var string
     */
    private $hashMethod;

    /**
     * @var ChangeGenerator
     */
    private $changeIdGenerator;

    public function __construct(
        string $url,
        string $login,
        string $apiKey,
        int $campaignsId,
        string $hashMethod,
        ChangeGenerator $changeIdGenerator
    ) {
        $this->url = $url;
        $this->login = $login;
        $this->apiKey = $apiKey;
        $this->campaignsId = $campaignsId;
        $this->hashMethod = $hashMethod;
        $this->changeIdGenerator = $changeIdGenerator;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function getCampaignsId(): int
    {
        return $this->campaignsId;
    }

    public function getHashMethod(): string
    {
        return $this->hashMethod;
    }

    public function getChangeIdGenerator(): ChangeGenerator
    {
        return $this->changeIdGenerator;
    }
}
