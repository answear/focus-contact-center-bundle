<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle;

use Webmozart\Assert\Assert;

class Configuration
{
    private static array $allowedHashMethods = ['sha1', 'md5'];
    private string $url;
    private string $login;
    private string $apiKey;
    private ?int $campaignsId;
    private string $hashMethod;
    private ChangeGenerator $changeIdGenerator;

    public function __construct(
        string $url,
        string $login,
        string $apiKey,
        ?int $campaignsId,
        string $hashMethod,
        ChangeGenerator $changeIdGenerator
    ) {
        $this->url = rtrim($url, '/');
        Assert::contains($login, '@');
        $this->login = $login;
        $this->apiKey = $apiKey;
        $this->campaignsId = $campaignsId;
        Assert::oneOf($hashMethod, self::$allowedHashMethods);
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

    public function getCampaignsId(): ?int
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
