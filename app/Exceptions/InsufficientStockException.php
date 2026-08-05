<?php

namespace App\Exceptions;

use Exception;

class InsufficientStockException extends Exception
{
    public function __construct(
        protected int $availableStock,
        protected int $requestedQuantity,
    )
    {
        $message = "Not enough stock. Available: {$availableStock}, Requested: {$requestedQuantity}";
        parent::__construct($message, 422);
    }

    public function getAvailableStock(): int
    {
        return $this->availableStock;
    }

    public function getRequestedQuantity(): int
    {
        return $this->requestedQuantity;
    }
}