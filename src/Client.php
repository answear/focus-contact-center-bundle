<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle;

class Client
{
    /**
     * @var Configuration
     */
    private $configuration;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function fccAddRecords(Request\FCC\AddRecords $request): Response\FCC\AddRecords
    {
        // TODO
    }

    public function fccUpdateRecords(Request\FCC\UpdateRecords $request): Response\FCC\UpdateRecords
    {
        // TODO
    }
}
