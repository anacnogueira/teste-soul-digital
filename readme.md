# TESTE SOUL DIGITAL - DESENVOLVEDOR PHP

Implemente o sistema abaixo respeitando os requisitos funcionais e casos de uso apresentados. É importante que você nos envie uma estimativa de tempo para a conclusão deste teste assim que tiver claro o entendimento deste e-mail.

Sistema de Tickets
Descrição: Se trata de um sistema fictício para gestão de tickets de suporte de uma aplicação.

## Especificações

 *   Implementar o sistema abaixo utilizando Laravel versão 5.3 ou maior.
 *  Devem existir dois tipos de permissão de acesso - admin e cliente.
 *   Um usuário comum pode realizar seu cadastro no site, utilizando obrigatoriamente nome, e-mail, e senha. O campo e-mail deverá ser único em todo o site, e a senha deverá ter pelo menos 6 caracteres e conter letras e números.
 *   O acesso das páginas internas deverão ser restritos a usuários logados no site.
 *   Quando for criado um novo ticket por um usuário, o usuário admin recebe e-mail.
 *   Quando uma resposta for enviada para um ticket, o usuário criador do ticket recebe um e-mail de alerta com o link para abrir o ticket.
 *   Os arquivos de CSS e JS do front end deverão ser minificados.


## CASOS DE USO

##### Usuário 
Pode criar tickets
Só pode ver os tickets que criou.
Só pode responder um ticket aberto por ele mesmo.

##### Admin
Pode ver e responder todos os tickets.

##### Entidades
Implemente obrigatoriamente a entidade Ticket e Resposta. Ticket deverá ter pelo menos um assunto e uma descrição.
Um usuário poderá ter vários tickets, e um ticket poderá ter várias respostas.


## COMO ENVIAR

Enviar arquivo zip ou repositório GIT para download do teste, bem como as instruções para instalação do projeto.
Enviar dump SQL para criação do banco de dados em ambiente local ou comando de migrations.

---

## Intruções de instalação:

1. Faça o clone do projeto `git clone git@github.com:anacnogueira/teste-soul-digital.git`
2. Altere o arquivo **.env.example**  para **.env** e altere as configurações de banco de dados (host, nome do banco, usuario e senha)
3. Rode o comando `php artisan migrate --seed`  no terminal para criar as tabelas e popular a tabela users
4. Rode o comando `composer update` no terminal para instalar as depedências

#### Login do usuário administrador
Usuário: anacnogueira@gmail.com 
Senha: 123456