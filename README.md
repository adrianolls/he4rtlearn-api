# He4rt Learning 

Essa API fará parte do projeto da plataforma de ensino de inglês da He4rt Developers, a plataforma terá o foco de informatizar o cadastro de usuários no curso e disponibilizar lições e desafios para os alunos.

## Instalando dependências

Instalação de todos as dependências do composer.json no seu projeto. Esse comando irá fazer o download de tudo que será necessário:

`composer install`

## Configuração do env

Copie o arquivo .env.example e renomeie como .env:

`cp .env.example .env`

Configure com as informações do seu banco de dados e rode o seguinte comando:

`php artisan migrate`

## Iniciando o servidor

Após a instalação de todas as dependências e configuração do .env, você poderá iniciar o servidor com o seguinte comando:

`php -S 0.0.0.0:8000 -t public`

## Documentação

Para acessar a documentação entre no diretório development no terminal e digite o comando:

`./swagger.sh`

Se você for um usuário de linux é necessário dar permissão de execução para o swagger, então antes de rodar o comando acima digite:

`sudo chmod +x swagger.sh`

Tendo em mente que o servidor do projeto está rodando acesse a URL ['http://localhost:8000/swagger'](http://localhost:8000/swagger) para acessar a documentação da API

## Licença

Este projeto está licenciado sob a licença MIT
