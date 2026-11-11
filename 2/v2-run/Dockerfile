FROM alpine:3.20
RUN apk add --no-cache nodejs npm git
WORKDIR /usr/src/app
RUN git clone https://github.com/gabrielecirulli/2048.git .
RUN npm install -g http-server
EXPOSE 8080
CMD ["http-server", "-p", "8080"]