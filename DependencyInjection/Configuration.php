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
                ->scalarNode('email_subject')
                    ->defaultValue('Email subject default value')
                ->end()
                ->scalarNode('use_reCaptcha')
                    ->defaultFalse()
                ->end()
                ->scalarNode('reCaptcha_secret_key')
                    ->defaultValue('azertyuiop123456789')
                ->end()
            ->end();
        return $treeBuilder;
    }
}