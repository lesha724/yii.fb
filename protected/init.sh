# Setup directory permissions
chmod 755 ./assets
chmod 755 ./protected/runtime
chmod 755 ./protected/runtime/cache
chmod 755 ./images/uploads
chmod 755 ./protected/yiic

# Create local config file if not exits
test -f ./protected/config/main-local.php || cp ./protected/config/main-local.example.php ./protected/config/main-local.php

touch ./protected/config/params.inc
chmod 755 ./protected/config/params.inc
touch ./protected/config/mail.inc
chmod 755 ./protected/config/mail.inc
touch ./protected/data/menu.txt
chmod 755 ./protected/data/menu.txt
touch ./protected/data/seo.txt
chmod 755 ./protected/data/seo.txt