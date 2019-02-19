FROM node:lts-slim

# instala um servidor http simples para servir conteúdo estático
RUN npm install -g http-server

# faz da pasta 'app' o diretório atual de trabalho
WORKDIR /app

# copia os arquivos 'package.json' e 'package-lock.json' (se disponível)
ADD app ./

# instala dependências do projeto
RUN yarn

# compila a aplicação de produção com minificação
RUN npm run build

EXPOSE 8080
CMD [ "http-server", "dist" ]
