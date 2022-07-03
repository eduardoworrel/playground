# Playgorund

Afim de praticar os conhecimentos de arquitetura de software, me desafio nesse projeto a configurar a infraestrutura e os pipelines de todas as aplicações que já desenvolvi e estão no ar hoje.

## Metas

- Utilizar um cluster de banco de dados Mysql e descontinuar o uso do SQLServer.

- Conteinerizar as aplicações PHP.

- Automatizar deploys de todas as aplicações via github Actions.

- (talvez) fracionar serviços em maquians virtuais distintas.

- Registrar principais ações e padrões que repetitivamente foram realizados durante o processo de entrega de software para produção

- Desenhar modelo de arquitetura criado

## Ponto de partida

Hoje a infraestrutura está configurada de forma primitiva porém economica, estando todas as aplicações back-end (seja em containers ou não) e front-end em uma unica maquina virtual  Ubuntu de 2GB e 50GB de disco.

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
- PHP

[2] Containers

- Official Images
  - MySQL
  - SQLServer
  - ElasticSearch
  - Kibana

- Custom images
  - Where.Web.API (<https://github.com/eduardoworrel/Onde-estou-no-Brasil/blob/main/Where.Web.API/src/dockerfile>)
    - Golang
  - Palavras.Web.API (<https://github.com/eduardoworrel/Palavras-ETL-ElasticSearch/blob/main/src/Palavras.Web.API/dockerfile>)
    - ASP.NET
  - Palavras.Background.ETL (<https://github.com/eduardoworrel/Palavras-ETL-ElasticSearch/blob/main/src/Palavras.Background.ETL/dockerfile>)
    - NodeJS + google-chrome-stable

[3] Sistemas PHP

- Amapá Lanches (<https://github.com/eduardoworrel/Amapa-Lanches>)
- Tucuju.io (Privado)

[4] Sites estáticos

- Nomes no Brasil
- Palavras
- Onde estou no Brasil
- eduardoworrel.com

</details>
