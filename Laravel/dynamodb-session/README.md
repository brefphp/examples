# Laravel 6.* - Use DynamoDB for session or/and cache

## Configuration

### Initial configuration

Read the Bref documentation about Laravel : https://bref.sh/docs/frameworks/laravel.html

### DynamoDB Resource

Look the file `serverless.yml`

#### Resources

First create the resource for your DynamoDB Table :

```yaml
resources: # CloudFormation template syntax from here on.
  Resources:
    laravelTable:
      Type: AWS::DynamoDB::Table
      Properties:
        TableName: laravelTable #Change with your table name
        AttributeDefinitions:
          - AttributeName: key #Primary key name used by the Laravel framework
            AttributeType: S
        KeySchema:
          - AttributeName: key
            KeyType: HASH
        TimeToLiveSpecification:
            AttributeName: expires_at #Key used for the expiration date
            Enabled: true
        ProvisionedThroughput:
          ReadCapacityUnits: 1 #Adapt provisioning capacity according to your needs
          WriteCapacityUnits: 1
```

#### IAM Role Statements

Declare the `iamRoleStatements` for your DynamoDB Table :

```yaml
provider:
    ...
    iamRoleStatements:
      - Effect: "Allow"
        Action:
          - dynamodb:Query
          - dynamodb:Scan
          - dynamodb:GetItem
          - dynamodb:PutItem
          - dynamodb:UpdateItem
          - dynamodb:DeleteItem
        Resource:
          Fn::GetAtt:
            - laravelTable
            - Arn
```

#### Environment variables

Declare your environment variable

```yaml
provider:
    ...
    environment:
      APP_ENV: production
      APP_DEBUG: true # set to false when moving to production
      LOG_CHANNEL: stderr # this will send logs to CloudWatch automatically
      SESSION_DRIVER: dynamodb # used the dynamodb driver to store the session data
      VIEW_COMPILED_PATH: /tmp/storage/framework/views
      CACHE_DRIVER: dynamodb # eventually, you can used the dynamodb driver to store the cache data
      CACHE_STORE: dynamodb # used the dynamodb cache store
      DYNAMODB_CACHE_TABLE: laravelTable
```

#### Finale serverless.yml file

```yaml
service: app

provider:
    name: aws
    region: us-east-1
    runtime: provided
    iamRoleStatements:
      - Effect: "Allow"
        Action:
          - dynamodb:Query
          - dynamodb:Scan
          - dynamodb:GetItem
          - dynamodb:PutItem
          - dynamodb:UpdateItem
          - dynamodb:DeleteItem
        Resource:
          Fn::GetAtt:
            - laravelTable
            - Arn
    environment:
      APP_ENV: production
      APP_KEY: base64:FQKkzq8bh6GjE5XnTnm8JXgOTqUYMfQ6BNLR234d9lw=
      APP_DEBUG: true # set to false when moving to production
      LOG_CHANNEL: stderr # this will send logs to CloudWatch automatically
      SESSION_DRIVER: dynamodb # to avoid writing sessions to disk
      VIEW_COMPILED_PATH: /tmp/storage/framework/views
      CACHE_DRIVER: dynamodb
      CACHE_STORE: dynamodb
      DYNAMODB_CACHE_TABLE: laravelTable

# Exclude files from deployment
package:
  exclude:
    - node_modules/**
    - public/storage
    - storage/**
    - tests/**
    - .env*

plugins:
  - ./vendor/bref/bref

functions:
    api:
        handler: public/index.php
        description: ''
        timeout: 28 # in seconds (API Gateway has a timeout of 29 seconds)
        layers:
          - ${bref:layer.php-74-fpm}
        events:
          - httpApi: '*'

resources: # CloudFormation template syntax from here on.
  Resources:
    laravelTable:
      Type: AWS::DynamoDB::Table
      Properties:
        TableName: laravelTable
        AttributeDefinitions:
          - AttributeName: key
            AttributeType: S
        KeySchema:
          - AttributeName: key
            KeyType: HASH
        TimeToLiveSpecification:
            AttributeName: expires_at
            Enabled: true
        ProvisionedThroughput:
          ReadCapacityUnits: 1
          WriteCapacityUnits: 1
```
