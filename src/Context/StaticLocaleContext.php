<?php

declare(strict_types=1);

namespace Setono\SyliusStaticContextsBundle\Context;

use Sylius\Component\Locale\Context\LocaleContextInterface;
use Sylius\Component\Locale\Context\LocaleNotFoundException;

final class StaticLocaleContext implements LocaleContextInterface
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
}
