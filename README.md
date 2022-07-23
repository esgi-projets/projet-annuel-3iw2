
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

## Design Patterns

- **Singleton** : https://github.com/esgi-projets/projet-annuel-3iw2/blob/develop/www/Core/BaseSQL.class.php

  Pertinent pour éviter de multiples appels à la base de données et d'avoir une classe abstraite pour save, populate et gérer nos querys SQL.

  Utilisé sur l'ensemble du projet avec des extends sur tous les **Models**

- **Builder** : https://github.com/esgi-projets/projet-annuel-3iw2/blob/develop/www/Core/MySQLBuilder.class.php et https://github.com/esgi-projets/projet-annuel-3iw2/blob/develop/www/Core/QueryBuilder.class.php

  Très utile pour créer les requêtes SQL en une ligne et permet un gain de temps sans précédent !

  Les requêtes générées nécessitent tout de même un prepare() pour des raisons de sécurités 🙃

  Utilisé ici : https://github.com/esgi-projets/projet-annuel-3iw2/blob/develop/www/Core/BaseSQL.class.php#L152

- **Observer** : N'étant que deux personnes dans le projet annuel et ayant des deadlines assez serré nous n'avons pas eu le temps de réaliser un Observer pertinent pour notre projet et nous nous en excusons 🙁

- **Deuxième Builder** : https://github.com/esgi-projets/projet-annuel-3iw2/blob/develop/www/Core/Email.class.php Email et EmailBuilder

  Permet l'envoi des emails sur les commandes, les confirmations d'inscription, réinitialisation de mot de passe, etc..

  Utilisé ici : https://github.com/esgi-projets/projet-annuel-3iw2/blob/develop/www/Controller/User.class.php#L116-L132
