# PetWeb-APP

Projeto apresentado como Trabalho de Conclusão do Curso de Analise e Desenvolvimento de Sistemas na instituição FATEC-Carapicuíba

O PetWeb é um sistema de gerenciamento de petshop online, com o intúito de trazer uma solução digital completa para micro e pequenas empresas que em condições naturais não teriam como competir com os grandes players do mercado.

Este é um projeto open source (código aberto) e está sob a licensa MIT (de livre distrubuição para quaisquer finalidades) e aceita a colaboração de terceiros objetivando melhorar a experiência de administradores, funcionários e clientes de petshop online.

## Como colaborar?

- Faça um FORK do projeto, isto é, copiar o projeto para um repositório seu.
- Crie a sua pasta dentro do repositório, e crie ou altere arquivos como quiser (dentro da sua pasta).
- Faça um PULL REQUEST para que suas alterações façam parte do projeto original.

## Convidados

Se você recebeu um convite em seu e-mail e agora faz parte da equipe de desenvolvedores deste projeto, você pode baixar o git [neste link](https://git-scm.com) e após a instalação basta abrir o terminal (linux), prompt (windows) ou bash (mac) e seguir os seguintes passos:

1.  Fazer uma cópia do repositório para o seu ambiente local

    > _git clone https://github.com/esdras-schonevald/petweb-app.git petweb/app_

2.  Entrar na pasta onde foi salvo o projeto

    > _cd petweb/app_

3.  Iniciar o git nesta pasta

    > _git init_

4.  Configurar nome e e-mail de usuário (o mesmo que você utiliza para acessar o github)

    > _git config --global user.name "seu-nome"_

    > _git config --global user.email "seu-email"_

5.  Configurar o token de acesso. Para isso é necessário a criação do token de acesso no site do github.
    Caso você não saiba como criar o seu token de acesso [clique aqui](https://docs.github.com/pt/authentication/keeping-your-account-and-data-secure/creating-a-personal-access-token) e saiba mais.
    Após a criação do token utilize este token no lugar da senha _(obs.: senha não funciona, precisa realmente ser um token)_

    > _git config --global user.password "seu-token-de-acesso"_

6.  Selecione a branch (para qual ambiente vão os seus commits) que irá utilizar. No nosso caso utilize **dev**

    > _git branch -M dev_

7.  Adicione este repositório aos seus locais remotos

    > _git remote add origin https://github.com/esdras-schonevald/petweb-app.git_

Pronto vocẽ já está com o repositório configurado. Agora siga os próximos passos a cada alteração que você for subir para o repositório:

8.  Antes de subir qualquer alteração, atualize o seu repositório baixando as modificações feitas por outros desenvolvedores através do comando abaixo

    > _git pull_

9.  Crie, altere e remova arquivos livremente. Para que o git crie uma lista com as alterações que você fez utilize

    > _git add ._

10. Para consultar as alterações que estão na lista do git basta digitar

    > _git status_

11. Uma vez que os seus arquivos já estejam na lista do git, é possível fazer um commit (que é a realização destas alterações no seu ambiente local). Uma boa prática é escrever uma mensagem explicando de uma maneira simples as alterações feitas

    > _git commit -m "<tag>: <descrição das alterações>"_

    **_OBS: Sempre utilize commits semânticos, do contrário seus pull requests serão rejeitados. Para entender o quê são commits semânticos acesse [este link](https://www.conventionalcommits.org/pt-br/v1.0.0/)._**

12. E finalmente utilize este ultimo comando para enviar as suas alterações locais para o repositório no servidor (neste caso o github)

    > _git push -u origin dev_
