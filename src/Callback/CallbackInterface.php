<?php

namespace Loevgaard\AltaPay\Callback;

use Psr\Http\Message\ServerRequestInterface;

interface CallbackInterface
{
    public function init();

    /**
     * Returns true if this callback can be initied with the respective $body
     *
     * @param ServerRequestInterface $request
     * @return bool
     */
    public static function initable(ServerRequestInterface $request) : bool;
}
