<?php

namespace Wearejust\FormBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('wearejust_form');

        $this->addFormConfig($rootNode);

        return $treeBuilder;
    }

    /**
     * Adds form configuration.
     *
     * @param ArrayNodeDefinition $rootNode
     */
    private function addFormConfig(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
                ->arrayNode('form')
                    ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('theme')
                            ->defaultValue('WearejustFormBundle:Form:fields.html.twig')
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('bundles')
                    ->addDefaultsIfNotSet()
                        ->children()
                            ->booleanNode('prestaimage')->defaultTrue()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}
