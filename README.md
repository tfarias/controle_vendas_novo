##Gestão de Vendas

- API - Desenvolvida com Framework Laravel 
   ```
    http://localhost:8000/api
  ```
- Front - Desenvolvido com NextJS
```
    http://localhost:3001
  ```

# Instalação
- Após fazer um pull request da aplicação executar os comando abaixo:
```
    $ docker-compose up -d --build
    $ docker exec -it tray_api php artisan migrate
    
    *** Caso de algum erro de permissão execute o comando abaixo na raiz do projeto:
    
    $ sudo chown "$USER":"$USER" $(pwd)
    
    E após isso execute o docker novamenteo
    
    $ docker-compose up -d --build
    
  ```
- Feito isso a aplicação já deve estar funcionando basta acessar o endereço
```
    http://localhost:3001
  ```

## Testes
- Para rodar os testes da api basta rodar o comando 

```
    $ docker exec -it tray_api vendor/bin/phpunit tests
```
- Porém como pode ser observado nas actions do repositório do github, já está sendo feito os tests com phpunit 
na aplicação. :)

## Desafio

- [x] Criar Vendedor
  ```
    - Endpoint: http://localhost:8000/api/vendedor
        Method: POST
  ```
- [x] Listar todos vendedores

  ```
    - Endpoint: http://localhost:8000/api/vendedor
        Method: GET
  ```

- [x] Lançar nova venda

```
    - Endpoint: http://localhost:8000/api/venda
        Method: POST
```

- [x] Listar todas as vendas de um vendedor
- Esta funcionalidade poderá ser encontrada dentro da lista de vendedores conforme imagem abaixo:
  ![Alt text](docs/front.png?raw=true "Title")
- Como pode ser observado, ao lado direiro do botão editar, está o botão de vendas feitas pelo vendedor.

- E clicando em adicionar nova venda a partir desta lista notará que o vendedor atual será selecionado.
```
    - Endpoint: http://localhost:8000/api/venda/3/lista
        Method: POST
   Route Param: vendedor
```



- [x] Ao final de cada dia deve ser enviado um email com um relatório com a soma de
      todas as vendas efetuadas no dia.


```
    
    Foi criado um rotina para ser cadastrada no servidor
    Todos os dias as 18:00h o comando
     - send:relatorio
    Vai gerar uma fila que envio de email que será processada a partir das 18:10h
    E por fim as 00:00h o processamento da fila será encerrado.

    Comando para cadastro na crontab
    * * * * * docker exec -d tray_api php artisan schedule:run >> /dev/null 2>&1

    Caso queria rodar os para testar basta rodar os comandos abaixo

    $ docker exec -d tray_api php artisan send:relatorio && docker exec -d tray_api php artisan queue:work

```

![Alt text](docs/front.png?raw=true "Title")

```
   Inseri um botao no canto superior direiro onde pode ser feito os testes de envio de notificações.
   Lembre-se de configurar o smtp do mailtrap para fazer os testes de notificações.
   
   caso não tenha rodado o comando:
    $  docker exec -d tray_api php artisan queue:work
    
    basta executá-lo e precionar o botão que as notificações serão enviadas.
```

