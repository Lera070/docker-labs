FROM alpine:3.20
RUN apk add --no-cache nodejs npm
WORKDIR /usr/src/app
COPY game-src/ /usr/src/app/
RUN npm install -g http-server
EXPOSE 8080
CMD ["http-server", "-p", "8080"]