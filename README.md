# Blog
Como efetuar o deploy:

## Inicie o container
```
docker-compose -f docker-compose.yml up -d
```

### Inicialize o Banco de Dados
```
docker-compose exec app php artisan migrate --seed
```

### Acesse o projeto
[localhost:8080](http://localhost:8080)

