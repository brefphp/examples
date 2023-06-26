# Requirements

* Github repository
* Application configured to deploy with serverless brefphp

# Step by step

## Github Configuration

* Go to the "Repository -> Settings -> Secrets" menu and add the following keys:
    - Add the variables
        * AWS_ACCESS_KEY_ID: Access Key ID
        * AWS_SECRET_ACCESS_KEY: Secret Key
  
## Project configuration

* Go to "Repository -> Actions -> Setup a workflow yourself" and paste the following contents:
* Note, this script will deploy to the prod stage
```
name: Deploy to AWS Lambda

on:
  push:
    branches:
      - master

jobs:
  deploy:
    name: deploy
    runs-on: ubuntu-latest
    steps:
      # This step checks out a copy of your repository.
      - name: Checkout code
        uses: actions/checkout@v3

      # This step sets up Node.js environment.
      - name: Setup Node.js
        uses: actions/setup-node@v3

      # This step installs the Serverless Framework globally.
      - name: Install Serverless Framework
        run: npm install -g serverless

      # This step sets up PHP environment with the specified version.
      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: "8.1"

      # This step installs Composer dependencies with the specified options.
      - name: Install Composer dependencies
        uses: "ramsey/composer-install@v2"
        with:
          composer-options: "--prefer-dist --optimize-autoloader --no-dev"

      # This step deploys your application to AWS Lambda using the Serverless Framework.
      - name: Deploy to AWS Lambda
        uses: serverless/github-action@v3
        with:
          args: deploy --stage=prod
        env:
          AWS_ACCESS_KEY_ID: ${{ secrets.AWS_ACCESS_KEY_ID }}
          AWS_SECRET_ACCESS_KEY: ${{ secrets.AWS_SECRET_ACCESS_KEY }}

```

## Deploy

* When you push to master branch serverless gets installed alongside with composer. Afterwards the contents of the master
branch will be deployed to the AWS environment configured by `serverless.yaml` using the provided AWS keys. 
