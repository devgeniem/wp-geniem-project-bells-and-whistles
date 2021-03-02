# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [1.6.0] - 2021-03-02

### Added
- Remove the Site Health widget from the admin dashboard.

## [1.5.0] - 2021-01-29

### Added
- Disable Gutenberg default fullscreen mode.
- Disable Gutenberg core block patterns.
- Hide Gutenberg device preview options with CSS.

## [1.4.0] - 2020-02-13

### Added
- Fix a date format bug in WP Stream database queries.

## [1.3.0] - 2019-11-29

### Added
- A check for project tasks.cron newline at the end.
- A filter to remove no-cache headers from the 404 page.

## [1.2.0] - 2019-11-14

### Changed
- Disabling a feature is done by defining just the class name without the namespace.
- Update composer package name.

### Fixed
- Autoloading of DisableAdminEmailVerification.

## [1.1.0] - 2019-11-14

### Added
- Disabled periodical admin email verification with class name `DisableAdminEmailVerification`.

## [1.0.0] - 2019-11-14

### Added
- Initial plugin functionalities and documentation.
