FROM node:14.16.0-alpine

RUN apk add --no-cache bash

WORKDIR /home/node/app

COPY . .

USER node

EXPOSE 5000

CMD ["npm","start"]



