FROM alpine:3.20
RUN apk add --no-cache nodejs npm git
WORKDIR /usr/src/app
COPY start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh
EXPOSE 8080
ENTRYPOINT ["/usr/local/bin/start.sh"]