<?php

declare(strict_types=1);

namespace Setono\SyliusStaticContextsBundle\Tests\Context;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Setono\SyliusStaticContextsBundle\Context\StaticLocaleContext;
use Sylius\Component\Locale\Context\LocaleNotFoundException;

final class StaticLocaleContextTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @test
     */
    public function get_locale_code_throws_exception_when_locale_is_not_set(): void
    {
        $context = new StaticLocaleContext();

        $this->expectException(LocaleNotFoundException::class);
        $this->expectExceptionMessage('Static locale code is not set');

        $context->getLocaleCode();
    }

    /**
     * @test
     */
    public function set_locale_code_and_get_locale_code(): void
    {
        $localeCode = 'en_US';

        $context = new StaticLocaleContext();
        $context->setLocaleCode($localeCode);

        $this->assertSame($localeCode, $context->getLocaleCode());
    }
}
