# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Symfony bundle (`setono/sylius-static-contexts-bundle`) that provides static channel and locale contexts for Sylius. This allows setting channel/locale programmatically rather than relying on HTTP request resolution — useful for CLI commands, background jobs, and testing.

Services are registered with Sylius context tags at priority 256, so they take precedence in Sylius's context resolution chain when a value is set.

## Commands

```bash
# Run tests
composer phpunit            # or: vendor/bin/phpunit
vendor/bin/phpunit tests/Context/StaticChannelContextTest.php   # single test file
vendor/bin/phpunit --filter testMethodName                      # single test method

# Static analysis (PHPStan, level 9)
composer analyse

# Coding standards (ECS via setono/code-quality-pack)
composer check-style        # check only
composer fix-style          # auto-fix

# Mutation testing
vendor/bin/infection
```

## Architecture

- **`src/Context/StaticChannelContext.php`** — Implements `ChannelContextInterface` + `ResetInterface`. Stores a channel instance; supports setting by object or by channel code (via repository lookup). Throws `ChannelNotFoundException` when unset.
- **`src/Context/StaticLocaleContext.php`** — Implements `LocaleContextInterface` + `ResetInterface`. Stores a locale code string. Throws `LocaleNotFoundException` when unset.
- **`config/services.php`** — Registers both contexts as Sylius-tagged services. `StaticChannelContext` receives the `sylius.repository.channel` injection.
- **`src/DependencyInjection/SetonoSyliusStaticContextsExtension.php`** — Standard Symfony extension loading PHP config.

## Testing

Tests use PHPUnit 11 with Prophecy for mocking. Test classes mirror the `src/Context/` structure under `tests/Context/`.

## Quality Constraints

- PHP >=8.2, Symfony ^6.4 || ^7.4, Sylius v2
- PHPStan level 9 (strictest) with strict-rules, symfony, phpunit, deprecation-rules, and prophecy extensions
- Mutation testing: min MSI 66.67%, min covered MSI 94.74%
- CI matrix tests against PHP 8.2–8.4 with both lowest and highest dependency versions

## Tool Preferences

- Always use `jq` for JSON parsing (never `python3 -m json.tool`)
