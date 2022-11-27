# Playgorund

Todos os sistemas publicos que desenvolvi e mantenho no ar.

## Metas

- [x] Conteinerizar as aplicações PHP.

- [x] Migrar todos os serviços para este repositório.

- [x] Automatizar deploy de todas as aplicações com docker compose.

- [x] fracionar serviços em maquians virtuais distintas.

## Ponto de partida

Antes a infraestrutura estava configurada de forma primitiva porém economica, estando todas as aplicações back-end (seja em containers ou não) e front-end em uma unica maquina virtual  Ubuntu de 2GB e 50GB de disco.

## Atualmente

Hoje existe uma maquina virtual de 500MB e 10GB de disco responsável por rodar os serviços oficiais e uma de 1GB e 25GB de disco para os meus sistemas


<details>
<summary> Lista de softwares rodando </summary>
<br>

[1] Instalados via apt-get

- Nginx (<https://www.nginx.com/>)
  - Como proxy reverso
  - Como servidor HTTP
- Certbot (<https://certbot.eff.org/>)
  - HTTPS certificates
- Docker (<https://www.docker.com/>) & Docker Compose (<https://docs.docker.com/compose/>)
  - Conteinerização
- Git (<https://git-scm.com/>)


[2] Containers

- Official Images
  - MySQL
  - SQLServer
  - ElasticSearch
  - Kibana

- Custom images
  - Where.Web.API [[dockerfile](<https://github.com/eduardoworrel/Onde-estou-no-Brasil/blob/main/Where.Web.API/src/dockerfile>)]
    - Golang
  - Palavras.Web.SPA [[dockerfile](<https://github.com/eduardoworrel/playground/blob/master/uis/Palavras.Web.SPA/dockerfile>)]
    - ReactJS
  - Palavras.Web.API [[dockerfile](<https://github.com/eduardoworrel/Palavras-ETL-ElasticSearch/blob/main/src/Palavras.Web.API/dockerfile>)]
    - ASP.NET
  - Palavras.Background.ETL [[dockerfile](<https://github.com/eduardoworrel/Palavras-ETL-ElasticSearch/blob/main/src/Palavras.Background.ETL/dockerfile>)]
    - NodeJS + google-chrome-stable
  - Amapá Lanches [[dockerfile](https://github.com/eduardoworrel/playground/blob/master/apps/AmapaLanches.Web.APP/Dockerfile)]
    - PHP
  - CompraPeloZap [[dockerfile](https://github.com/eduardoworrel/playground/blob/master/apps/CompraPeloZap.Web.APP/Dockerfile)]
    - Laravel

</details>
