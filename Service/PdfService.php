<?php

namespace Mkk\MpdfBundle\Service;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Mpdf\Mpdf;

class PdfService
{
    use ContainerAwareTrait;

    /**
     * @var string
     */
    protected $className;

    /**
     * Class constructor.
     */
    public function __construct(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    /**
     * Create a directory.
     *
     * @param string $filePath
     *
     * @throws \RuntimeException
     */
    private function createDir($filePath)
    {
        $filesystem = new Filesystem();
        if (false === $filesystem->mkdir($filePath)) {
            throw new \RuntimeException(sprintf(
                'Could not create directory %s',
                $filePath
            ));
        }
    }

    /**
     * Creates a new instance of Mpdf.
     *
     * @throws \Mpdf\MpdfException
     *
     * @return Mpdf
     */
    public function create(array $config = [])
    {
        $defaults = $this->container->getParameter('mkk_mpdf.mpdf');
        $config = array_merge($defaults, $config);
        $this->createDir($config['tempDir']);
        $mpdf = new Mpdf($config);
        $mpdf->SetCreator($this->container->getParameter('mkk_mpdf.pdf_creator'));
        $mpdf->SetAuthor($this->container->getParameter('mkk_mpdf.pdf_author'));

        return $mpdf;
    }
}
