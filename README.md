# Nexora

Nexora é uma plataforma de comparação de preços. Ela apresenta produtos, variantes e ofertas de diferentes lojas para que o usuário compare preços, condições e disponibilidade e acesse diretamente a página externa da oferta escolhida.

O Nexora não realiza a venda dentro da aplicação. Seu papel é organizar as informações de comparação e direcionar o usuário para a loja externa correspondente.

## Preview

As capturas de tela da aplicação serão adicionadas nesta seção futuramente.

<!-- Adicione aqui screenshots reais da aplicação quando estiverem disponíveis. -->

## Funcionalidades

### Implementado

- Página inicial com a proposta do Nexora, campo de busca visual que encaminha para `/products` e chamada para explorar produtos.
- Navbar global responsiva.
- Footer global com links institucionais.
- Listagem de produtos.
- Página de detalhes do produto.
- Categorias de produtos.
- Variantes de produtos.
- Atributos e valores de atributos.
- Galeria e imagens de produtos.
- Ofertas associadas a diferentes lojas.
- Comparação de ofertas.
- Exibição do menor preço disponível.
- Informações de estoque e condição da oferta.
- Links externos para acessar a oferta na loja.
- Seleção de variantes na página de produto.
- Ambiente de desenvolvimento executado com Docker Compose.

### Planejado

Os itens abaixo ainda não estão implementados:

- Autenticação de usuários.
- Cadastro e login.
- Wishlist ou lista de desejos.
- Alertas de preço.
- Histórico de preços.
- Notificações quando um produto atingir um preço definido.
- Busca e filtros mais avançados.

## Rotas

| Método | URI | Descrição |
| --- | --- | --- |
| `GET` | `/` | Página inicial |
| `GET` | `/products` | Listagem de produtos |
| `GET` | `/products/{product}` | Detalhes de um produto |
| `GET` | `/up` | Health check padrão do Laravel |

## Tecnologias

| Tecnologia | Uso |
| --- | --- |
| PHP 8.5.9 | Linguagem e runtime da aplicação |
| Laravel 13.25.0 | Framework web e estrutura da aplicação |
| PostgreSQL 18.4 | Banco de dados relacional |
| Blade | Templates das páginas |
| Tailwind CSS | Estilos e layout responsivo |
| JavaScript | Interações do frontend, incluindo o menu mobile e seleção de variantes |
| Vite | Build e desenvolvimento dos assets frontend |
| Node.js 22.23.2 | Execução do ambiente frontend no container `node` |
| Docker Compose | Orquestração do ambiente local |
| Nginx | Servidor web e proxy para o PHP-FPM |
| PHP-FPM | Execução da aplicação Laravel no serviço `app` |

## Arquitetura

```text
Browser
	|
	v
Nginx (porta 80)
	|
	v
Laravel / PHP-FPM (app)
	|
	v
PostgreSQL (db)

Node.js / Vite (node)
	|
	v
Assets frontend em public/build
```

O `compose.yaml` define os seguintes serviços:

- `app`: executa o Laravel com PHP-FPM. A imagem instala PHP, Composer e as extensões necessárias para PostgreSQL.
- `nginx`: serve os arquivos públicos e encaminha requisições PHP para o serviço `app`. A porta local `80` é publicada.
- `db`: executa o PostgreSQL com o banco `nexora` e mantém os dados no volume `nexora_db_data`.
- `node`: executa Node.js 22 Alpine e compartilha o projeto para instalar dependências e gerar os assets com Vite.

## Requisitos

Para executar o ambiente principal, instale na máquina:

- Git.
- Docker Engine ou Docker Desktop.
- Docker Compose, normalmente incluído nas versões atuais do Docker como `docker compose`.

PHP, Composer, PostgreSQL e Node.js não precisam estar instalados diretamente na máquina para o fluxo principal, pois são executados pelos containers. O Docker precisa estar em execução antes dos comandos `docker compose`.

## Instalação

Clone o projeto e entre no diretório:

```bash
git clone https://github.com/DutraGabriel/nexora.git
cd nexora
```

Crie o arquivo de ambiente local:

```bash
cp .env.example .env
```

No `.env`, mantenha a configuração PostgreSQL compatível com o `compose.yaml`:

```dotenv
DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=nexora
DB_USERNAME=nexora
DB_PASSWORD=nexora
```

Esses valores são destinados ao ambiente local definido pelo Docker Compose. Não use essas credenciais como configuração de produção.

## Primeira execução

Depois de criar o `.env`, execute as etapas abaixo na ordem indicada.

1. Construa as imagens e suba os containers:

```bash
docker compose up -d --build
```

2. Instale as dependências PHP no container da aplicação:

```bash
docker compose exec app composer install
```

3. Gere uma chave própria para a instalação local. Nunca copie uma chave real de outra máquina:

