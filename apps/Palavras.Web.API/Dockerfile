# https://hub.docker.com/_/microsoft-dotnet
FROM mcr.microsoft.com/dotnet/sdk:6.0 AS build

WORKDIR /app

COPY ./src ./

RUN dotnet publish Palavras.Web.API.csproj -c release -o /out

# final stage/image
FROM mcr.microsoft.com/dotnet/aspnet:6.0
WORKDIR /app
COPY --from=build /out ./

EXPOSE 5001

ENTRYPOINT ["dotnet", "Palavras.Web.API.dll"]
