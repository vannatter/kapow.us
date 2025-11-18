# Changelog

All notable changes to the Kapow.us project modernization.

## [2.0.0] - 2025-11-18

### Major Modernization Release

This release represents a comprehensive modernization of the Kapow.us platform from legacy 2014-2015 era technologies to modern standards.

### Added

#### Infrastructure
- **Composer** (`composer.json`) - PHP dependency management
- **npm/Webpack 5** (`package.json`, `webpack.config.js`) - Modern JavaScript build system
- **Docker** (`Dockerfile`, `docker-compose.yml`) - Containerized development environment
- **Environment Configuration** (`.env.example`) - Secure configuration management

#### Code Quality & Testing
- **PHPUnit** (`phpunit.xml`) - Unit and integration testing framework
- **PHPStan** (`phpstan.neon`) - Static analysis for PHP
- **PHP-CS-Fixer** - Code formatting (via Composer)
- **ESLint** (`.eslintrc.json`) - JavaScript linting
- **Prettier** (`.prettierrc`) - JavaScript code formatting
- **EditorConfig** (`.editorconfig`) - Consistent code formatting across editors

#### CI/CD
- **GitHub Actions** (`.github/workflows/ci.yml`) - Automated testing pipeline

#### Security
- **Dotenv Integration** - Environment-based configuration in `app/Config/bootstrap.php`
- **SECURITY.md** - Security vulnerability disclosure policy
- Google Maps API key moved to environment variables

#### Testing
- **UserTest.php** - Unit tests for User model validation
- **HomeControllerTest.php** - Integration tests for controllers

#### Documentation
- **README.md** - Comprehensive setup and development guide
- **MODERNIZATION.md** - Detailed migration notes and breaking changes
- **SECURITY.md** - Security incident documentation
- **CHANGELOG.md** - This file

### Changed

#### Dependencies
- **jQuery**: 1.11.3 → 3.7.1 (via CDN)
- **Bootstrap**: 3.3.5 → 5.3.2 (via CDN)
- **CakePHP**: 2.10.3 → 2.10.24 (latest 2.x)
- **PHP**: 5.x → 7.4+ support

#### Code Updates
- Replaced deprecated `Sanitize::clean()` with `sanitizeData()` in 11 controllers:
  - AdminController, CreatorsController, ItemsController, PublishersController
  - SearchController, SeriesController, ShopsController, UsersController
  - ReportsController, FlagsController, ImproveController
- Replaced short PHP tags (`<?`) with full tags (`<?php`) in view templates
- Updated `.bind()` to `.on()` in jQuery code (shops.js, shops.view.js)

#### Bootstrap 5 Compatibility
- `pull-left` → `float-start` (22 occurrences)
- `pull-right` → `float-end` (22 occurrences)
- `col-*-offset-*` → `offset-*-*`
- `divider` → `dropdown-divider` (9 occurrences)

#### Configuration
- `app/Config/database.php-default` - Now loads from environment variables
- `app/Config/core.php-default` - Security settings from environment
- Updated `.gitignore` with modern PHP/Node patterns

### Security

#### Fixed
- **CRITICAL**: Removed exposed Google Maps API key (`AIzaSyAf5DtChzuCwa8uGr4gehSrhklvVHjzKhk`)
  - Key was hardcoded in `app/View/Themed/Kapow/Layouts/default.ctp`
  - Now loaded from `GOOGLE_MAPS_API_KEY` environment variable
  - **ACTION REQUIRED**: Revoke exposed key and generate new one

#### Improved
- All sensitive configuration moved to environment variables
- Database credentials no longer in version control
- Security.salt and Security.cipherSeed configurable via .env

### Migration Guide

#### For Developers

1. **Install Dependencies**:
   ```bash
   composer install
   npm install
   ```

2. **Configure Environment**:
   ```bash
   cp .env.example .env
   # Edit .env with your settings
   ```

3. **Set Up Database Config** (if needed):
   ```bash
   cp app/Config/database.php-default app/Config/database.php
   cp app/Config/core.php-default app/Config/core.php
   ```

4. **Build Assets**:
   ```bash
   npm run build
   ```

5. **Run Tests**:
   ```bash
   composer test
   composer phpstan
   npm run lint:js
   ```

#### Breaking Changes

1. **Bootstrap 3 → 5**:
   - Many CSS class names changed
   - jQuery no longer required for Bootstrap components
   - Some components may need JavaScript updates

2. **jQuery 1.x → 3.x**:
   - `.bind()`, `.unbind()`, `.delegate()`, `.undelegate()` removed
   - `.size()` removed (use `.length`)
   - Some selector extensions work differently

3. **Configuration**:
   - `app/Config/database.php` and `app/Config/core.php` now read from environment
   - Must set up `.env` file or provide environment variables

### Known Issues

1. Bootstrap 5 dropdown toggles use `data-bs-toggle` instead of `data-toggle`
   - Some views may still use old attribute names
2. Custom CSS may need adjustments for new Bootstrap 5 class names
3. Legacy CodeKit configuration files still present (can be removed)

### Removed

- Hardcoded API keys from view templates
- Deprecated `Sanitize::clean()` method usage
- Short PHP tags (`<?`)
- Legacy CodeKit as primary build system (replaced with Webpack)

### Commits

This release includes 4 commits:

1. **2d61b19** - Initial modernization with dependencies and tooling
2. **7ec908b** - Bootstrap 5 and jQuery 3.x compatibility fixes
3. **fb9ae19** - Security: Removed exposed Google Maps API key
4. **33fbccd** - Environment configuration and testing infrastructure

### Statistics

- **Files Changed**: 60+
- **Insertions**: 1,500+
- **Deletions**: 200+
- **Controllers Updated**: 11
- **View Templates Updated**: 21
- **New Configuration Files**: 12
- **Test Files Created/Updated**: 2

### Next Steps

1. **Immediate**: Revoke exposed Google Maps API key
2. **Short-term**: Run application tests to verify all functionality
3. **Medium-term**: Review and update remaining Bootstrap 3 patterns
4. **Long-term**: Consider CakePHP 4 migration or API layer development

---

## [1.x] - Previous Versions

See git history for changes prior to modernization effort.
