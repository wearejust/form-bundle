<?php

namespace Wearejust\FormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

class SwitcherType extends AbstractType
{
    /**
     * @param \Symfony\Component\Form\FormView      $view
     * @param \Symfony\Component\Form\FormInterface $form
     * @param array                                 $options
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['attr']['class'] .= ' js-switchery';
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'wearejust_switcher';
    }

    /**
     * @return string
     */
    public function getParent()
    {
        return 'Symfony\Component\Form\Extension\Core\Type\CheckboxType';
    }
}
