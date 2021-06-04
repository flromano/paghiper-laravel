<?php

namespace Flromano\LaravelPagHiper\v1\Bank;

use Flromano\LaravelPagHiper\Core\Request\Request;
use Flromano\LaravelPagHiper\Core\Exceptions\PagHiperException;
use Flromano\LaravelPagHiper\Core\Interfaces\BankAccountsInterface;

class Accounts implements BankAccountsInterface
{
    protected $accountsUri = '/bank_accounts/list/';

    /**
     * Retrieves a list of bank accounts.
     *
     * @return void
     */
    public function accounts()
    {
        $bankAccounts = new Request($this->accountsUri);

        $response = $bankAccounts->getResponse()['bank_account_list_request'];

        if ($response['result'] === 'reject') {
            throw new PagHiperException($response['response_message'], $response['http_code']);
        }

        return $response;
    }
}
