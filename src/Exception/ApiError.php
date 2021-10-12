<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle\Exception;

use Answear\FocusContactCenterBundle\Request\Request;

class ApiError extends \RuntimeException
{
    private Request $request;

    public function __construct(string $message, Request $request)
    {
        parent::__construct($message);

        $this->request = $request;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }
}
