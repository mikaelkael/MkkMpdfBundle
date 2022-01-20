<?php

namespace Mkk\MpdfBundle\Tests\Service;

use Mkk\MpdfBundle\Service\PdfService;
use Mpdf\Mpdf;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @internal
 * @coversNothing
 */
final class PdfServiceTest extends WebTestCase
{
    public function testService()
    {
        $kernel = static::createKernel();
        $kernel->boot();
        $container = $kernel->getContainer();

        $service = $container->get('mkk_mpdf.mpdf');
        static::assertTrue($service instanceof PdfService);
    }

    public function testServiceCreation()
    {
        $kernel = static::createKernel();
        $kernel->boot();
        $container = $kernel->getContainer();

        $service = $container->get('mkk_mpdf.mpdf');
        $pdf = $service->create(['orientation' => 'L', 'format' => 'A5']);
        static::assertTrue($pdf instanceof Mpdf);
        static::assertSame('L', $pdf->CurOrientation);
        static::assertSame(419.53, $pdf->fwPt);
        static::assertSame(595.28, $pdf->fhPt);
        static::assertSame('mikaelkael', $pdf->author);
    }
}
