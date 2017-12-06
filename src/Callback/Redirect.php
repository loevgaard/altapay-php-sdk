<?php

namespace Loevgaard\AltaPay\Callback;

use Psr\Http\Message\ServerRequestInterface;

class Redirect extends Callback
{
    /**
     * ISO 639 alpha 2 language code
     *
     * @var string
     */
    protected $language;

    public function init()
    {
        $this->language = $this->body['language'];
    }

    public static function initable(ServerRequestInterface $request): bool
    {
        $body = static::getBodyFromRequest($request);

        return isset($body['language']);
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }
}
