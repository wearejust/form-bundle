<?php

namespace Wearejust\FormBundle\DependencyInjection;

use RuntimeException;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class WearejustFormExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loadedBundles = $container->getParameter('kernel.bundles');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $formThemes = [];
        if ($config['form']['theme']) {
            $formThemes[] = $config['form']['theme'];
        }

        if ($this->checkPrestataImageConfig($loadedBundles, $config)) {
            $formThemes[] = 'PrestaImageBundle:form:image_widget.html.twig';
        }

        $container->setParameter('wearejust_form.form.resources', $formThemes);
    }

    /**
     * Allow an extension to prepend the extension configurations.
     *
     * @param ContainerBuilder $container
     */
    public function prepend(ContainerBuilder $container)
    {
        $loadedBundles = $container->getParameter('kernel.bundles');

        $configs = $container->getExtensionConfig($this->getAlias());
        $config = $this->processConfiguration(new Configuration(), $configs);

        $jsAssets = [];
        $cssAssets = [];

        if ($this->checkPrestataImageConfig($loadedBundles, $config)) {
            $jsAssets = array_merge($jsAssets, [
                'bundles/wearejustform/cropper/cropper.min.js',
                'bundles/prestaimage/js/cropper.js',
                'bundles/wearejustform/cropper/init.js',
            ]);

            $cssAssets = array_merge($cssAssets, [
                'bundles/wearejustform/cropper/cropper.min.css',
                'bundles/prestaimage/css/cropper.css'
            ]);
        }

        $container->prependExtensionConfig('just_sonata_theme', [
            'extra_css_assets' => $cssAssets,
            'extra_js_assets' => $jsAssets
        ]);
    }

    /**
     * @param array $loadedBundles
     * @param array $config
     *
     * @return bool
     */
    private function checkPrestataImageConfig(array $loadedBundles, array $config)
    {
        if (! $config['bundles']['prestaimage']) {
            return false;
        }

        if (! array_key_exists('PrestaImageBundle', $loadedBundles) || ! array_key_exists('VichUploaderBundle', $loadedBundles)) {
            throw new RuntimeException('Bundle PrestaImageBundle or VichUploaderBundle isn\'t registered in AppKernel.php');
        }

        return true;
    }
}
