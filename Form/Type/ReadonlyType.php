<?php

namespace Wearejust\FormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReadonlyType extends AbstractType
{
    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'mapped' => false,
            'required' => false,
        ]);
    }

    /**
     * @param \Symfony\Component\Form\FormView      $view
     * @param \Symfony\Component\Form\FormInterface $form
     * @param array                                 $options
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $field = $options['sonata_field_description'];
        $field->setOption('safe', true);

        switch ($field->getMappingType()) {
            case 'array':
                $template = 'SonataAdminBundle:CRUD:show_array.html.twig';
                break;
            case 'boolean':
                $template = 'SonataAdminBundle:CRUD:show_boolean.html.twig';
                break;
            case 'choice':
                $template = 'SonataAdminBundle:CRUD:show_choice.html.twig';
                break;
            case 'compare':
                $template = 'SonataAdminBundle:CRUD:show_compare.html.twig';
                break;
            case 'currency':
                $template = 'SonataAdminBundle:CRUD:show_currency.html.twig';
                break;
            case 'date':
                $template = 'SonataAdminBundle:CRUD:show_date.html.twig';
                break;
            case 'datetime':
                $template = 'SonataAdminBundle:CRUD:show_datetime.html.twig';
                break;
            case 'email':
                $template = 'SonataAdminBundle:CRUD:show_email.html.twig';
                break;
            case 'html':
                $template = 'SonataAdminBundle:CRUD:show_html.html.twig';
                break;
            case 'percent':
                $template = 'SonataAdminBundle:CRUD:show_percent.html.twig';
                break;
            case 'time':
                $template = 'SonataAdminBundle:CRUD:show_time.html.twig';
                break;
            case 'trans':
                $template = 'SonataAdminBundle:CRUD:show_trans.html.twig';
                break;
            case 'url':
                $template = 'SonataAdminBundle:CRUD:show_url.html.twig';
                break;
            default:
                $template = 'SonataAdminBundle:CRUD:base_show_field.html.twig';
                break;
        }

        $field->setTemplate($template);

        $view->vars['field'] = $field;
        $view->vars['object'] = $view->parent->vars['value'];
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'wearejust_readonly';
    }
}
