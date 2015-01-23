<?php
namespace Rudak\ContactBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode    = $treeBuilder->root('rudak_contact');

        $rootNode
            ->children()
                ->scalarNode('email_from')
                    ->defaultValue('from@email.fr')
                ->end()
                ->scalarNode('email_to')
                    ->defaultValue('to@email.fr')
                ->end()
            ->end();

        return $treeBuilder;
    }
}