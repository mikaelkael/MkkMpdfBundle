<?php

namespace Mkk\MpdfBundle\Tests\Service;

use Mkk\MpdfBundle\Service\PdfService;
use Mpdf\Mpdf;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PdfServiceTest extends WebTestCase
{

    public function testService()
    {
        $kernel = static::createKernel();
        $kernel->boot();
        $container = $kernel->getContainer();

        $service = $container->get('mkk_mpdf.mpdf');
        $this->assertTrue($service instanceof PdfService);
    }

    public function testServiceCreation()
    {
        $kernel = static::createKernel();
        $kernel->boot();
        $container = $kernel->getContainer();

        $service = $container->get('mkk_mpdf.mpdf');
        $pdf = $service->create(['orientation' => 'L', 'format' => 'A5']);
        $this->assertTrue($pdf instanceof Mpdf);
        $this->assertEquals('L', $pdf->CurOrientation);
        $this->assertEquals(419.53, $pdf->fwPt);
        $this->assertEquals(595.28, $pdf->fhPt);
        $this->assertEquals('mikaelkael', $pdf->author);
    }
}