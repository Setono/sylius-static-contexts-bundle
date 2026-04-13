<?php

declare(strict_types=1);

namespace Setono\SyliusStaticContextsBundle\Tests;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Setono\SyliusStaticContextsBundle\SetonoSyliusStaticContextsBundle;

final class SetonoSyliusStaticContextsBundleTest extends TestCase
{
    #[Test]
    public function get_path_returns_project_root(): void
    {
        $bundle = new SetonoSyliusStaticContextsBundle();

        self::assertSame(dirname(__DIR__), $bundle->getPath());
    }
}
