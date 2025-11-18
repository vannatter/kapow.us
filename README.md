# Kapow.us

Kapow! is creating a new platform for finding, tracking and interacting with your favorite comics, publishers, artists and local comic shops.

## Technology Stack

- **Backend**: CakePHP 2.10.24, PHP 7.4+
- **Frontend**: jQuery 3.7.1, Bootstrap 5.3.2
- **Database**: MySQL 8.0
- **Build Tools**: Webpack 5, Babel, Sass

## Prerequisites

- PHP 7.4 or higher
- Composer
- Node.js 18+ and npm
- MySQL 8.0
- Docker and Docker Compose (optional, but recommended)

## Quick Start with Docker

The easiest way to get started is using Docker:

```bash
# Clone the repository
git clone <repository-url>
cd kapow.us

# Copy environment file
cp .env.example .env

# Start Docker containers
docker-compose up -d

# Install PHP dependencies
docker exec -it kapow_web composer install

# Install Node dependencies (on your host machine)
npm install

# Build frontend assets
npm run build

# Access the application
open http://localhost:8080
```

## Manual Setup

If you prefer not to use Docker:

### 1. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### 2. Configure Database

```bash
# Copy and configure database settings
cp app/Config/database.php-default app/Config/database.php
# Edit app/Config/database.php with your MySQL credentials

# Copy and configure core settings
cp app/Config/core.php-default app/Config/core.php
# Edit app/Config/core.php and update Security.salt and Security.cipherSeed
```

### 3. Set Up Environment

```bash
# Copy environment file
cp .env.example .env
# Edit .env with your configuration
```

### 4. Build Frontend Assets

```bash
# Development build with watch mode
npm run dev

# Production build
npm run build
```

### 5. Set Up Web Server

Configure your web server (Apache/Nginx) to point to `app/webroot` directory.

For Apache, ensure mod_rewrite is enabled and the .htaccess files are being read.

## Development

### Available Commands

```bash
# PHP
composer install          # Install PHP dependencies
composer test            # Run PHPUnit tests
composer phpstan         # Run static analysis
composer cs-fix          # Fix code style

# JavaScript
npm install              # Install Node dependencies
npm run dev             # Development build with watch
npm run build           # Production build
npm run lint:js         # Lint JavaScript
npm run format          # Format code with Prettier
```

### Code Quality

This project uses several tools to maintain code quality:

- **PHPUnit**: Unit and integration testing
- **PHPStan**: Static analysis for PHP
- **PHP-CS-Fixer**: Code style fixing
- **ESLint**: JavaScript linting
- **Prettier**: Code formatting

Run these tools before committing code:

```bash
composer test
composer phpstan
npm run lint:js
```

### Project Structure

```
kapow.us/
├── app/
│   ├── Config/         # Configuration files
│   ├── Controller/     # Application controllers
│   ├── Model/          # Data models
│   ├── View/           # View templates
│   ├── Plugin/         # CakePHP plugins
│   └── webroot/        # Public web directory
├── lib/                # CakePHP core
├── vendor/             # Composer dependencies
├── node_modules/       # NPM dependencies
├── composer.json       # PHP dependencies
├── package.json        # Node dependencies
├── webpack.config.js   # Webpack configuration
└── docker-compose.yml  # Docker configuration
```

## Modernization

This project has been recently modernized from legacy CakePHP 2.10.3. See [MODERNIZATION.md](MODERNIZATION.md) for details about:

- Updated dependencies (jQuery 3.x, Bootstrap 5)
- Modern build tools (Webpack, Babel)
- Development environment (Docker)
- Code quality tools (PHPUnit, PHPStan, ESLint)
- Migration notes and breaking changes

## Testing

```bash
# Run all tests
composer test

# Run specific test
./vendor/bin/phpunit app/Test/Case/Model/UserTest.php

# Run with coverage
./vendor/bin/phpunit --coverage-html coverage/
```

## Deployment

1. Build production assets: `npm run build`
2. Clear CakePHP cache: `rm -rf app/tmp/cache/*`
3. Set proper file permissions for `app/tmp` directory
4. Update environment variables in `.env`
5. Run database migrations if any
6. Deploy to your web server

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Run tests and linters
5. Submit a pull request

## Support & Links

- [Homepage](http://kapow.us/)
- [Facebook](https://www.facebook.com/kapow.us)
- [Twitter](https://twitter.com/kapowus)

## License

[Add your license information here]