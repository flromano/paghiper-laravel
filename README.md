# Biblioteca de integração PagHiper para PHP

[![StyleCI](https://github.styleci.io/repos/150690825/shield?branch=master)](https://github.styleci.io/repos/150690825)
[![Maintainability](https://api.codeclimate.com/v1/badges/a99a88d28ad37a79dbf6/maintainability)](https://codeclimate.com/github/webmasterdro/paghiper-laravel/maintainability)

## Descrição

Utilizando essa biblioteca você pode integrar o PagHiper ao Laravel e utilizar os recursos que o PagHiper fornece em sua API, deixando seu código mais legível e manutenível.

**Esta biblioteca tem suporte aos seguintes recursos:**
- [Emissão de boleto](https://dev.paghiper.com/reference#gerar-boleto)
- [Cancelamento de boleto](https://dev.paghiper.com/reference#boleto)
- [Receber notificações automáticas (Retorno Automático)](https://dev.paghiper.com/reference#qq)
- [Listar contas bancárias](https://dev.paghiper.com/reference#lista-contas-banc%C3%A1rias-para-saque-via-api)

## Instalação

Você pode instalar a biblioteca via composer:

```
composer require flromano/paghiper-laravel
```

## Instalação no Laravel

### Laravel 5.5+

Você não precisa configurar nada. O pacote carrega automaticamente o Service Provider e cria o Facade alias, utilizando o recurso Auto-Discovery.

### Laravel 5.4

Adicione o ServiceProvider e a Facade em `config/app.php`

```php
Flromano\LaravelPagHiper\PagHiperServiceProvider::class,

'PagHiper' => Flromano\LaravelPagHiper\PagHiperFacade::class,
```

## Publique o arquivo de configuração

```php
php artisan vendor:publish --provider=Flromano\LaravelPagHiper\PagHiperServiceProvider
```

Adicione suas credenciais (`token` e `apiKey`) em `config/paghiper.php`. (Para obtê-las basta ir no seu painel:  [https://www.paghiper.com/painel/credenciais/](https://www.paghiper.com/painel/credenciais/)

## Utilizando

### Emissão de Boleto

**Para emitir um boleto você pode fazer da seguinte maneira:**

```php
use PagHiper;

$transaction = PagHiper::billet()->create([
    'order_id' => 'ABC-456-789',
    'payer_name' => 'Fernando Romano',
    'payer_email' => 'comprador@email.com',
    'payer_cpf_cnpj' => '1234567891011',
    'type_bank_slip' => 'boletoa4',
    'days_due_date' => '3',
    'items' => [[
        'description' => 'Notebook',
        'quantity' => 1,
        'item_id' => 'e24fc781-f543-4591-a51c-dde972e8e0af',
        'price_cents' => '1000'
    ]]
]);
```

Você pode obter a lista de dados que você pode enviar no seguinte link: [https://dev.paghiper.com/reference#gerar-boleto](https://dev.paghiper.com/reference#gerar-boleto)

**Para cancelar um boleto:**

```php
use PagHiper;

$transaction = PagHiper::billet()->cancel('JKP03X9KN0RELVLH');
```

**Para obter informações do pagamento via retorno automático:**

```php
use PagHiper;
use Illuminate\Http\Request;

public function notification(Request $request) {
    $transaction = PagHiper::notification()->response($request->notification_id, $request->idTransacao);
}
``` 

**Para obter a lista de suas contas bancárias:**

```php
use PagHiper;

$bankAccounts = PagHiper::bank()->accounts();
``` 
