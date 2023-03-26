#!/bin/bash

# set default values for branch and commit message
branch="master"
commit_msg="update ($date)"

# loop through arguments and parse them
while [[ $# -gt 0 ]]
do
    key="$1"

    case $key in
        -b|--branch)
            branch="$2"
            shift # past argument
            shift # past value
            ;;
        -m|--message)
            commit_msg="$2"
            shift # past argument
            shift # past value
            ;;
        -h|--help)
            echo "Usage: git_script.sh [OPTIONS]"
            echo ""
            echo "OPTIONS:"
            echo "-b, --branch     Specify the branch to push to (default: master)"
            echo "-m, --message    Specify the commit message (default: update)"
            echo "-h, --help       Show this help message"
            exit
            ;;
        *)    # unknown option
            echo "Unknown option: $key"
            exit 1
            ;;
    esac
done

# add all files
git add .

# commit changes
git commit -m "$commit_msg"

# switch to specified branch (if applicable)
if [ "$branch" != "master" ]
then
    git checkout "$branch"
fi

# push changes
git push origin "$branch"

# switch back to master (if applicable)
if [ "$branch" != "master" ]
then
    git checkout master
fi
