# Sylius Static Contexts Bundle

[![Latest Version][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![Build Status][ico-github-actions]][link-github-actions]
[![Code Coverage][ico-code-coverage]][link-code-coverage]
[![Mutation testing][ico-infection]][link-infection]

Provides static channel and locale contexts for Sylius. This allows you to set the channel and locale programmatically instead of relying on HTTP request resolution — useful for CLI commands, message handlers, and testing.

Both contexts are registered at priority 256, so they take precedence over Sylius's default request-based contexts whenever a value is set.

## Requirements

- PHP >= 8.2
- Symfony ^6.4 || ^7.4
- Sylius v2

> For Sylius v1 support, use the `1.x` branch.

## Installation

```shell
composer require setono/sylius-static-contexts-bundle
```

## Usage

### Setting the channel

```php
use Setono\SyliusStaticContextsBundle\Context\StaticChannelContext;

final class YourCommand extends Command
{
    public function __construct(private readonly StaticChannelContext $channelContext)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Set by channel code (looks up the channel via the repository)
        $this->channelContext->setChannelCode('web_us');

        // Or set by channel object directly
        $this->channelContext->setChannel($channel);

        // Now any service that depends on ChannelContextInterface
        // will resolve to this channel
        // ...

        // Reset when done (also happens automatically via Symfony's ResetInterface)
        $this->channelContext->reset();

        return Command::SUCCESS;
    }
}
```

### Setting the locale

```php
use Setono\SyliusStaticContextsBundle\Context\StaticLocaleContext;

final class YourCommand extends Command
{
    public function __construct(private readonly StaticLocaleContext $localeContext)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->localeContext->setLocaleCode('en_US');

        // Now any service that depends on LocaleContextInterface
        // will resolve to this locale
        // ...

        $this->localeContext->reset();

        return Command::SUCCESS;
    }
}
```

[ico-version]: https://poser.pugx.org/setono/sylius-static-contexts-bundle/v/stable
[ico-license]: https://poser.pugx.org/setono/sylius-static-contexts-bundle/license
[ico-github-actions]: https://github.com/Setono/sylius-static-contexts-bundle/workflows/build/badge.svg
[ico-code-coverage]: https://codecov.io/gh/Setono/sylius-static-contexts-bundle/branch/2.x/graph/badge.svg
[ico-infection]: https://img.shields.io/endpoint?style=flat&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2FSetono%2Fsylius-static-contexts-bundle%2F2.x

[link-packagist]: https://packagist.org/packages/setono/sylius-static-contexts-bundle
[link-github-actions]: https://github.com/Setono/sylius-static-contexts-bundle/actions
[link-code-coverage]: https://codecov.io/gh/Setono/sylius-static-contexts-bundle
[link-infection]: https://dashboard.stryker-mutator.io/reports/github.com/Setono/sylius-static-contexts-bundle/2.x
