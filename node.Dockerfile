FROM node:lts-slim

# instala um servidor http simples para servir conteúdo estático
RUN npm install -g http-server

# faz da pasta 'app' o diretório atual de trabalho
WORKDIR /app
ADD app ./

# instala dependências do projeto
RUN yarn

# compila a aplicação de produção
RUN yarn build

EXPOSE 8080

CMD [ "http-server", "dist" ]
