<?php

return <<<'FILE'
<VirtualHost *:80>
	ServerAdmin webmaster@localhost
	DocumentRoot /var/www/{docroot}
	ErrorLog ${APACHE_LOG_DIR}/error.log
	CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
FILE;
