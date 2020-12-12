# ekino

ekino is a project for my Laravel course for advanced users. Is created for
a [strefakursow.pl](https://strefakursow.pl/)

## Installation

Clone repository

```bash
$ git clone https://github.com/plumthedev/ekino.git ekino
```

Create `.env` file from prepared file. Complete data in your `.env` file if necessary.

```bash
$ cp .env.example .env
```

Install dependencies.

```bash
$ composer install && npm i
```

Generate Laravel application key.

```bash
$ php artisan key:generate --ansi
```

Migrate a database and seed it.

```bash
$ php artisan migrate:fresh --seed
```

Build Mix assets.

```bash
$ npm run dev
```

## Development

Watch Mix assets.

```bash
$ npm run watch
```

## Deployment

Make sure your `.env` file.

```bash
APP_ENV=production
APP_DEBUG=false
```

Clean your old cache values.

```bash
$ php artisan cache:clear && php artisan config:clear && php artisan route:clear
```

Cache new values to speed up your application.

```bash
$ php artisan config:cache && php artisan route:cache && php php artisan optimize
```

Build Mix assets.

```bash
$ npm run prod
```

Generate Composer optimized autoloader.

```bash
$ composer install --no-dev --optimize-autoloader
```

## Using Docker

It is possible to use docker with this application. It's all thanks by [Laradock](https://laradock.io/) and some unix
hacks :)

You can start up Docker containers by

```bash
$ ./develop start
```

To stop up Docker containers by

```bash
$ ./develop stop
```

To communicate with artisan in Docker you need to type

```bash
$ ./develop artisan <artisan-command-here>
```

```bash
$ ./develop artisan migrate:fresh --seed
```

To communicate with Composer in Docker you need to type

```bash
$ ./develop composer <composer-command-here>
```

```bash
$ ./develop composer install
```

You can review `develop` file to get more cool hacks with Docker.  
Laradock is stored in `storage/laradock`

