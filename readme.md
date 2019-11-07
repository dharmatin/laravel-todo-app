# Laravel Todo List

Laravel to do list app is a simple to do list app using laravel + jquery + ajax + docker.

## How to run

Make sure your machine has already installed docker. If you don't installed it you can follow this link [docker install](https://docs.docker.com/install/) and docker compse [docker compose install](https://docs.docker.com/compose/install/)

After that, you just run this command:
```
docker-compose up -d
```
and for stoping service
```
docker-compose down
```
After that, you just visit http://localhost:8088/ and viola, you will see this page

![demo](./demo.png)

Congratulation... :tada:

## Structure of Code
Just following laravel standar structure folder. For `view` just see on the resources and all  `javascript` already in there.

If you want to develop the front-end side, just run
```
npm run dev
```
don't forget to run `npm install first`, see the `package.json` what the packages will be installed.


## Docker
just see on the docker-compose.yml, you can see all about the enviroment configuration.