FROM node:20-alpine3.17

WORKDIR /frontend

COPY . .

RUN npm install 

EXPOSE 3000

CMD [ "npm","run","start" ]