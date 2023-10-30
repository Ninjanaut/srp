<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette\Application\AbortException;
use Nette\Application\UI\Presenter;

abstract class BasePresenter extends Presenter
{
    /**
     * @throws AbortException
     */
    public function ok(): never
    {
        $this->sendJson(['status' => 'success']);
    }

    /**
     * @throws AbortException
     */
    public function badRequest(string $message = null): never
    {
        $this->sendJson(['status' => 'error', 'message' => $message]);
    }
}