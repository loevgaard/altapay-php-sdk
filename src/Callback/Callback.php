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
        $this->body = static::getBodyFromRequest($request);

        $this->init();
    }

    /**
     * Takes a ServerRequestInterface and returns the body as an array
     *
     * @param ServerRequestInterface $request
     * @return array
     */
    public static function getBodyFromRequest(ServerRequestInterface $request) : array
    {
        $body = $request->getParsedBody();
        return is_array($body) ? $body : [];
    }
}
