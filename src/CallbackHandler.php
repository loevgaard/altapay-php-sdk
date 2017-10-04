<?php
namespace Loevgaard\AltaPay;

use Loevgaard\AltaPay\Callback\Form as FormCallback;
use Loevgaard\AltaPay\Callback\Xml as XmlCallback;
use Psr\Http\Message\ServerRequestInterface;

class CallbackHandler
{
    /**
     * Will take a Psr Server Request and return a Form or Xml callback object
     * that represent the actual callback
     *
     * @param ServerRequestInterface $request
     * @return FormCallback|XmlCallback
     */
    public function handleCallback(ServerRequestInterface $request)
    {
        $body = $request->getParsedBody();
        $body = is_array($body) ? $body : [];
        if (isset($body['xml'])) {
            $callback = new XmlCallback($request);
        } else {
            $callback = new FormCallback($request);
        }

        return $callback;
    }
}
