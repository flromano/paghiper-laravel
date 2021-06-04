<?php

namespace Flromano\LaravelPagHiper;

use Flromano\LaravelPagHiper\v1\Payment\Billet;
use Flromano\LaravelPagHiper\v1\Bank\Accounts as BankAccounts;
use Flromano\LaravelPagHiper\v1\Payment\Notification\Notification;

class PagHiper
{
    protected $request;
    protected $billet;
    protected $bank;
    protected $notification;

    public function __construct()
    {
        $this->billet = new Billet();
        $this->bank = new BankAccounts();
        $this->notification = new Notification();
    }

    /**
     * This method is responsible for actions related to billets. You can use to create or cancel a billet.
     *
     * @return \Flromano\PagHiper\Core\Payment\Boleto
     */
    public function billet()
    {
        return $this->billet;
    }

    /**
     * This method is responsible for actions related to bank. You can use to
     * get a list of your bank accounts.
     *
     * @return void
     */
    public function bank()
    {
        return $this->bank;
    }

    /**
     * This method is responsible for receive and parses PagHiper's notification (Payment Notification).
     *
     * @return void
     */
    public function notification()
    {
        return $this->notification;
    }
}
