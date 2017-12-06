<?php

namespace Loevgaard\AltaPay\Callback;

use Loevgaard\AltaPay\Callback\Form as FormCallback;
use Loevgaard\AltaPay\Callback\Redirect as RedirectCallback;
use Loevgaard\AltaPay\Callback\Xml as XmlCallback;
use Psr\Http\Message\ServerRequestInterface;

class CallbackFactory
{
    /**
     * Will take a Psr Server Request and return a Form, Xml or Redirect
     * callback object that represent the actual callback
     *
     * @param ServerRequestInterface $request
     * @throws \InvalidArgumentException
     * @return CallbackInterface
     */
    public function create(ServerRequestInterface $request) : CallbackInterface
    {
        $callbacks = [
            XmlCallback::class,
            FormCallback::class,
            RedirectCallback::class
        ];

        foreach ($callbacks as $callback) {
            if (call_user_func([$callback, 'initable'], $request)) {
                return new $callback($request);
            }
        }

        throw new \InvalidArgumentException('A callback could not be instantiated');
    }
}
