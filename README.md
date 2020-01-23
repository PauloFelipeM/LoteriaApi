# Loterias Caixa Service

[![MIT License](https://img.shields.io/apm/l/atomic-design-ui.svg?)](https://github.com/tterb/atomic-design-ui/blob/master/LICENSEs)
[![Laravel 5.x|6.x](https://img.shields.io/badge/Laravel-5.x|6.x-orange.svg)](http://laravel.com)

Serviço criado para acessar os dados das loterias e consumir o HTML. Atualmente o código consumi as loterias: MEGASENA, TIMEMANIA, LOTOMANIA, DUPLASENA, LOTOFACIL.

O código contém o acesso do site da caixa, baixa, descompacta e deleta o arquivo ZIP da loteria, ser o arquivo HTML, captura o ultimo concurso e transformar os dados em um JSON.

![](header.png)

## Requerimentos
- [PHP >= 7.2](http://php.net/)
- [Laravel >= 5.x](https://laravel.com/)

## Instalação

git clone https://github.com/PauloFelipeM/LoteriasService.git

## Como usar

Colocar a pasta LoteriaApi dentro de /app/Services/ do Laravel.
Caso não esteja utilizando o Laravel, vc pode criar as pastas app/services, e colocar a pasta dentro.

No arquivo LoteriasWrite.php existe uma função chamada getAll(), ai instanciar a classe e chamar essa função o sistema irá baixar todos os arquivos ZIP dos jogos, descompactar e colocar nas suas respectivas pastas.

Dentro da pasta "Consumer" vc terá as classes dos jogos, onde ao instanciar uma delas e utilizar o method getConcurso(), retornará um JSON com as informações do ultimo sorteio do jogo
