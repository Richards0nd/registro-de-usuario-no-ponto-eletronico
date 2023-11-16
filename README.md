# Resumo do Projeto HXY - Sistema de Registro de Ponto Eletrônico

## Visão Geral

Este projeto é um sistema desenvolvido para a empresa HXY, permitindo que os novos funcionários registrem seus pontos eletronicamente. O sistema é dividido em duas partes principais:

- O Front-End, construído com Tailwind CSS, Liveware juntamente com Blade
- O Back-End, desenvolvido com o framework Laravel e o banco de dados MariaDB/MYSQL

## Funcionalidades do Sistema

Registro de Funcionários: Os usuários, ao serem contratados, recebem um link para registrar seu ponto eletrônico. O link leva a um formulário com campos para nome, e-mail, CPF, celular e conhecimentos (1 a 3 itens de uma lista pré-definida).

Validação de Dados: O sistema valida todas as entradas para garantir a correção dos dados. Isso inclui limites de caracteres e formatos específicos para campos como CPF e celular.

Administração de Registros: Um administrador do sistema pode acessar todos os registros em uma interface dedicada, onde os registros são listados alfabeticamente. Cada registro começa com o status "Não validado" e pode ser alterado para "Validado".

Segurança e Integridade dos Dados: As validações são realizadas tanto no cliente quanto no servidor para garantir a segurança. O sistema impede o cadastro de CPFs duplicados.

## Diferenciais e Observações

1. Estrutura organizada do código e commits padronizados no repositório.
2. Observância das boas práticas como não realizar commits na branch master/main e utilização da estratégia Git Flow.

## Desenvolvimento e Instalação

O projeto está unificado em um único repositório, devido a natureza do tempo, infelizmente não foi possível separar os projetos do front e o back.
O processo de instalação é bem simples,

## Instalação

### Necessário o PHP >= v8

```
composer install
```

### Se você usa o PNPM

```
pnpm install
```

```
pnpm run dev
```

NPM & YARN

```
npm install
```

```
yarn install
```

### Iniciar o servidor de desenvolvimento

```
php artisan serve
```
