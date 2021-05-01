FROM debian:buster-slim
ARG DEBIAN_FRONTEND=noninteractive
RUN apt-get update \
 && apt-get install --quiet --yes unzip git php-cli php-xml php-mbstring php-curl
RUN groupadd --gid 1000 php \
 && useradd --no-log-init --create-home --gid php --uid 1000 php
USER php:php
WORKDIR /srv/
EXPOSE 8080
ENTRYPOINT ["php", "-S", "0.0.0.0:8080", "-t", "public"]
