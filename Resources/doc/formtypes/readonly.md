# Readonly
This FormType is used to display readonly form types. So it doesn't allow you to edit the field you're adding to the form. It justs output the value that belongs to that key as a string. 

## Example:
```php
// SonataAdminBundle

<?php

use Wearejust\FormBundle\Form\Type\ReadonlyType;

class DataAmin extends AbstractAdmin
{

  ...

  /**
  * @param FormMapper $formMapper
  */
  protected function configureFormFields(FormMapper $formMapper)
  {
    $formMapper
      ->add('readonlyfield', ReadonlyType::class) // of course, this form type could also be used in Symfony FormBuilder
    ;
  }
}
```
