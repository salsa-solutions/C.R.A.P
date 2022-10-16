docker build  -t tibthink/crap .

docker run -dit --name=crap --restart unless-stopped tibthink/crap



docker exec -id crap bash
