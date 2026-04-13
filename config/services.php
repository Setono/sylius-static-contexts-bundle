<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Setono\SyliusStaticContextsBundle\Context\StaticChannelContext;
use Setono\SyliusStaticContextsBundle\Context\StaticLocaleContext;

return static function (ContainerConfigurator $container): void {
    $services = $container->services();

    $services->set(StaticChannelContext::class)
        ->args([service('sylius.repository.channel')])
        ->tag('sylius.context.channel', ['priority' => 256]);

    $services->set(StaticLocaleContext::class)
        ->tag('sylius.context.locale', ['priority' => 256]);
};
