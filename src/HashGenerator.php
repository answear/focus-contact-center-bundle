<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle;

class HashGenerator
{
    /**
     * @var Configuration
     */
    private $configuration;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function hash(string $change): string
    {
        [$login, ] = explode('@', $this->configuration->getLogin());

        return hash(
            $this->configuration->getHashMethod(),
            $login . $change . $this->configuration->getApiKey()
        );
    }
}
