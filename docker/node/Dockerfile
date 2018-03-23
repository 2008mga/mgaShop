FROM node:9

ENV YARN_VERSION 1.5.1

RUN curl -fSLO --compressed "https://yarnpkg.com/downloads/$YARN_VERSION/yarn-v$YARN_VERSION.tar.gz" \
    && tar -xzf yarn-v$YARN_VERSION.tar.gz -C /opt/ \
    && ln -snf /opt/yarn-v$YARN_VERSION /opt/yarn \
    && rm yarn-v$YARN_VERSION.tar.gz

WORKDIR /code