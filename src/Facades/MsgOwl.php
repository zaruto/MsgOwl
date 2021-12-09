<?php

namespace Loopcraft\MsgOwl\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Loopcraft\MsgOwl\MsgOwl
 * @method sendMessage(string $body, string|array $contactNumbers)
 */
class MsgOwl extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'msgowl';
    }
}
