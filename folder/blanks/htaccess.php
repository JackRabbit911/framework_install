<?php

return <<<'FILE'
# Options +SymLinksIfOwnerMatch
Options All -Indexes

<Files ~ "(.env|console|.gitignore)">
order allow,deny
deny from all
</Files>

ErrorDocument 403 /error/404

RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f

RewriteRule .* index.php/$0 [PT,QSA,L]
# RewriteRule ^(.*)index\.php$ $1 [R=301,L]
FILE;
