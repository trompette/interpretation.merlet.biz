FROM debian:stretch-slim
RUN apt-get update && apt-get install --quiet --yes unzip php7.0-cli php7.0-common php7.0-json php7.0-opcache php7.0-readline php7.0-xml php7.0-mbstring
WORKDIR /srv/
EXPOSE 8080
ENTRYPOINT ["php", "-S", "0.0.0.0:8080", "-t", "public"]
