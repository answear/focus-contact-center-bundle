<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle;

class PseudorandomChangeGenerator implements ChangeGenerator
{
    public function generate(): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersCount = \strlen($characters);
        $randomString = '';

        for ($i = 0; $i < ChangeGenerator::LENGTH; ++$i) {
            $index = random_int(0, $charactersCount - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }
}
