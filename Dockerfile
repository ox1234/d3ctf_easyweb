FROM php:7.2-apache

# 1. 安装xdebug,支持远程调试，调试端口一般是 9000
COPY ./apache2.conf /etc/apache2/apache2.conf
COPY ./start.sh /start.sh
COPY ./flag /flag
RUN chmod 600 /flag


RUN chmod +x /start.sh
RUN echo I2luY2x1ZGU8c3RkbGliLmg+CmludCBtYWluKCl7CiAgICBzeXN0ZW0oImNhdCAvZmxhZyIpOwp9 | base64 -d > /tmp/catflag.c
RUN gcc -o /readflag /tmp/catflag.c; rm /tmp/catflag.c
RUN chmod +x /readflag

RUN set -xe \
    && sed  -i "s/deb.debian.org/mirrors.aliyun.com/g" /etc/apt/sources.list  \
    && sed  -i "s/security.debian.org/mirrors.aliyun.com/g" /etc/apt/sources.list  \
    && apt-get update  \
    && apt-get install -y wget

RUN set -xe \
    # 安装扩展
    && docker-php-ext-install -j$(nproc) pcntl \
    && docker-php-ext-install -j$(nproc) posix \
    && docker-php-ext-install -j$(nproc) pdo pdo_mysql \  
    && docker-php-ext-install -j$(nproc) mysqli

# build php.ini 
RUN set -xe \
    && cp /usr/local/etc/php/php.ini-production  /usr/local/etc/php/php.ini


CMD ["/start.sh"]