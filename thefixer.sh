find . -not -path "*/phpMyAdmin*" -type f -exec chmod 644 {} \;
find . -not -path "*/phpMyAdmin*" -type d -exec chmod 755 {} \;

chmod +x thefixer.sh git.sh cloc.sh

