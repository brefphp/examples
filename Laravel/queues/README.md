## Deployment

The application can be deployed to AWS by running:

```bash
composer install
npm install
php artisan config:clear
serverless deploy
```

Read more in [the Laravel Bridge documentation](https://github.com/brefphp/laravel-bridge#laravel-queues-with-sqs).
