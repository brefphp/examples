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
```
name: Deploy master branch

on:
  push:
    branches:
      - master

jobs:
  deploy:
    name: deploy
    runs-on: ubuntu-latest
    strategy:
      matrix:
        node-version: [12.x]
    steps:
    - uses: actions/checkout@v2
    - name: Use Node.js ${{ matrix.node-version }}
      uses: actions/setup-node@v1
      with:
        node-version: ${{ matrix.node-version }}
    - run: npm ci
    - uses: shivammathur/setup-php@v2
      with:
        php-version: "7.4"
    - uses: "ramsey/composer-install@v1"
      with:
        composer-options: "--prefer-dist --optimize-autoloader --no-dev"
    - run: composer require bref/bref
    - name: serverless deploy
      uses: serverless/github-action@master
      with:
        args: deploy
      env:
        #SERVERLESS_ACCESS_KEY: ${{ secrets.SERVERLESS_ACCESS_KEY }}
        # or if using AWS credentials directly
        AWS_ACCESS_KEY_ID: ${{ secrets.AWS_ACCESS_KEY_ID }}
        AWS_SECRET_ACCESS_KEY: ${{ secrets.AWS_SECRET_ACCESS_KEY }}

```

## Deploy

* When you push to master branch serverless gets installed alongside with composer. Afterwards the contents of the master
branch will be deployed to the AWS environment configured by `serverless.yaml` using the provided AWS keys. 
