## About The Project

SIO AG task

### Built With
This project has been build using the following technologies:
* [[Symfony]][symfony-url]
* [[Bootstrap]][bootstrap-url]


## Getting Started

run the docker container and get inside the web container
```bash
docker-compose --profile=backend up -d
docker-compose exec web bash
```

### Start installing the dependencies to run the project

install nodejs
```bash
apt-get install nodejs
```
install npm
```
curl -fsSL https://deb.nodesource.com/setup_20.x | bash - &&\
apt-get install -y nodejs
```
install yarn globally
```bash
npm install --global yarn
```
install composer - https://getcomposer.org/download/
```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```
run composer install
```bash
composer install
```
install the js libraries
```bash
yarn install
```

install the assets
```
yarn run dev
```

You're good to go! http://localhost

[symfony-url]: https://symfony.com/
[bootstrap-url]: https://getbootstrap.com/
