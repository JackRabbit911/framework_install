<?php

return <<<FILE
project_name: $project_name
host: localhost
env: !php/const DEVELOPMENT
tz: "$timezone"
connect:
    mysql:
        dsn: 'mysql:dbname=$dbname;host=mysql;charset=UTF8'
        host: mysql
        database: $dbname
        username: $username
        password: $password
        charset: utf8
    sqlite:
        driver: sqlite
        database: app/storage/data/data.sdb
    memcache:
        server: localhost
        port: 11211
    ftp:
        host: ftp59.hostland.ru
        username: host1467240_me
        password: zayberezay
    git: 'https://github.com/Owner/projectName'
mail:
    is_smtp: true
    smtp: fakesmtp
    smtp_port: 1025
    smtp_auth: false
    mailboxes:
        -
            address: robot@site.zone
            password: ''
            name: $project_name
ide:
    search: '/var/www/site.zone'
    replace: 'vscode://file/home/alx/www/repo1/site.zone'
FILE;
