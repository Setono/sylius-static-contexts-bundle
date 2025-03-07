<?php

declare(strict_types=1);

namespace Setono\SyliusStaticContextsBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

final class SetonoSyliusStaticContextsBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
