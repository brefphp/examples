Read the [Bref Laravel documentation](https://bref.sh/docs/frameworks/laravel.html) and make sure you have [everything to get started](https://bref.sh/docs/installation.html) first.

## Setup

First, install the dependencies:

```bash
composer install --optimize-autoloader
```

Next, [create a PlanetScale account](https://planetscale.com/) and create a new database.

Finally, set up the database settings in `.env`:

```bash
DB_CONNECTION=mysql
DB_HOST=<host url>
DB_PORT=3306
DB_DATABASE=<database name>
DB_USERNAME=<user>
DB_PASSWORD=<password>
```

## Deployment

The application can be deployed on AWS by running:

```bash
php artisan config:clear

serverless deploy
```

Now that Laravel is deployed, we can run `php artisan migrate` in AWS Lambda to set up our tables:

```bash
serverless bref:cli --args="migrate --force"
```

For our demo, we can also seed the database with fake users:

```bash
serverless bref:cli --args="migrate:fresh --seed --force"
```

## Learn more

Read more about Laravel on Lambda in [the official Bref documentation](https://bref.sh/docs/frameworks/laravel.html).
