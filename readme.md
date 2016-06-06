# Base do gerenciador de conteúdo utilizado na Onidigital.com

- Utilizando Laravel 5.2

## Instalação:
- git clone https://ednoferreira@bitbucket.org/ednoferreira/oni-cms.git
- dar permissões nas pastas storage e bootstrap
- $ composer install
- $ sudo npm install
- criar .env com as informações necessárias
- $ php artisan key:generate
- $ php artisan migrate
- $ php artisan db:seed
- $ gulp

## Utilização:
- Login do admin: admin@onidigital.com, senha: oni35224837

## Recursos atuais:
- Login/Logout de usuário
- Cadastro de usuários do sistema
- Cadastro do menu do sistema
- Listando menu no _sidebar