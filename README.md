
# CMS from scratch - Projet Annuel 3IW2

## Authors

- [@btnalexandre](https://www.github.com/btnalexandre)
- [@LouisAntoine](https://www.github.com/louisantoine)

## Environment Variables

To run this project, you will need to add the following environment variables to your .env file

#### SMTP or AWS SES credentials

`SMTP_USERNAME`
`SMTP_PASSWORD`
`SMTP_HOST`
`SMTP_PORT`

#### MySQL variables

`DB_NAME`
`DB_USER`
`DB_PWD`
`DB_DRIVER`
`DB_PORT`
`DB_HOST`
`DB_PREFIX`
## Run Locally

Clone the project

```bash
  git clone https://github.com/esgi-projets/projet-annuel-3iw2
```

Go to the project directory

```bash
  cd projet-annuel-3iw2
```

Install dependencies

```bash
  composer install
```

Run migrations

```bash
  composer migrate
```

Cancel migrations 

```bash
  composer migrate:down
```

## Deployment

To deploy this project locally run

```bash
  docker compose up
```




## Demo

Access to http://localhost directly after starting Docker.

