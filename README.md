# Symfony Webhook Demo 🕸🪝

This repository is a demonstration application for Symfony Webhook usage. 

It's related to [🇫🇷 this blog post](https://jolicode.com/blog/symfony-webhook-et-remoteevent-ou-comment-simplifier-la-gestion-devenements-externes) on jolicode.com

## Pre-requisites

A ready to use (DNS entries verified) [Postmark account](https://postmarkapp.com/).

## Installation

Install dependencies

```shell
$ symfony composer install
```

Replace `API_KEY` with your API Key in .env file

```
MAILER_DSN=postmark+api://API_KEY@default
```

Start the database and run migrations

```shell
$ docker-compose up -d database
```

```shell
$ symfony console d:m:m -n
```

Serve the application

```shell
$ symfony serve -d
```

Open [127.0.0.1:8000](http://127.0.0.1:8000)
