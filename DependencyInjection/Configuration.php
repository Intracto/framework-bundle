<?php

/*
 * Copyright (c) 2016 King Foo <info@king-foo.com>.
 *
 * Source code is released under the MIT License. See LICENSE for more information.
 */

namespace KingFoo\FrameworkBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    /**
     * @inheritdoc
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('kingfoo_framework');

        $rootNode
            ->children()
                ->arrayNode('validation')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('mappings')
                        	->defaultValue(['%kernel.root_dir%/config/validation'])
                        	->prototype('scalar')->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
