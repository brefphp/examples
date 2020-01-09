## To install

Install the dependencies
```
composer install
```

Copy the sample `.env` file
```
cp .env.example .env
```

## Local test

Run curl call on terminal
```
curl -X GET http://localhost:8000/api/test -H 'Accept: application/json'
```

## Deploy

```
composer install --prefer-dist --optimize-autoloader --no-dev
```

```
serverless deploy
```