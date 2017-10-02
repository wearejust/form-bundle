# wearejust/form-bundle

This package adds extra functionality to Symfony Form

Installation
============

Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require wearejust/form-bundle "~0.1"
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Step 2: Enable the Bundle
-------------------------

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new Wearejust\FormBundle\WearejustFormBundle(),
        );

        // ...
    }

    // ...
}
```

Step 3: Configure (optional/reference)
-------------------------

```yml
// config.yml

wearejust_form:
    form:
        theme: WearejustFormBundle:Form:fields.html.twig
    bundles:
        prestaimage: true // Defaults to true use PrestaImageBundle (see suggests in composer.json)
```

```yml
// routing.yml
wearejust_form:
    resource: .
    type: wearejust_form
```


Step 3: Usage
-------------------------

* [Readonly](Resources/doc/formtypes/readonly.md)
* [Image/Crop](Resources/doc/formtypes/image.md)
