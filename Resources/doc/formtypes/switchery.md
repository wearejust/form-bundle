# Switchery
This FormType is used to display iPhone like checkboxes. To accomplish this we use an external library; [switchery](http://abpetkov.github.io/switchery/). Make sure you enabled the library on your ```config.yml``` under ```libraries```.

## Example:
```php
// SonataAdminBundle

<?php

use Wearejust\FormBundle\Form\Type\SwitcherType;

class DataAmin extends AbstractAdmin
{

  ...

  /**
  * @param FormMapper $formMapper
  */
  protected function configureFormFields(FormMapper $formMapper)
  {
    $formMapper
      ->add('active', SwitcherType::class) // of course, this form type could also be used in Symfony FormBuilder
    ;
  }
}
```
