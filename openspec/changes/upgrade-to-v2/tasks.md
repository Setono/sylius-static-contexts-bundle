## 1. Branch Setup

- [x] 1.1 Create `1.x` branch from current master and push to origin
- [x] 1.2 Set `1.x` as the default branch on GitHub via `gh repo edit`
- [x] 1.3 Create `2.x` branch from master and push to origin
- [x] 1.4 Switch working tree to `2.x` branch

## 2. Composer Dependencies

- [x] 2.1 Update `require` section: PHP `>=8.2`, Symfony `^6.4 || ^7.4`, Sylius `^2.0`, service-contracts `^3.0`
- [x] 2.2 Update `require-dev`: `setono/code-quality-pack ^3.1`, `phpunit/phpunit ^11.0`, `phpspec/prophecy-phpunit ^2.5`, `matthiasnoback/symfony-dependency-injection-test ^6.3`, `shipmonk/composer-dependency-analyser ^1.8`
- [x] 2.3 Add new PHPStan extensions to `require-dev`: `phpstan/phpstan-symfony ^2.0`, `phpstan/phpstan-phpunit ^2.0`, `phpstan/phpstan-deprecation-rules ^2.0`
- [x] 2.4 Remove old packages from `require-dev`: `infection/infection`, `psalm/plugin-phpunit`, `psalm/plugin-symfony`
- [x] 2.5 Run `composer update` and verify it resolves successfully

## 3. Static Analysis Migration

- [x] 3.1 Delete `psalm.xml`
- [x] 3.2 Create `phpstan.neon` with level 9, paths `src`/`tests`, PHP 8.2, and extension includes (symfony, phpunit, strict-rules, deprecation-rules)
- [x] 3.3 Update `composer.json` `analyse` script from `psalm` to `phpstan analyse`
- [x] 3.4 Run `composer analyse` and fix any errors (or generate baseline if needed)

## 4. PHPUnit Upgrade

- [x] 4.1 Update `phpunit.xml.dist`: replace `<coverage>` element with `<source>` element (PHPUnit 11 format)
- [x] 4.2 Fix test suite name (currently says "Consent Bundle Test Suite" — should be "Static Contexts Bundle Test Suite")
- [x] 4.3 Run `composer phpunit` and verify all tests pass

## 5. Config File Updates

- [x] 5.1 Update `rector.php`: change `LevelSetList::UP_TO_PHP_81` to `UP_TO_PHP_82` (verify Rector v2 API compatibility)
- [x] 5.2 Update `infection.json.dist`: change stryker badge from `master` to `2.x`
- [x] 5.3 Update `.gitattributes`: replace `psalm.xml` with `phpstan.neon` in export-ignore list
- [x] 5.4 Update `ecs.php` if needed for code-quality-pack v3 compatibility

## 6. CI Workflow

- [x] 6.1 Update `.github/workflows/build.yaml` PHP matrix: `8.2`, `8.3`, `8.4`
- [x] 6.2 Update Symfony matrix: `~6.4.0`, `~7.4.0`
- [x] 6.3 Replace Psalm command with `vendor/bin/phpstan analyse` in static analysis job
- [x] 6.4 Update code coverage and mutation testing jobs for PHPUnit 11 / PHP 8.4

## 7. Documentation

- [x] 7.1 Update `CLAUDE.md` to reflect new version constraints, PHPStan instead of Psalm, and updated commands
