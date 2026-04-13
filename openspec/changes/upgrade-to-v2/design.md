## Context

The bundle provides static channel/locale contexts for Sylius. It has minimal source code (2 context classes, 1 extension, 1 bundle class, 1 XML service config). The upgrade is primarily a dependency and tooling modernization — no runtime behavior changes.

Current state:
- PHP >=8.1, Symfony ^5.4 || ^6.4, Sylius v1
- Psalm for static analysis, PHPUnit 9, Rector v1
- CI tests against PHP 8.1–8.3

## Goals / Non-Goals

**Goals:**
- Support PHP 8.2+, Symfony 6.4/7.4, Sylius v2
- Replace Psalm with PHPStan (aligned with code-quality-pack v3)
- Modernize test and CI tooling (PHPUnit 11, Rector v2)
- Preserve a `1.x` maintenance branch for existing users

**Non-Goals:**
- Adding new runtime features or changing bundle behavior
- Supporting both Sylius v1 and v2 simultaneously (clean break)
- Migrating to `AbstractBundle` (can be done later)
- Rewriting tests away from Prophecy (still supported in PHPUnit 11)

## Decisions

### 1. Branch strategy: create `1.x` then `2.x`

Create `1.x` from current master, push it, set as GitHub default branch. Then create `2.x` for the upgrade work. This preserves the existing release line for bug fixes.

**Alternative considered**: Working directly on master. Rejected because existing Sylius v1 users need a stable branch for patches.

### 2. Drop Sylius v1 entirely (not dual-support)

Require `sylius/channel ^2.0` and `sylius/locale ^2.0` only. No `^1.0 || ^2.0`.

**Rationale**: This is a major version bump of the bundle. Users on Sylius v1 stay on `1.x`. Dual-support adds CI matrix complexity for no practical benefit since Sylius v1 is being phased out.

### 3. Use `setono/code-quality-pack ^3.1` as the anchor

The pack bundles PHPStan core, strict-rules, infection, rector v2, ECS, and composer-normalize. This reduces direct dev dependencies and centralizes version management.

**Additional PHPStan extensions required** (not in the pack):
- `phpstan/phpstan-symfony ^2.0`
- `phpstan/phpstan-phpunit ^2.0`
- `phpstan/phpstan-deprecation-rules ^2.0`

### 4. PHPStan level 9 (equivalent to Psalm level 1)

Level 9 is PHPStan's strictest. Combined with `phpstan-strict-rules` (from the pack), this matches the rigor of Psalm level 1. A baseline file can be generated if needed, but given the small codebase it likely won't be necessary.

### 5. PHPUnit 11 (not 10 or 12)

PHPUnit 11 requires PHP >=8.2, which aligns with our new minimum. PHPUnit 10 is already EOL. PHPUnit 12 requires PHP >=8.3 which would unnecessarily narrow the supported range. `phpspec/prophecy-phpunit ^2.5` supports PHPUnit 11, so no test rewrites needed.

### 6. Symfony service-contracts ^3.0 only

Drop `^1.1 || ^2.0` support. Symfony 6.4 and 7.4 both use service-contracts v3. No reason to carry older constraints.

### 7. `infection/infection` becomes transitive

The pack v3 bundles infection. Remove it from direct `require-dev` to avoid version conflicts.

## Risks / Trade-offs

- **[Risk] PHPStan may report new errors Psalm didn't catch** → Generate a baseline if needed; the codebase is small enough to likely fix all issues directly.
- **[Risk] Rector v2 config API changes** → Verify `rector.php` syntax works with Rector v2 after install. The `RectorConfig` callback style should be unchanged but `LevelSetList` import may differ.
- **[Risk] `setono/code-quality-pack` v3.1 not yet on Packagist** → User has just released it; verify it resolves before running composer update.
- **[Trade-off] Clean Sylius v2 break vs. dual-support** → Users on Sylius v1 must stay on bundle 1.x. This is acceptable for a major version.
