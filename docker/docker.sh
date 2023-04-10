#!/bin/bash

# Build Docker image
docker build -t crap .

# Start Docker container
docker run -e DATABASE_PASSWORD=<password> -p 80:80 -p 443:443 Greek_star