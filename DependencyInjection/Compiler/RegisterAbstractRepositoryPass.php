<?php

/*
 * Copyright (c) 2016 King Foo <info@king-foo.com>.
 *
 * Source code is released under the MIT License. See LICENSE for more information.
 */

namespace KingFoo\FrameworkBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

final class RegisterAbstractRepositoryPass implements CompilerPassInterface
{
    /**
     * @inheritdoc
     */
    public function process(ContainerBuilder $container)
    {
        if ($container->hasAlias('doctrine.orm.entity_manager')) {
            $definition = new Definition('Doctrine\ORM\EntityRepository');
            $definition->setAbstract(true);
            $definition->setFactory([new Reference('doctrine.orm.entity_manager'), 'getRepository']);
            $definition->setPublic(false);

            $container->setDefinition('kingfoo_framework.doctrine_orm.abstract_repository', $definition);
        }

        if ($container->hasAlias('doctrine_mongodb.odm.document_manager')) {
            $definition = new Definition('Doctrine\ODM\MongoDB\DocumentRepository');
            $definition->setAbstract(true);
            $definition->setFactory([new Reference('doctrine_mongodb.odm.document_manager'), 'getRepository']);
            $definition->setPublic(false);

            $container->setDefinition('kingfoo_framework.doctrine_mongodb_odm.abstract_repository', $definition);
        }
    }
}
