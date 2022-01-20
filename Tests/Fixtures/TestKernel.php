<?php

namespace Mkk\MpdfBundle\Tests\Fixtures;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

/**
 * Used for functional tests.
 */
class TestKernel extends Kernel
{
    public function registerBundles(): iterable
    {
        return array(
            new \Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new \Mkk\MpdfBundle\MkkMpdfBundle()
        );
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config.yml');
    }

    public function getCacheDir(): string
    {
        return $this->getProjectDir().'/Tests/Fixtures/cache/'.$this->environment;
    }
}

class_alias('Mkk\MpdfBundle\Tests\Fixtures\TestKernel', 'TestKernel');