```bash
docker compose exec app php artisan key:generate
```

4. Instale as dependências frontend no container Node:

```bash
docker compose exec node npm install
```

5. Execute as migrations:

```bash
docker compose exec app php artisan migrate
```

6. Crie o link público do storage:

```bash
docker compose exec app php artisan storage:link
```

7. Gere os assets frontend:

```bash
docker compose exec node npm run build
```

8. Confira o estado dos serviços:

```bash
docker compose ps
```

Os serviços esperados são `app`, `db`, `nginx` e `node`. O serviço `nginx` publica a aplicação em `http://localhost`.

## Banco de dados

Execute as migrations:

```bash
docker compose exec app php artisan migrate
```

Verifique o estado das migrations:

```bash
docker compose exec app php artisan migrate:status
```

O comando `migrate:fresh` não faz parte do fluxo padrão, pois apaga e recria as tabelas do banco.

## Frontend

Gere os assets de produção com Vite:

```bash
docker compose exec node npm run build
```

O build gera os arquivos utilizados pelo Laravel em `public/build`.

O projeto também possui o script `npm run dev`, mas o `compose.yaml` atual não publica uma porta do Vite. Para o fluxo padrão deste ambiente, use `npm run build`. O script de desenvolvimento pode ser executado dentro do container quando a integração de acesso ao servidor Vite for configurada:

```bash
docker compose exec node npm run dev
```

O arquivo `vite.config.js` configura o watch dos arquivos, mas não configura uma porta pública adicional para o servidor Vite.

## Storage

Crie o link público para os arquivos armazenados no disco público:

```bash
docker compose exec app php artisan storage:link
```

Esse comando conecta `public/storage` ao diretório público de armazenamento do Laravel.

## Executar a aplicação

Com os containers em execução, acesse:

- Página inicial: [http://localhost](http://localhost)
- Produtos: [http://localhost/products](http://localhost/products)
- Health check: [http://localhost/up](http://localhost/up)

Para abrir os detalhes, substitua `{product}` por um identificador existente, por exemplo `/products/1` quando esse produto estiver cadastrado.

## Testes

Execute a suíte de testes Laravel:

```bash
docker compose exec app php artisan test
```

## Comandos úteis

```bash
# Iniciar os containers
docker compose up -d

# Parar e remover os containers da aplicação
docker compose down

# Verificar o estado dos serviços
docker compose ps

# Acompanhar logs dos serviços
docker compose logs

# Executar migrations
docker compose exec app php artisan migrate

# Limpar caches do Laravel
docker compose exec app php artisan optimize:clear

# Gerar assets frontend
docker compose exec node npm run build

# Acompanhar logs continuamente
docker compose logs -f

# Executar a suíte de testes
docker compose exec app php artisan test
```

## Estrutura do projeto

```text
app/
	Http/
		Controllers/
			HomeController.php
			ProductController.php
	Models/
		Category.php
		Offer.php
		Product.php
		ProductAttribute.php
		ProductAttributeValue.php
		ProductImage.php
		ProductVariant.php
		Store.php

bootstrap/
	app.php

database/
	migrations/
	seeders/

docker/
	nginx/
		default.conf
	php/
		Dockerfile
		entrypoint.sh

public/
	index.php

resources/
	css/
		app.css
	js/
		app.js
	views/
		components/
		layouts/
		products/
		home.blade.php

routes/
	console.php
	web.php

compose.yaml
composer.json
package.json
phpunit.xml
vite.config.js
README.md
```

## Segurança e ambiente

- Não versione o arquivo `.env`; ele é destinado à configuração local.
- Mantenha o `.env.example` atualizado sem incluir segredos reais.
- Nunca adicione ao repositório senhas, tokens, chaves de API ou valores reais de `APP_KEY`.
- Cada desenvolvedor deve gerar sua própria `APP_KEY` com `php artisan key:generate` dentro do ambiente local.
- As credenciais PostgreSQL documentadas neste README são apenas as credenciais de desenvolvimento definidas no Docker Compose.
- Revise `git status` e `git diff` antes de criar um commit.

## Desenvolvimento

Fluxo recomendado:

1. Criar ou selecionar uma branch de trabalho.
2. Implementar a alteração.
3. Executar os testes e o build frontend quando aplicável.
4. Verificar `git status` e `git diff`.
5. Criar o commit.
6. Enviar a branch para o repositório remoto.
7. Abrir um Pull Request.

## Licença

Não há um arquivo `LICENSE` no repositório neste momento. Uma licença formal poderá ser adicionada posteriormente.

## Estado do projeto

O Nexora está em desenvolvimento ativo. As funcionalidades documentadas em **Implementado** correspondem ao estado atual da aplicação; os itens em **Planejado** ainda não estão disponíveis.
