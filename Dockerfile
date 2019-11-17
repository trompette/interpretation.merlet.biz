FROM debian:stretch-slim
ARG DEBIAN_FRONTEND=noninteractive
RUN apt-get update \
 && apt-get install --quiet --yes \
    unzip \
    php7.0-cli \
    php7.0-common \
    php7.0-json \
    php7.0-opcache \
    php7.0-readline \
    php7.0-xml \
    php7.0-mbstring
RUN groupadd --gid 1000 php \
 && useradd --no-log-init --create-home --gid php --uid 1000 php
USER php:php
WORKDIR /srv/
EXPOSE 8080
ENTRYPOINT ["php", "-S", "0.0.0.0:8080", "-t", "public"]
