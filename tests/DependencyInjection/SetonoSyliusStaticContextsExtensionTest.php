<?php

declare(strict_types=1);

namespace Setono\SyliusStaticContextsBundle\Tests\DependencyInjection;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use PHPUnit\Framework\Attributes\Test;
use Setono\SyliusStaticContextsBundle\Context\StaticChannelContext;
use Setono\SyliusStaticContextsBundle\Context\StaticLocaleContext;
use Setono\SyliusStaticContextsBundle\DependencyInjection\SetonoSyliusStaticContextsExtension;

final class SetonoSyliusStaticContextsExtensionTest extends AbstractExtensionTestCase
{
    protected function getContainerExtensions(): array
    {
        return [new SetonoSyliusStaticContextsExtension()];
    }

    #[Test]
    public function it_registers_static_channel_context(): void
    {
        $this->load();

        $this->assertContainerBuilderHasService(StaticChannelContext::class);
        $this->assertContainerBuilderHasServiceDefinitionWithTag(
            StaticChannelContext::class,
            'sylius.context.channel',
            ['priority' => 256],
        );
    }

    #[Test]
    public function it_registers_static_locale_context(): void
    {
        $this->load();

        $this->assertContainerBuilderHasService(StaticLocaleContext::class);
        $this->assertContainerBuilderHasServiceDefinitionWithTag(
            StaticLocaleContext::class,
            'sylius.context.locale',
            ['priority' => 256],
        );
    }
}
