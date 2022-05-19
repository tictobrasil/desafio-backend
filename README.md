# Ticto Tecnologia - Desafio Backend

Descrição do nosso desafio técnico para candidatos às vagas de backend.

## Requerimentos

Para rodar o projeto com Docker você irá precisar ter instalado na sua máquina apenas os seguintes itens:

- Docker - <https://www.docker.com>
- Docker Compose - <https://docs.docker.com/compose>

Agora, se preferir rodar o projeto sem Docker, você vai precisar ter instalado na sua máquina os seguintes softwares/ferramentas:

- MySQL ou Postgres.
- PHP (v8.1) - <https://www.php.net>
- Extensões do PHP: BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer ,XML.
- Composer - <https://getcomposer.org>

É interessante que você também tenha instalado o [Insomnia](https://insomnia.rest/downloa) ou [Postman](https://www.postman.com), para conseguir testar os endpoints da aplicação.

## Setup inicial

Instruções para setup do projeto usando docker com [Laravel sail](https://laravel.com/docs/9.x/sail).

1. Faça um clone do projeto para a sua máquina local.
2. Agora instale as dependências do projeto executando o seguinte comando:

```bash
docker run --rm -u "$(id -u):$(id -g)" -v $(pwd):/var/www/html -w /var/www/html laravelsail/php81-composer:latest composer install --ignore-platform-reqs
```

3. Na pasta do projeto, copie o arquivo `.env.example` para `env`:

```bash
cp .env.example .env
```

4. Inicie a aplicação fazendo isso do comando:

```bash
./vendor/bin/sail up -d
```

5. Gere a chave da aplicação, usando o comando:

```bash
./vendor/bin/sail artisan key:generate
```

6. Execute as migrações e seeders usando o seguinte comando:

```bash
./vendor/bin/sail artisan migrate --seed
```

Ótimo! Se tudo deu certo, a aplicação já está rodando em [http://localhost:8088](http://localhost:8088). 🎉

## Executando os testes

Para executar os testes do projeto execute o comando:

```bash
./vendor/bin/sail test
```

## Mão na massa!

Agora você já pode colocar a mão na massa, ou melhor, no código!
