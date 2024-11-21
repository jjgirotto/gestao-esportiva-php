# Sistema de Gestão Esportiva
## Sobre
Esse projeto consiste em um sistema web para gerenciamento de usuários, equipes/times, jogadores, competições e partidas para esportes e foi realizado como trabalho para a disciplina de Eletiva I - Linguagem de Programação IV.
A aplicação consiste em um site, feito em PHP, Bootstrap, HTML e CSS que realiza cadastro, alteração, consulta e remoção de usuários, equipes, competições e jogadores. Para partidas, ele realiza o registro, remoção e consulta de relatórios da consulta.
O site utiliza o banco de dados MySQL Workbench para persistência de dados.

### Tecnologias Utilizadas

* HTML: Linguagem de marcação usada para criar a estrutura das páginas web, formando a base do desenvolvimento web.

* CSS: Linguagem de estilo utilizada para controlar a aparência e o layout das páginas web, permitindo designs responsivos e visualmente atrativos.

* Bootstrap: Framework front-end que simplifica o desenvolvimento de sites responsivos e mobile-first, com componentes e utilitários pré-desenhados.

* PHP: Linguagem de script do lado do servidor amplamente usada para desenvolvimento web, possibilitando conteúdo dinâmico e interação com bancos de dados.

* Hack: Uma linguagem de programação baseada no PHP, criada pelo Facebook, que combina tipagem estática e dinâmica para maior segurança e eficiência no desenvolvimento.

* MySQL: Um popular sistema de gerenciamento de banco de dados relacional de código aberto utilizado para armazenar e gerenciar dados em aplicações web.

* MySQL Workbench: Uma ferramenta visual para arquitetos e desenvolvedores de banco de dados, que oferece recursos de desenvolvimento SQL, modelagem de dados e administração abrangente para bancos de dados MySQL.

**IDE: Microsoft Visual Studio Code**

## Requisitos
Para utilizar o projeto em sua máquina, as seguintes ferramentas devem estar instaladas e configuradas previamente:

- PHP Composer;
- XAMPP;
- Extensão PHP Intelephense;

## Guia de utilização
## Siga os passos abaixo para baixar, configurar e rodar o projeto no seu ambiente:

1. **Clone o repositório**  
Clone o repositório do projeto para sua máquina local:

    ```bash
    git clone https://github.com/jjgirotto/gestao-esportiva-php.git
    ```

2. **Acesse o diretório do projeto**  
Acesse o diretório principal do projeto:

    ```bash
    cd gestao-esportiva-php
    ```

3. **Crie o banco de dados**  
Antes de rodar o projeto, crie um banco de dados chamado `gestao_esportiva` e execute o script contido no arquivo `estrutura_banco.sql` para criar as tabelas e estrutura necessárias.

4. **Acesse o arquivo de configuração do banco de dados**  
Abra o arquivo `bancodedados.php` na pasta `config` e altere as informações de configuração da conexão com o banco de dados. Altere a porta do MySQL Workbench (definida como `3306`), o usuário (definido como `root`) e a senha do banco de dados (definida como `123456`) para as configurações da máquina que será utilizada:
    - **usuario:** Defina o usuário para acesso ao banco de dados.
    - **senha:** Defina a senha de acesso ao banco de dados.
    - **porta:** Defina a porta usada pelo MySQL (normalmente `3306`).

5. **Acesse o diretório `projetobdviews/paginas`**  
Acesse o diretório onde estão as páginas do projeto:

    ```bash
    cd projetobdviews/paginas
    ```

6. **Inicie o servidor embutido do PHP**  
Inicie o servidor PHP na porta 8000:

    ```bash
    php -S localhost:8000
    ```

7. **Acesse a aplicação**  
Abra o navegador e acesse:

    ```
    http://localhost:8000/login.php
    ```

8. **Acesse o sistema como administrador**  
Para acessar o sistema como administrador, use as seguintes credenciais:

    - **Login:** `adm@adm.com`
    - **Senha:** `adm`

Agora você pode interagir com o projeto diretamente no navegador.

## Banco de dados
O script disponível em `projetobdviews/estrutura_banco.sql` irá criar o schema correto para que o sistema possa realizar a persistência dos dados desejados.

## Funcionalidades

| ENDPOINT       | URL | AÇÃO              |
|----------------|-----|-------------------|
| Equipe | equipes.php | Visualiza as equipes   |
| Equipe | nova_equipe.php | Cadastra uma equipe   |
| Equipe | editar_equipe.php | Altera uma equipe   |
| Equipe | excluir_equipe.php | Remove uma equipe  |
| Jogador | jogadores.php | Visualiza os jogadores   |
| Jogador | novo_jogador.php | Cadastra um jogador   |
| Jogador | editar_jogador.php | Altera um jogador   |
| Jogador | excluir_jogador.php | Remove um jogador  |
| Competição | competicoes.php | Visualiza as competições   |
| Competição | novo_competicao.php | Cadastra uma competição  |
| Competição | editar_competicao.php | Altera uma competição   |
| Competição | excluir_competicao.php | Remove uma competição  |
| Equipe da competição | editar_equipe_competicao.php | Altera a colocação da equipe da competição   |
| Equipe da competição | excluir_equipe_competicao.php | Remove uma equipe da competição  |
| Partida| nova_partida.php | Cadastra uma partida   |
| Partida | excluir_partida.php | Remove uma partida  |
| Partida | relatorio_partidas.php | Visualiza relatórios de partida  |

## Contato
**Feito por: Juliana Girotto Leite**

**Email:** ads.jjgirotto@gmail.com

**Github:** https://github.com/jjgirotto
