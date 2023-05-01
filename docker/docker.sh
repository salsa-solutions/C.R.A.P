# docker build -t my-php-server --build-arg GITEA_USER=<your_gitea_username> --build-arg GITEA_TOKEN=<your_gitea_access_token> --build-arg GITEA_REPO=<your_gitea_repository_name> .
# docker run -p 80:80 -p 3306:3306 -e GITEA_USER=<your_gitea_username> -e GITEA_TOKEN=<your_gitea_access_token> -e GITEA_REPO=<your_gitea_repository_name> my-php-server

docker build -t my-php-server .
docker run -p 80:80 -p 3306:3306 my-php-server
