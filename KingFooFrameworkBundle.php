<?php

/*
 * Copyright (c) 2016 King Foo <info@king-foo.com>.
 *
 * Source code is released under the MIT License. See LICENSE for more information.
 */

namespace KingFoo\FrameworkBundle;

use KingFoo\FrameworkBundle\DependencyInjection\Compiler\AddValidationMappingsPass;
use KingFoo\FrameworkBundle\DependencyInjection\Compiler\RegisterAbstractRepositoryPass;
use KingFoo\FrameworkBundle\DependencyInjection\KingFooFrameworkExtension;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class KingFooFrameworkBundle extends Bundle
{
    /**
     * @inheritdoc
     */
	public function getContainerExtension()
    {
        return new KingFooFrameworkExtension();
    }

    /**
     * @inheritdoc
     */
	public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new AddValidationMappingsPass(), PassConfig::TYPE_BEFORE_REMOVING);
        $container->addCompilerPass(new RegisterAbstractRepositoryPass());
    }
}
