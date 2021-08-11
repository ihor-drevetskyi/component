<?php

namespace ComponentBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * @package ComponentBundle\DependencyInjection
 * @author Ihor Drevetskyi <ihor.drevetskyi@gmail.com>
 */
final class Configuration implements ConfigurationInterface
{
    /**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $tree_builder = new TreeBuilder('component');
        $root_node = $tree_builder->getRootNode();
        $root_node
            ->children()
                ->booleanNode('use_memcached')
                    ->defaultValue(false)
                ->end()
            ->end();

        return $tree_builder;
    }
}
