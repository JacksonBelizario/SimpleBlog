FROM node:lts-slim

WORKDIR /usr/app
ADD app /usr/app

RUN yarn && yarn build

CMD [ "node", "serve.js" ]

EXPOSE 80
