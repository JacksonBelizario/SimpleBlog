# Blog
```
Projeto com Vue.js / Laravel
```
##Como efetuar o deploy:

### Inicie o container
```
docker-compose -f docker-compose.yml up -d
```

### Inicialize o Banco de Dados
```
docker-compose exec api php artisan migrate --seed
```

#### APP
[localhost:8080](http://localhost:8080)

#### Login
[localhost:8080/#/login](http://localhost:8080/#/login)

#### Painel Administrativo
[localhost:8080/#/dashboard](http://localhost:8080/#/dashboard)

