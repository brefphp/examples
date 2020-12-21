# GitLab CI

## Requirements

* Existing bref project
* GitLab Account
* AWS Credentials with necessary permissions

## Credential Setup

The CI instance needs access to your AWS account during deployment, the simplest way to do this is by setting up custom environment variables. 

https://docs.gitlab.com/ee/ci/variables/README.html#create-a-custom-variable-in-the-ui

The following environment variables are required:

```
AWS_ACCESS_KEY_ID
AWS_SECRET_ACCESS_KEY
```

Optionally, if all your applications are in the same region you can setup the default region environment variable as well.

```
AWS_DEFAULT_REGION
```

## CI Configuration

GitLab CI is enabled by default on your project, you only need to add the necessary yaml configuration for it start running on each commit.

The provided [example configuration](.gitlab-ci.yml) will run CI on every commit. First it will install composer dependencies, then it will deploy your project to the dev stage.

Example Repo and CI Pipeline: https://gitlab.com/aknosis/bref-ci-example/-/pipelines/232026285


### Laravel

When deploying a Laravel application you must include the additional cache path as seen below. After a composer install Laravel will run package discovery and output some files that must be included at runtime. If you do not add this folder to the cache paths then the files generated will not persist when changing from the build to the deploy job and never exist as part of your deployment and cause some unexpected failures.

```
cache:
  paths:
    - vendor/
    - bootstrap/cache/
```