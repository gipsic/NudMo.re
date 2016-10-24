# NudMo.re

## Requirement
- [Docker](docker.io)
- [Composer](https://getcomposer.org/)

## How to run Docker

```
docker-compose up --build
```

After running `docker-compose`, web server will serve at port 8080 (you can access website at [http://localhost:8080](http://localhost:8080)) and MySQL will serve at port 3307.

### Server

#### Setting up

- [Install Composer](https://getcomposer.org/download/)
- [Install Docker](https://docs.docker.com/engine/installation/linux/ubuntulinux/)
- [Install Docker Compose](https://docs.docker.com/compose/install/)
- [Setting up SSH key](https://help.github.com/articles/adding-a-new-ssh-key-to-your-github-account/)

#### Fix Laravel permission problem with Nginx
```
chgrp -R www-data nudmore-main-site
chmod -R g+w nudmore-main-site/storage
```
