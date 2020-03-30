<?php

namespace Mkk\MpdfBundle\Tests\Response;

use Mpdf\Mpdf;
use PHPUnit\Framework\TestCase;
use Mkk\MpdfBundle\Response\PdfResponse;

class PdfResponseTest extends TestCase
{
    public function testResponseWithData()
    {
        $pdfResponse = new PdfResponse('test');
        $this->assertEquals(200, $pdfResponse->getStatusCode());
        $this->assertFalse($pdfResponse->headers->has('test'));
        $this->assertEquals('test', substr($pdfResponse->getContent(), 0, 5));
        $this->assertEquals('application/pdf', $pdfResponse->headers->get('content-type'));
    }

    public function testResponseWithMcpdfObject()
    {
        $pdfResponse = new PdfResponse(new Mpdf());
        $this->assertEquals(200, $pdfResponse->getStatusCode());
        $this->assertFalse($pdfResponse->headers->has('test'));
        $this->assertEquals('%PDF-', substr($pdfResponse->getContent(), 0, 5));
        $this->assertEquals('application/pdf', $pdfResponse->headers->get('content-type'));
    }

    public function testResponseWithHeaders()
    {
        $pdfResponse = new PdfResponse('test', 123, array('test' => 'test'));
        $this->assertEquals(123, $pdfResponse->getStatusCode());
        $this->assertTrue($pdfResponse->headers->has('test'));
    }
}