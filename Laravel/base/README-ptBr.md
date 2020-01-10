### Traduções
* [Inglês](README.md)

## Implantação

A aplicação pode ser impantada na AWS rodando:

```bash
make deploy
```

O comando `make deploy` é um script definido no arquivo Makefile do projeto.

Leia mais sobre na [Documentação oficial do Bref](https://bref.sh/docs/deploy.html).

## Desenvolvimento local

A aplicação pode ser rodada localmente usando o Docker. Start usando o comando:

```bash
docker-compose up
```
A aplicação pode ser testada em [http://localhost:8000/](http://localhost:8000/).
