![submit](https://i.ibb.co/KzT8Cdt/logo1.png)

# submit.

Social platform created with Symfony as project to learn MVC framework.

# What works?

- login/register system (Symfony component)
- E-mail verification (Symfony component)
- creating/deleting post/comment
- editing profile data

# What doesn't work?

- cookies issue, after any action loggs out
- page reload is static

# set up app

first pull code from repo

```bash
gh repo clone yanushevitz/submit-web-app
cd submit-web-app
```

then set up containers

```bash
sudo docker-compose up -d --build
```

then create database

```bash
sudo docker exec -it submit_db bash
mysql -p # there you will need to type password set in docker-compose.yml file
create database submit
exit
```

then install dependencies, run webpack and run migrations

```bash
sudo docker exec -it submit_app bash
composer install
npm i
npm run build
cd bin
php console doctrine:migrations:migrate
```

and this should be good enough

# photos

![1](https://i.ibb.co/8YL5791/submit3.png)
![2](https://i.ibb.co/qkgsTyk/submit1.png)
![3](https://i.ibb.co/ZB5d4Vy/submit2.png)
![4](https://i.ibb.co/wMwQxxP/submit4.png)
