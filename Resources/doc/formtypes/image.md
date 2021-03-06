# ImageType
This FormType makes it possible to use an cropper to crop your images. Before use, make sure in ```config.yml``` you set ```prestaimage``` to true, and make sure you've installed the bundle ```PrestaImageBundle```. See the ```suggests``` section in ```composer.json```.
```PrestaImageBundle``` works closely with ```VichUploaderBundle```, so make sure you install that too.

```php
// SonataAdminBundle

<?php

use Presta\ImageBundle\Form\Type\ImageType;
use Presta\ImageBundle\Model\AspectRatio;

class DataAmin extends AbstractAdmin
{

  ...

  /**
  * @param FormMapper $formMapper
  */
  protected function configureFormFields(FormMapper $formMapper)
  {
    // This is an extension of the original ImageType
    // For full config, please checkout https://github.com/prestaconcept/PrestaImageBundle
    $formMapper
        ->add('imageFile', ImageType::class, [
            'aspect_ratios' => [new AspectRatio(16/9, '')],
        ]);
  }
}
```

If you want your field to be required, please pass through the option 'required' in the options of the field.
Also add the ```@Assert\NotBlank``` to your ```@Vich``` Entity. Don't forget to add the option ```inject_on_load``` in the vich config array to validate.
