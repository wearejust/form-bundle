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

        $assets = ['js' => [], 'css' => []];
        $assets = $this->addSwitcheryConfig($assets, $config);
        $assets = $this->addPrestataImageConfig($assets, $loadedBundles, $config);

        $container->prependExtensionConfig('just_sonata_theme', [
            'extra_css_assets' => $assets['css'],
            'extra_js_assets' => $assets['js']
        ]);
    }

    /**
     * @param array $loadedBundles
     * @param array $config
     *
     * @return array
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

    /**
     * @param array $assets
     * @param array $loadedBundles
     * @param array $config
     *
     * @return array
     */
    private function addPrestataImageConfig(array $assets, array $loadedBundles, array $config)
    {
        if ($this->checkPrestataImageConfig($loadedBundles, $config)) {
            $assets['js'] = array_merge($assets['js'], [
                'bundles/wearejustform/cropper/cropper.min.js',
                'bundles/prestaimage/js/cropper.js',
                'bundles/wearejustform/cropper/init.js',
            ]);

            $assets['css'] = array_merge($assets['css'], [
                'bundles/wearejustform/cropper/cropper.min.css',
                'bundles/prestaimage/css/cropper.css'
            ]);
        }

        return $assets;
    }

    /**
     * @param array $assets
     * @param array $config
     *
     * @return array
     */
    private function addSwitcheryConfig(array $assets, array $config)
    {
        if ($config['libraries']['switchery']) {
            $assets['js'] = array_merge($assets['js'], [
                'bundles/wearejustform/switchery/switchery.min.js',
                'bundles/wearejustform/switchery/init.js',
            ]);
            $assets['css'] = array_merge($assets['css'], [
                'bundles/wearejustform/switchery/switchery.min.css',
            ]);
        }

        return $assets;
    }
}
