# Symfony Hello world com SQS

### Translations
* [Ingês](Readme.md)

# Pré-requisitos

Antes de começarmos, precisamos configurar a QUEUE. 
Bref trabalha com filas FIFO e filas normais. 
Tente criar uma nova fila normal SQS, nomeie-o como "foobar" e clique em "criação rápida".

- Exemplo de ARN da fila: **arn:aws:sqs:us-east-1:403367587399:foobar**
- Exemplo de URL da fila: **https://sqs.us-east-1.amazonaws.com/403367587399/foobar**

# Instalação

```
composer install
```

Adiciona a URL da fila no arquivo `serverless.yml` na sessão de environment.
E adicione o ARN da fila no arquivo `serverless.yml` na sessão de worker.

# Deploy

```
# Crie um arquivo .env.local.php com os valores de dev
composer dump-env prod
composer install --prefer-dist --optimize-autoloader --no-dev
bin/console cache:warm --env=prod --no-debug

# Crie um .env.local.php vazio para forçar o uso de variáveis ​​de ambiente
echo "<?php return ['APP_ENV'=>'prod'];" > .env.local.php
serverless deploy
rm .env.local.php
```

A última coisa que precisamos fazer é permitir o acesso de gravação à fila.

1. Acesse o IAM no console da AWS
2. Clique em "Roles" na barra lateral esquerda
3. Encontre as roles para este aplicativo Lambda e clique nele. Provavelmente algo como "bref-demo-sqs"
4. Agora clique em "Attach policy" e localize "SQSFullAccess" na lista. Depois de adicionar essa política, você estará pronto.

Obviamente, você pode ser mais restritivo com a política a ser adicionada.