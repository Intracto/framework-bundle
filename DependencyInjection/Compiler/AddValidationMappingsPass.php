<?php

/*
 * Copyright (c) 2016 King Foo <info@king-foo.com>.
 *
 * Source code is released under the MIT License. See LICENSE for more information.
 */

namespace KingFoo\FrameworkBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\Finder\Finder;

final class AddValidationMappingsPass implements CompilerPassInterface
{
    /**
     * @inheritdoc
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('validator.builder')) {
            return;
        }

        $dirs = $container->getParameter('kingfoo_framework.validator.mapping_dirs');

        if (count($dirs) === 0) {
            return;
        }

        $xmlMappings = $this->findFiles('*.validation.xml', $dirs);

        if (count($xmlMappings)) {
            $container->getDefinition('validator.builder')->addMethodCall('addXmlMappings', [$xmlMappings]);
        }

        $yamlMappings = $this->findFiles('*.validation.yml', $dirs);

        if (count($yamlMappings)) {
            $container->getDefinition('validator.builder')->addMethodCall('addYamlMappings', [$yamlMappings]);
        }
    }

    /**
     * @param string $pattern
     * @param array $dirs
     * @return array
     */
    private function findFiles($pattern, array $dirs)
    {
        $finder = Finder::create()->files()->name($pattern)->in($dirs);

        return array_map(function (\SplFileInfo $file) {
            return $file->getRealPath();
        }, iterator_to_array($finder));
    }
}
