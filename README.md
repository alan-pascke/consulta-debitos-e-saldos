<p>Melhorias estão sendo realizadas...</p>
<p>Este é um projeto de estudo.</p>

<br/>

# Interoperabilidade de Sistemas Financeiros

<br/>

## Descrição do Projeto
Este projeto tem como objetivo promover a interoperabilidade entre sistemas financeiros, permitindo a consulta centralizada de informações bancárias de clientes em diferentes instituições. 

A solução é composta por dois sistemas principais:
1. **Banco Central**: Um sistema centralizado que armazena informações sobre bancos financeiros e seus clientes.
2. **Aplicativo Consumidor**: Um sistema que consome um serviço SOAP para obter dados sobre contas bancárias vinculadas a um CPF, incluindo saldo, limite de crédito e crédito utilizado.

O projeto segue o padrão de arquitetura **MVC (Model-View-Controller)** para organizar o código de forma modular e facilitar manutenção e expansão.

## Tecnologias Utilizadas
- **Linguagem:** PHP
- **Serviço Web:** SOAP
- **Banco de Dados:** PostgreSQL

## Funcionalidades
- Exposição de um serviço SOAP para consulta de informações financeiras.
- Consulta pelo Aplicativo Consumidor para obter:
  - Lista de bancos onde um CPF possui conta.
  - Saldo disponível em cada banco.
  - Limite de crédito disponível.
  - Valor de crédito já utilizado.

  - As informações sobre o usuário não são armazenadas no aplicativo consumidor.


## Contribuição
Sinta-se à vontade para contribuir com melhorias e novas funcionalidades. 



