<?php

namespace Mkk\MpdfBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('mkk_mpdf');

        $treeBuilder->getRootNode()
            ->children()
                ->scalarNode('pdf_creator')->defaultValue('Mpdf')->end()
                ->scalarNode('pdf_author')->defaultValue('Mpdf')->end()
            ->end()
            ->children()
                ->arrayNode('mpdf')
                    ->addDefaultsIfNotSet()
                    ->children()
                        // Configuration values
                        ->scalarNode('mode')->defaultValue('')->end()
                        ->scalarNode('orientation')->defaultValue('P')->end()
                        ->scalarNode('format')->defaultValue('A4')->end()
                        ->scalarNode('default_font_size')->defaultValue(0)->end()
                        ->scalarNode('default_font')->defaultValue('')->end()
                        ->scalarNode('margin_left')->defaultValue(15)->end()
                        ->scalarNode('margin_right')->defaultValue(15)->end()
                        ->scalarNode('margin_top')->defaultValue(16)->end()
                        ->scalarNode('margin_bottom')->defaultValue(16)->end()
                        ->scalarNode('margin_header')->defaultValue(9)->end()
                        ->scalarNode('margin_footer')->defaultValue(9)->end()
                        ->scalarNode('tempDir')->defaultValue('%kernel.cache_dir%/tmp/')->end()
                    ->end()
                ->end()
            ->end()
        ;
        return $treeBuilder;
    }
}
