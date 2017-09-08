<?php

namespace Loevgaard\AltaPay\Payload\PaymentRequest;

use PHPUnit\Framework\TestCase;

final class ConfigTest extends TestCase
{
    public function testGettersSetters()
    {
        $config = new Config();
        $config->setCallbackVerifyOrder('verify')
            ->setCallbackNotification('notification')
            ->setCallbackOpen('open')
            ->setCallbackRedirect('redirect')
            ->setCallbackFail('fail')
            ->setCallbackOk('ok')
            ->setCallbackForm('form');

        $this->assertSame('verify', $config->getCallbackVerifyOrder());
        $this->assertSame('notification', $config->getCallbackNotification());
        $this->assertSame('open', $config->getCallbackOpen());
        $this->assertSame('redirect', $config->getCallbackRedirect());
        $this->assertSame('fail', $config->getCallbackFail());
        $this->assertSame('ok', $config->getCallbackOk());
        $this->assertSame('form', $config->getCallbackForm());
    }
}
