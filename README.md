# Backend
copiar o .env.example para .env
adicionar as variavieis necessárias

# Criar tabelas e Dados iniciais

php artisan migrate --seed

# Frontend
Alterar a BaseUrl para o endereço da aplicação no arquivo global.js dentro da pasta src/config

rodar o comando npm run build ou yarn build

colocar a pasta dist no servidor de frontend