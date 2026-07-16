# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

History prior to `10.0.0` is not tracked here, since that release was a full rewrite from scratch.

## [Unreleased]

## [10.0.1] - 2026-07-16

### Added

- `Trimmer::MAX_DEPTH` (`512`, matching PHP's own `json_decode()` / `json_encode()` default) is now enforced; an array nested deeper than that throws `OverflowException` instead of risking a stack overflow.
- Composer (dev) dependencies are now tracked by Dependabot, in addition to GitHub Actions.

### Changed

- `trim()`, `ltrim()`, `rtrim()`, `trimStart()`, and `trimEnd()` now declare Psalm conditional return types, so passing a `string` or `array` resolves to that type instead of `mixed` for static analysis and IDE tooling.

### Fixed

- `composer.json`'s `support.issues` / `support.source` URLs pointed at a nonexistent repository (`bvp-trimmer`) instead of the actual one (`trimmer`).

## [10.0.0] - 2026-07-12

### Added

- Initial release following a full rewrite of the library.

[Unreleased]: https://github.com/boatracevibeproject/trimmer/compare/10.0.1...HEAD
[10.0.1]: https://github.com/boatracevibeproject/trimmer/compare/10.0.0...10.0.1
[10.0.0]: https://github.com/boatracevibeproject/trimmer/releases/tag/10.0.0
