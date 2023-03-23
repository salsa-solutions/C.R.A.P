find . -not -path "*/phpMyAdmin*" -type f -exec chmod 644 {} \;
find . -not -path "*/phpMyAdmin*" -type f -exec chmod 755 {} \;
