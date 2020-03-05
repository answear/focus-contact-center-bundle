<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle;

interface ChangeGenerator
{
    /**
     * Required length of a generated change parameter.
     */
    public const LENGTH = 50;

    /**
     * Generates a "change" parameter for API. MUST contain 50 characters.
     */
    public function generate(): string;
}
