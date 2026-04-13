## Why

The bundle currently targets PHP 8.1+, Symfony 5.4/6.4, and Sylius v1. PHP 8.1 and Symfony 5.4 are end-of-life, Sylius v2 is the current major, and the project's static analysis tool (Psalm) has been replaced by PHPStan in the upstream `setono/code-quality-pack` v3. A new major version (2.x) aligns the bundle with the modern ecosystem.

## What Changes

- **BREAKING**: Minimum PHP version raised from 8.1 to 8.2
- **BREAKING**: Drop Symfony 5.4 support; require `^6.4 || ^7.4`
- **BREAKING**: Drop Sylius v1 support; require `sylius/channel` and `sylius/locale` `^2.0`
- Replace Psalm with PHPStan (level 9 + strict-rules + symfony/phpunit/deprecation-rules extensions)
- Upgrade `setono/code-quality-pack` from `^2.9` to `^3.1`
- Upgrade PHPUnit from `^9.6` to `^11.0`
- Upgrade Rector config from `UP_TO_PHP_81` to `UP_TO_PHP_82`
- Update CI matrix: PHP 8.2/8.3/8.4, Symfony ~6.4.0/~7.4.0
- Create `1.x` maintenance branch from current master before starting work

## Capabilities

### New Capabilities

(none — no new runtime capabilities are introduced)

### Modified Capabilities

(none — the bundle's interfaces and behavior are unchanged; Sylius v2 uses identical interfaces)

## Impact

- **Dependencies**: All `require` and `require-dev` constraints change. `infection/infection` moves from direct dev dependency to transitive via code-quality-pack v3. Psalm packages removed, PHPStan packages added.
- **Config files**: `psalm.xml` deleted, `phpstan.neon` created. `phpunit.xml.dist` updated for PHPUnit 11 format. `rector.php` updated for Rector v2 / PHP 8.2. `infection.json.dist` badge updated to `2.x`. `.gitattributes` updated.
- **CI**: `.github/workflows/build.yaml` updated with new PHP/Symfony matrix and PHPStan command.
- **Source code**: No changes needed — the Sylius channel/locale interfaces are identical between v1 and v2.
- **Git branches**: `1.x` branch created and set as GitHub default for maintenance; `2.x` branch for this work.
