<?php

namespace Wearejust\FormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\CallbackTransformer;

class EditorjsType extends AbstractType
{
    /**
     * @param \Symfony\Component\Form\FormView      $view
     * @param \Symfony\Component\Form\FormInterface $form
     * @param array                                 $options
     */
    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['attr']['rel'] = 'editorjs';
        $view->vars['attr']['style'] = 'display:none;';
        $view->vars['image_mapping'] = $options['image_mapping'];
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->addModelTransformer(new CallbackTransformer(
                function ($blocksAsString) {
                    return json_encode($blocksAsString);
                },
                function ($blocksAsArray) {
                    return json_decode($blocksAsArray, true);
                }
            ))
        ;
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     *
     * @throws \Symfony\Component\OptionsResolver\Exception\AccessException
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'required' => false,
            'image_mapping' => 'useruploads',
        ]);
    }


    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'wearejust_editorjs';
    }

    /**
     * @return string
     */
    public function getParent()
    {
        return TextareaType::class;
    }
}
