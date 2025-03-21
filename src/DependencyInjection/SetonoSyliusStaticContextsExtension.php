<?php

declare(strict_types=1);

namespace Setono\SyliusStaticContextsBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

final class SetonoSyliusStaticContextsExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        (new XmlFileLoader($container, new FileLocator(__DIR__ . '/../../config')))->load('services.xml');
    }
}
