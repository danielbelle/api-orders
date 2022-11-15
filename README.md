<img src="https://github.com/danielbelle/api-orders/blob/main/public/readme/CRUD-adicionar.png"></img>

> Status: Desenvolvido ✅
### Projeto desenvolvido para atender demanda de um processo seletivo, onde era para desenvolver uma API REST de pedidos de compra com o framkework PHP CodeIgniter e MySQL. Nesta API, foi adicionado 3 endpoins de CRUD para Clientes, Produtos e Pedidos de compra.

## Tecnologias utilizadas:

<table>
  <tr>
    <td>PHP</td>
    <td>CodeIgniter</td>
    <td>Composer</td>
    <td>MySql</td>
    <td>Bootstrap</td>
    <td>jQuery</td>
  </tr>
  <tr>
    <td>7.4</td>
    <td>4.2</td>
    <td>2.0</td>
    <td>10.4</td>
    <td>5.0</td>
    <td>3.6</td>
  </tr>
</table>

## Para rodar a aplicação:
<spam> Vídeo com a instalação do projeto no youtube:</spam> https://youtu.be/CeQu0g-ifZU/

1) clone este repositório
2) no terminal rode: git clone https://github.com/danielbelle/api-orders.git
3) no terminal rode: composer update
4) crie um database MySQL para sua aplicação
5) renomeie o arquivo "env" para ".env"
6) configure os dados do seu database no arquivo ".env"
7) no terminal rode: php spark migrate
8) no terminal rode: php spark db:seed ProductSeeder
9) no terminal rode: php spark db:seed CustomerSeeder
10) no terminal rode: php spark db:seed OrderSeeder
11) no terminal rode: php spark serve
12) abra o link: <a href="http://localhost:8080/" >http://localhost:8080/</a>

## Funcionalidade:
- CRUD produtos;
- CRUD clientes;
- CRUD pedidos de compra com status;
- Validação de campos na criação e edição de dados;
- Tabela com campo de pesquisa;
- Atualização de dados em tempo real;

## Sobre o desafio:
Foi muito legal conhecer e aprender um novo framework e tão poderoso com o CodeIgniter. Aproveitei para comprar um curso e me especializar um pouco mais, então saio deste desafio com muito mais conhecimento e uma ferramenta a mais na minha caixa de utilitários.

## Sugestões para melhorar este projeto:

- Criar uma tela de cadastro, onde restringe a tela pedidos para administradores das lojas.
- Entender melhor o funcionamento da autenticação com JWT.


<center><img src="https://github.com/danielbelle/api-orders/blob/main/public/readme/crud.gif" style="width:1000px; height:500px"></center>
