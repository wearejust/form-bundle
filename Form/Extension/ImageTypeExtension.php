<?php

namespace Wearejust\FormBundle\Form\Extension;

use Presta\ImageBundle\Form\Type\ImageType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageTypeExtension extends AbstractTypeExtension
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefault('max_width', 0)
            ->setDefault('max_height', 0)
            ->setDefault('preview_width', 558)
            ->setDefault('preview_height', 4096)
            ->setDefault('enable_remote', false)
        ;
    }

    /**
     * Returns the name of the type being extended.
     *
     * @return string The name of the type being extended
     */
    public function getExtendedType()
    {
        return ImageType::class;
    }
}
