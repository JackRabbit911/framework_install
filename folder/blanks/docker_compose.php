<?php

return <<<FILE
version: '3'

networks:
  backend:

services:
  httpd:
    build:
      context: .
      dockerfile: Dockerfile
    ports:
      - 80:80
    volumes:
      - "./:/var/www"
    environment:
      TZ: "$timezone"
    networks:
      - backend
    depends_on:
      - mysql

  mysql:
    image: mysql:5.7
    restart: unless-stopped
    volumes:
      - ./mysql/data:/var/lib/mysql
      - ./mysql/conf.d:/etc/mysql/conf.d
      - ./mysql/logs:/var/log/mysql/
      - ./mysql/dump:/dump
    ports:
      - 3306:3306
    security_opt:
      - seccomp:unconfined
    environment:
      MYSQL_ROOT_PASSWORD: $root_pswd
      TZ: "$timezone"
    networks:
      - backend

  fakesmtp:
    image: maildev/maildev
    ports:
      - 1080:1080
    networks:
      - backend
FILE;
