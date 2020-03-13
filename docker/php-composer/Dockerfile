FROM docker.pixelfederation.com/docker/php-fpm:7.3.10-build

ENV LIBRDKAFKA_VERSION v1.2.2
ENV BUILD_DEPS \
        build-essential \
        libsasl2-dev \
        libssl-dev \
        python-minimal \
        zlib1g-dev

RUN apt-get update \
    && apt-get install -y --no-install-recommends ${BUILD_DEPS} \
    && cd /tmp \
    && git clone \
        --branch ${LIBRDKAFKA_VERSION} \
        --depth 1 \
        https://github.com/edenhill/librdkafka.git \
    && cd librdkafka \
    && ./configure \
    && make \
    && make install \
    && pecl install rdkafka-3.1.2 \
    && docker-php-ext-enable rdkafka \
    && rm -rf /tmp/librdkafka \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

