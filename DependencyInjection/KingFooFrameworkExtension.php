<?php

/*
 * Copyright (c) 2016 King Foo <info@king-foo.com>.
 *
 * Source code is released under the MIT License. See LICENSE for more information.
 */

namespace KingFoo\FrameworkBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;

final class KingFooFrameworkExtension extends Extension
{
    /**
     * @inheritdoc
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('kingfoo_framework.validator.mapping_dirs', $config['validation']['mappings']);
    }

    /**
     * @inheritdoc
     */
    public function getAlias()
    {
        return 'kingfoo_framework';
    }
}
