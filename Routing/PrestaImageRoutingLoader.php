<?php

namespace Wearejust\FormBundle\Routing;

use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\RouteCollection;

class PrestaImageRoutingLoader extends Loader
{
    /**
     * @var
     */
    private $loadedBundles;

    /**
     * @param array $loadedBundles
     */
    public function __construct(array $loadedBundles)
    {
        $this->loadedBundles = $loadedBundles;
    }

    /**
     * Loads a resource.
     *
     * @param mixed       $resource The resource
     * @param string|null $type     The resource type or null if unknown
     *
     * @return \Symfony\Component\Routing\RouteCollection
     * @throws \Exception If something went wrong
     */
    public function load($resource, $type = null)
    {
        $collection = new RouteCollection();

        if (array_key_exists('PrestaImageBundle', $this->loadedBundles) &&
            array_key_exists('VichUploaderBundle', $this->loadedBundles)) {
            $this->addPrestaImageBundleRoutes($collection);
        }

        return $collection;
    }

    /**
     * Returns whether this class supports the given resource.
     *
     * @param mixed       $resource A resource
     * @param string|null $type     The resource type or null if unknown
     *
     * @return bool True if this class supports the given resource, false otherwise
     */
    public function supports($resource, $type = null)
    {
        return $type === 'wearejust_form';
    }

    /**
     * @param \Symfony\Component\Routing\RouteCollection $collection
     */
    private function addPrestaImageBundleRoutes(RouteCollection $collection)
    {
        $resource = '@PrestaImageBundle/Resources/config/routing.yml';

        $importedRoutes = $this->import($resource, 'yaml');

        $collection->addCollection($importedRoutes);
    }
}
