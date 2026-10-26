# PalaceCode — Gerenciador de Restaurante

Painel web em PHP + MySQL para administrar um restaurante: mesas e reservas, cardápio, pedidos, caixa e funcionários.

## Contexto

Projeto desenvolvido como **TCC (Trabalho de Conclusão de Curso)** em 2023. O foco é a área administrativa usada pela equipe do restaurante, construída sobre o template SB Admin 2 (Bootstrap).

## Funcionalidades

- **Login de funcionários** com sessão; apenas contas com situação `ATIVO` entram.
- **Controle de acesso por ocupação**: telas de Funcionários, Cardápio e Caixa restritas ao perfil `Admin`.
- **Painel de controle**: funcionários ativos, mesas com pedidos, faturamento do dia, "Funcionário do Mês" e gráfico de vendas mensais (linha ou barra, Chart.js).
- **Mesas**: cadastro, reserva com data e hora, status (ex.: Reservada) e histórico de reservas.
- **Cardápio**: cadastro, edição e exclusão de combos com nome, descrição, preço e imagem.
- **Pedidos**: lista dos pedidos ativos por mesa, com marcação de finalizado.
- **Caixa**: itens e total por mesa, com fechamento da conta.
- **Funcionários**: cadastro, visualização, edição e inativação (CPF, RG, telefone, salário, ocupação etc.).
- **Minha conta**: dados do funcionário logado.
- **Backup**: exporta o banco inteiro em um arquivo `.sql` para download.

## Stack

- PHP (PDO / mysqli) e MySQL
- HTML, CSS/SCSS, JavaScript e jQuery
- Bootstrap 4 (template SB Admin 2), Chart.js, DataTables, Font Awesome

## Como rodar localmente

Pré-requisitos: PHP 7.4+ com `pdo_mysql` e `mysqli`, e um MySQL (XAMPP/WAMP também servem).

```bash
git clone https://github.com/MatheusDiamantino/Restaurante-PalaceCode.git
cd Restaurante-PalaceCode

# configure a conexão com o banco
cp conexao/config.example.php conexao/config.php
# edite conexao/config.php com host, usuário, senha e nome do banco

php -S localhost:8000
```

Acesse `http://localhost:8000` e faça login com um usuário da tabela `funcionario`.

> O script do banco não está no repositório. O código usa as tabelas `funcionario`, `mesas`, `cardapio` e `Pedidos`, que precisam ser criadas antes.

## Estrutura

- `index.php`: tela de login
- `dash.php`: painel de controle
- `utilities-mesas.php`, `utilities-cardapio.php`, `utilities-pedidos.php`, `utilities-caixa.php`: módulos do restaurante
- `tables.php`, `cadastro_funcionario.php`: gestão de funcionários
- `conexao/config.example.php`: modelo de conexão com o banco
- `css/`, `scss/`, `js/`, `img/`, `vendor/`: front-end e bibliotecas

## Próximos passos

Como é um projeto acadêmico, ainda há pontos a evoluir: armazenar senhas com hash (`password_hash`), incluir o script SQL do banco e proteger as rotas de exclusão contra CSRF.
