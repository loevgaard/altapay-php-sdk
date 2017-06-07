<?php

namespace Loevgaard\AltaPay\Response;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

final class PaymentRequestTest extends TestCase
{
    public function testGetters()
    {
        $xml = <<<XML
<APIResponse version="20170228">
<Header>
<Date>2017-05-31T16:00:25+02:00</Date>
<Path>API/createPaymentRequest</Path>
<ErrorCode>0</ErrorCode>
<ErrorMessage/>
</Header>
<Body>
<Result>Success</Result>
<PaymentRequestId>ed420d12-7b17-4fac-973b-c3e0ec9361ea</PaymentRequestId>
<Url>https://testgateway.altapaysecure.com/eCommerce/API/requestForm?pid=ed420d12-7b17-4fac-973b-c3e0ec9361ea</Url>
<DynamicJavascriptUrl>https://testgateway.altapaysecure.com/eCommerce/API/embeddedPaymentWindow?pid=ed420d12-7b17-4fac-973b-c3e0ec9361ea</DynamicJavascriptUrl>
</Body>
</APIResponse>
XML;

        $response = new \GuzzleHttp\Psr7\Response(200, [], $xml);
        $paymentRequestResponse = new PaymentRequest($response);

        $this->assertInstanceOf(PsrResponseInterface::class, $paymentRequestResponse->getResponse());
        $this->assertTrue(is_string($paymentRequestResponse->getResult()));
        $this->assertEquals('Success', $paymentRequestResponse->getResult());
        $this->assertTrue(is_string($paymentRequestResponse->getPaymentRequestId()));

        $this->assertNotFalse(filter_var($paymentRequestResponse->getUrl(), FILTER_VALIDATE_URL));
        $this->assertNotFalse(filter_var($paymentRequestResponse->getDynamicJavascriptUrl(), FILTER_VALIDATE_URL));
    }
}
