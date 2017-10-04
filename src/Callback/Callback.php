<?php

namespace Loevgaard\AltaPay\Callback;

use Psr\Http\Message\ServerRequestInterface;

abstract class Callback implements CallbackInterface
{
    /**
     * @var ServerRequestInterface
     */
    protected $request;

    /**
     * @var array
     */
    protected $body;

    public function __construct(ServerRequestInterface $request)
    {
        $this->request = $request;

        $body = $this->request->getParsedBody();
        $body = is_array($body) ? $body : [];
        $this->body = $body;

        $this->init();
    }
}
