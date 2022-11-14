[header](https://user-images.githubusercontent.com/38620899/106385660-2de04b00-63b0-11eb-9747-843cdc397c76.PNG)

> Status: Desenvolvido ✅
### Projeto desenvolvido para atender demanda de um processo seletivo, onde era para desenvolver uma API REST de pedidos de compra com o framkework PHP CodeIgniter e MySQL. Nesta API, foi adicionado 3 endpoins de CRUD para Clientes, Produtos e Pedidos de compra.



## Tecnologias utilizadas:

<table>
  <tr>
    <td>PHP</td>
    <td>CodeIgniter</td>
    <td>Composer</td>
    <td>MySql</td>
    <td>JWT Auth</td>
    <td>Bootstrap</td>
    <td>jQuery</td>
  </tr>
  <tr>
    <td>7.4</td>
    <td>4.2</td>
    <td>2.0</td>
    <td>10.4</td>
    <td>6.3</td>
    <td>5.0</td>
    <td>3.6</td>
  </tr>
</table>

## Some fields in main Model is:


  
Also that, has a User with this fields:

+ name
+ email
+ cpf
+ birth
+ active

## In addition to CRUD, I implement other features such as:

* See the more recently movement created, using Cookie.
* Entire verification system to validate forms with personalized messages.
* Message of success when create a movement, using Session Flash.
* Profile User editable.

## This features are in developing:

- Search for movements by name and/or dificulted category.
- Email verification.

## How to run the application:

1) run shell: composer install
2) run shell: php artisan key:generate
3) create new Schema MySql
4) create file .env (can copy from .env.example)
5) configure your database variables in .env
6) run shell: php artisan migrate
7) run shell: php artisan serve

## How to use mail service:

1) create free account in mailtrap
2) into of mailtrap site, go to My Inbox
3) go to SMT settigns
4) choice Laravel option in Integrations
5) copy and past in your .env

<center><img src="https://user-images.githubusercontent.com/38620899/106393900-5aa85880-63d8-11eb-88f1-07ac30adad80.gif"></center>
