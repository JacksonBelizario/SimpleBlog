# Blog
```
Projeto com Vue.js / Laravel
```
## Como efetuar o deploy:

### Inicie o container
```
docker-compose up -d --build
```
### Instale as dependências
```
docker-compose exec api composer install
```
### Inicialize o Banco de Dados (Com dados de exemplo)
```
docker-compose exec api php artisan migrate --seed
```

#### APP
[localhost:8080](http://localhost:8080)

#### Login
[localhost:8080/#/login](http://localhost:8080/#/login)

#### Painel Administrativo
[localhost:8080/#/dashboard](http://localhost:8080/#/dashboard)

