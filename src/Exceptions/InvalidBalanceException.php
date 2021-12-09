<?php

namespace Loopcraft\MsgOwl\Exceptions;

use Exception;

class InvalidBalanceException extends Exception
{
    public function render()
    {
        return response()->json([
            'status' => false,
            'message' => $this->getMessage(),
        ], 402);
    }
}
