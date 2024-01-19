# Bref with AWS SAM

This project shows a simple example of how to deploy a serverless application using only the [AWS SAM tools](https://docs.aws.amazon.com/serverless-application-model/latest/developerguide/what-is-sam.html). It does not require the Serverless framework or Node to run. Everything here can be built and deployed with Composer commands. 

## Installation
1. [Install Docker Desktop](https://www.docker.com/products/docker-desktop/)
2. [Install the AWS SAM Cli](https://docs.aws.amazon.com/serverless-application-model/latest/developerguide/install-sam-cli.html)
3. Install [Make](https://www.gnu.org/software/make/)
4. Run `composer install`
5. Run `composer invoke:helloWorld` to build and invoke the lambda function locally

## Composer Commands
The following composer commands are convenience wrappers for the AWS SAM Cli: 
* `composer build`: Builds the app that is defined in the [template](template.yaml).
* `composer invoke:helloWorld`: Builds and invokes the Hello World lambda function.
* `composer start:lambda`: Creates a full, lambda-like environment for the serverless app. 
  * `invoke:lambda:helloWorld`: After the above start command is called, this will invoke the lambda running in the docker container. 
* `composer start:docker:helloWorld`: Runs the docker containers defined in the [docker-compose](docker-compose.yml) file.
  * `composer invoke:docker:helloWorld`: After the above start command is called, this will invoke the lambda running in the docker container.

## Build Process
The template defines a [custom runtime](https://docs.aws.amazon.com/serverless-application-model/latest/developerguide/building-custom-runtimes.html) for each lambda function. By default `make` is used to build them with a target of the form `build-[function name]`. See the [Makefile](Makefile) for a generic approach. Any other code, config files, or additional resources can be copied over in the build target. 

## Development with Docker
The [docker compose file](docker-compose.yml) shows an example of how to mount your local code into the container for rapid development. Once the containers are started, they can be restarted after any code changes for immediate, local testing. 

You can see this in action with the following steps: 
1. Run `composer start:docker:helloWorld`
2. Modify the [code](src/Handlers/HelloWorldHandler.php)
3. Restart the container
4. Run `composer invoke:docker:helloWorld` to see the immediate change. 

Using this technique can save time by not requiring a re-build of the application after every code change. 