## Deployment

The application can be deployed on AWS by running:

```bash
make deploy
```

The `make deploy` command is a script defined in the `Makefile` of the project.

Read more in [the official Bref documentation](https://bref.sh/docs/deploy.html).

## Local development

The application can be run locally using Docker. Start it by running:

```bash
docker-compose up
```

The application is then available at [http://localhost:8000/](http://localhost:8000/).
