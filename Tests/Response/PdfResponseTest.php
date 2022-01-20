<?php

namespace Mkk\MpdfBundle\Tests\Response;

use Mpdf\Mpdf;
use PHPUnit\Framework\TestCase;
use Mkk\MpdfBundle\Response\PdfResponse;

/**
 * @internal
 * @coversNothing
 */
final class PdfResponseTest extends TestCase
{
    public function testResponseWithData()
    {
        $pdfResponse = new PdfResponse('test');
        static::assertSame(200, $pdfResponse->getStatusCode());
        static::assertFalse($pdfResponse->headers->has('test'));
        static::assertSame('test', substr($pdfResponse->getContent(), 0, 5));
        static::assertSame('application/pdf', $pdfResponse->headers->get('content-type'));
    }

    public function testResponseWithMcpdfObject()
    {
        $pdfResponse = new PdfResponse(new Mpdf());
        static::assertSame(200, $pdfResponse->getStatusCode());
        static::assertFalse($pdfResponse->headers->has('test'));
        static::assertSame('%PDF-', substr($pdfResponse->getContent(), 0, 5));
        static::assertSame('application/pdf', $pdfResponse->headers->get('content-type'));
    }

    public function testResponseWithHeaders()
    {
        $pdfResponse = new PdfResponse('test', 123, ['test' => 'test']);
        static::assertSame(123, $pdfResponse->getStatusCode());
        static::assertTrue($pdfResponse->headers->has('test'));
    }
}
