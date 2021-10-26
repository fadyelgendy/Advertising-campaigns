# Simple application for managing Advertising campaigns.

This application allows you to create, edit and view your created ads campaigns.
also, it allows users to register and create thier own account to track thier ads campagins.

## Tecnologies used:

-   Backend:
    -   Laravel as API
    -   Sanctum pakage as athentication package.
    -   nginx as server
    -   mysql as database driver
    -   redis as cache engine
-   Frontend:
    -   Vuejs
    -   Vue-router
    -   Vuex
    -   vue-persistedState
    -   vue-fontawesome
    -   vue2-dropzone
-   Environment:
    -   Docker
    -   Laradock
    -   npm

## set up:

-   DOCKER: first you need to make sure that you have docker installed in your system, because we use Laradock in the as container for development, you can find more out about docker here [Docker](https://www.docker.com/products/docker-desktop).
-   COMPOSER: you also need composer to run needed commands

#### let's start:

-   clone this repo inside your working dicrectory:
    ``
-   Navigate to the downloaded folder, then to this folder `laradock`.
-   to start docker container run this command:\n
    `docker-compose up -d nginx mysql redis`
    you may have to wait some time till finish.
-   once finished, we need to enter the conatainer workspace to be able to run commands inside the project:
    `docker-compose exec workspace bash`
-   you will see prompt chaged to your machine, you now in your docker container, it's time to install packages needed:
    `composer install`
    `npm install`
    these two commands will install all packags needed for both frontend and back end.
-   create database for the app: - in new terminal window, navigate to `<your-project-folder>/laradock/`
-   enter mysql container: `docker-compose exec mysql bash`, and in mysql container run: `mysql -uroot -proot` , now you in mysql terminal run: `CREATE DATABASE compain;`.
-   once done you can close this terminal window and back to original terminal

### Database migrations and seeds:

-   inside workspace conatiner run:`php artisan migrate --seed`, you can eliminate `--seed` from this command if you want empty database.
-   to run front server: `npm run dev` and `npm run watch-poll`

That's all, one last step you need to add `compain.test` to your hosts file like this: `127.0.0.1 compain.test`.
to start using the app, you can use these credentials, `email: orland30@example.org, password: 12345678`, or feel free to create account and login.

-   to run tests:
    -   `php artisan test` for unit tests.
    -   `phpcs` for code linting and standards.
