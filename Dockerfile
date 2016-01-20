FROM ubuntu:15.10

ENV DEBIAN_FRONTEND noninteractive
RUN apt-get update && apt-get dist-upgrade -y

RUN apt-get install --no-install-recommends -y php5-cli php5-mysql php5-gd php5-mysql

RUN ln -s /app/srdb /usr/local/bin

COPY . /app
