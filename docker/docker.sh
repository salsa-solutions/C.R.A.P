#!/bin/bash

usage() {
  echo "Usage: $0 [-b|--build [image-name]] [-r|--run] [-s|--stop] [-d|--destroy] [-h|--help]"
}

build=false
build_name="my-image"
run=false
stop=false
destroy=false

# Parse command-line arguments
while [[ $# -gt 0 ]]; do
  key="$1"

  case $key in
    -b|--build)
      build=true
      if [[ -n "$2" && ${2:0:1} != "-" ]]; then
        build_name="$2"
        shift
      fi
      shift
      ;;
    -r|--run)
      run=true
      shift
      ;;
    -s|--stop)
      stop=true
      shift
      ;;
    -d|--destroy)
     if [[ -n "$2" && ${2:0:1} != "-" ]]; then
        build_name="$2"
        destroy=true
        shift
      ;;
    -h|--help)
      usage
      exit 0
      ;;
    *)
      usage
      exit 1
      ;;
  esac
done

if [[ $build == true ]]; then
  # Build the Docker image
  docker build --no-cache -t "$build_name" .
fi

if [[ $run == true ]]; then
  # Run the Docker container
  docker run -p 80:80 -p 443:443 -d --name my-container "$build_name"
fi

if [[ $stop == true ]]; then
  # Stop the running Docker container
  docker stop my-container

  if [[ $destroy == true ]]; then
    # Remove the Docker container
    docker rm my-container

    # Remove the Docker image
    docker rmi "$build_name"
  fi
fi
