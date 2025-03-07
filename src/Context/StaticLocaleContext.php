<?php

declare(strict_types=1);

namespace Setono\SyliusStaticContextsBundle\Context;

use Sylius\Component\Locale\Context\LocaleContextInterface;
use Sylius\Component\Locale\Context\LocaleNotFoundException;
use Symfony\Contracts\Service\ResetInterface;

final class StaticLocaleContext implements LocaleContextInterface, ResetInterface
{
    private ?string $localeCode = null;

    public function getLocaleCode(): string
    {
        return $this->localeCode ?? throw new LocaleNotFoundException('Static locale code is not set');
    }

    public function setLocaleCode(?string $localeCode): void
    {
        $this->localeCode = $localeCode;
    }

    public function reset(): void
    {
        $this->localeCode = null;
    }
}
