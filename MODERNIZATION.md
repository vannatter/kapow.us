# Kapow.us Modernization Guide

This document outlines the modernization efforts applied to the Kapow.us project and provides instructions for developers working with the updated codebase.

## Overview

The Kapow.us project has been modernized from a legacy CakePHP 2.10.3 application (circa 2014-2015) to support modern development practices and tooling.

## What Changed

### 1. Dependency Management

#### Composer (PHP)
- **Added**: `composer.json` for PHP dependency management
- **Dependencies**:
  - CakePHP 2.10.24 (latest 2.x version)
  - PHP 7.4+ support
  - vlucas/phpdotenv for environment configuration
- **Dev Dependencies**:
  - PHPUnit 9.5 for testing
  - PHPStan for static analysis
  - PHP-CS-Fixer for code formatting

**Installation**:
```bash
composer install
```

#### NPM (JavaScript)
- **Added**: `package.json` for JavaScript dependency management
- **Build System**: Webpack 5 with Babel
- **Updated Dependencies**:
  - jQuery: 1.11.3 → 3.7.1
  - Bootstrap: 3.3.5 → 5.3.2
- **Dev Tools**:
  - ESLint for JavaScript linting
  - Prettier for code formatting
  - Sass for CSS preprocessing

**Installation**:
```bash
npm install
```

**Build Commands**:
```bash
npm run dev      # Development build with watch mode
npm run build    # Production build
npm run lint:js  # Lint JavaScript files
npm run format   # Format JavaScript with Prettier
```

### 2. Development Environment

#### Docker Support
- **Added**: `Dockerfile` and `docker-compose.yml`
- **Services**:
  - Web server (Apache + PHP 7.4)
  - MySQL 8.0 database
  - phpMyAdmin for database management

**Usage**:
```bash
# Start services
docker-compose up -d

# Access application
http://localhost:8080

# Access phpMyAdmin
http://localhost:8081

# Stop services
docker-compose down
```

#### Environment Configuration
- **Added**: `.env.example` for environment variables
- **Setup**:
```bash
cp .env.example .env
# Edit .env with your configuration
```

### 3. Frontend Updates

