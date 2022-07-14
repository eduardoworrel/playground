# syntax=docker/dockerfile:1

FROM golang:1.17-alpine

RUN mkdir /app
ADD ./src/ /app
WORKDIR /app

COPY src/go.mod ./
COPY src/go.sum ./
RUN go mod download

COPY src/*.go ./

RUN go build -o main .

EXPOSE 80

CMD ["/app/main"]