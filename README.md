# Desafio Back-End - OW Interactive 20/21

## Instalação
Para rodar esse sistema você precisa ter instalado:

- [PHP 7.4](https://www.php.net/downloads.php) - Necessário para iniciar o servidor
- [Composer](https://getcomposer.org/download)  - Necessário para obter o repositório (Caso não deseje pode apenas baixar o zip e extrair o mesmo).

Obs: Para a execução dos codigos via terminal no windows é necessário adicionar a pasta dos executaveis no PATH do sistema, para mais informações consulte [PHP MANUAL](https://www.php.net/manual/pt_BR/faq.installation.php#faq.installation.addtopath) E [Composer Manual](https://getcomposer.org/doc/00-intro.md#installation-windows)


1- Em seu terminal faça o download do repositório:
> git clone https://github.com/jonasearth/desafio-backend.git

2- Em seguida navegue até a pasta com :
> cd desafio-backend

3- Dentro da pasta do projéto é preciso instalar as dependencias com:
> composer install

4- Após a instalação você podera iniciar o servidor com:
> php -S localhost:3131

## Configuração 

Você deverá importar o arquivo sql (presente em /sql) para o seu banco de dados mysql e alterar o arquivo /Config/Config.php nas linha 47 à 54 para configurar o banco de dados em seu servidor.

Caso não tenham um banco mysql local tambem estou disponibilizando pelo email um arquivo com conexões para um banco de dados online que criei especialmente pra vocês.
## Consumo

Para consumo da api importe o arquivo insomnia.json para o insomnia e todos os requests já estarão prontos.

Para fins de consulta a documentação da api está no [notion](https://www.notion.so/Project-ddb1acb46dac490fbde5cb4dae872cee)

## Testes

Para executar os testes basta executar na raiz do projeto o comando:

> vendor\bin\phpunit -v tests