#### jQuery
- **Old**: 1.11.3 (CDN)
- **New**: 3.7.1 (CDN)
- **Breaking Changes**: See [jQuery 3.x migration guide](https://jquery.com/upgrade-guide/3.0/)
- **Location**: `app/View/Themed/Admin/Layouts/default.ctp`

#### Bootstrap
- **Old**: 3.3.5
- **New**: 5.3.2
- **Breaking Changes**: Bootstrap 5 removed jQuery dependency
  - Use native JavaScript for Bootstrap components
  - Many class names changed (e.g., `pull-left` → `float-start`)
  - See [Bootstrap 5 migration guide](https://getbootstrap.com/docs/5.3/migration/)
- **Location**: `app/View/Themed/Admin/Layouts/default.ctp`

### 4. Code Quality Tools

#### PHPUnit
- **Configuration**: `phpunit.xml`
- **Run tests**: `composer test` or `./vendor/bin/phpunit`

#### PHPStan
- **Run analysis**: `composer phpstan` or `./vendor/bin/phpstan analyse app`

#### PHP-CS-Fixer
- **Fix code style**: `composer cs-fix` or `./vendor/bin/php-cs-fixer fix`

#### ESLint
- **Configuration**: `.eslintrc.json`
- **Run linter**: `npm run lint:js`

#### Prettier
- **Configuration**: `.prettierrc`
- **Format code**: `npm run format`

### 5. Build System

#### Webpack
- **Configuration**: `webpack.config.js`
- **Output**: `app/webroot/dist/`
- **Features**:
  - Babel transpilation for modern JavaScript
  - Sass compilation
  - CSS extraction and minification
  - Code splitting

**Note**: The legacy CodeKit build system (codekit-config.json) is still present but should be migrated to Webpack.

### 6. Git Configuration

#### Updated `.gitignore`
- Added entries for:
  - `/vendor/` (Composer)
  - `/node_modules/` (NPM)
  - `.env` files
  - Build artifacts (`/app/webroot/dist/`)
  - Test coverage reports
- Organized with comments for clarity

## Migration Tasks

### Completed ✅
- [x] Add Composer for PHP dependency management
- [x] Add package.json and modern npm build tools
- [x] Add .gitignore for modern PHP/Node projects
- [x] Add environment configuration with .env support
- [x] Add Docker configuration for development
- [x] Add PHPUnit for testing framework
- [x] Update jQuery from 1.11.3 to 3.x
- [x] Update Bootstrap from 3.3.5 to 5.x

### Remaining Tasks 🚧

#### High Priority
1. **Replace deprecated `Sanitize::clean()` calls**
   - CakePHP deprecated this utility
   - Replace with proper validation and filtering
   - Affected files: 11 controllers

2. **Update PHP code to modern syntax**
   - Add type hints to function parameters and return types
   - Use null coalescing operator (`??`) instead of ternary checks
   - Replace short PHP tags (`<?`) with full tags (`<?php`)
   - Use visibility keywords (`public`, `private`, `protected`)

3. **Create comprehensive test suite**
   - Add unit tests for models
   - Add integration tests for controllers
   - Target: >70% code coverage

#### Medium Priority
4. **Migrate from CakePHP 2 to CakePHP 4**
   - Major breaking changes
   - Significant refactoring required
   - Consider: Freeze features on CakePHP 2 or plan phased migration

5. **Replace jQuery with modern JavaScript**
   - Consider vanilla JavaScript or lightweight alternatives (Alpine.js, htmx)
   - Many operations no longer need jQuery

6. **Create REST API layer**
   - Decouple frontend from backend
   - Enable mobile app or SPA frontend
   - Add OpenAPI/Swagger documentation

#### Low Priority
7. **Replace TinyMCE with modern editor**
   - Options: Quill, Tiptap, ProseMirror

8. **Set up CI/CD pipeline**
   - GitHub Actions or GitLab CI
   - Automated testing and deployment

9. **Add monitoring and logging**
   - Application performance monitoring
   - Error tracking (e.g., Sentry)

## Known Issues

### Bootstrap 3 → 5 Migration
The admin layout has been updated to Bootstrap 5, but:
- Custom CSS may need adjustment for new class names
- Some components may not work without JavaScript updates
- Check all admin pages for layout issues

### jQuery 1.x → 3.x Migration
jQuery 3.x has breaking changes:
- `.size()` removed (use `.length`)
- `.bind()`, `.unbind()`, `.delegate()`, `.undelegate()` removed
- Selector extensions removed (`:visible`, `:hidden` work differently)
- Check custom JavaScript for compatibility issues

### Sanitize::clean() Deprecation
`Sanitize::clean()` is used in 11 controllers and should be replaced:
- Use `filter_var()` for basic sanitization
- Use CakePHP's validation framework
- Use `htmlspecialchars()` for output escaping

## Development Workflow

### Setup
1. Clone repository
2. Copy `.env.example` to `.env` and configure
3. Run `composer install`
4. Run `npm install`
5. Start Docker: `docker-compose up -d`
6. Access app at http://localhost:8080

### Daily Development
1. Make code changes
2. Run linters: `npm run lint:js` and `composer phpstan`
3. Run tests: `composer test`
4. Build frontend: `npm run build`
5. Commit changes

### Best Practices
- Write tests for new features
- Use type hints in PHP code
- Follow PSR-12 coding standard
- Use meaningful commit messages
- Keep dependencies up to date

## Resources

- [CakePHP 2.x Documentation](https://book.cakephp.org/2.0/en/index.html)
- [jQuery 3.x Documentation](https://api.jquery.com/)
- [Bootstrap 5 Documentation](https://getbootstrap.com/docs/5.3/)
- [Webpack Documentation](https://webpack.js.org/)
- [Docker Documentation](https://docs.docker.com/)

## Support

For questions or issues related to modernization:
1. Check this document first
2. Review commit history for examples
3. Consult official documentation
4. Create an issue in the project repository

---

**Last Updated**: 2025-11-18
