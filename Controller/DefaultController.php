<?php

namespace Wearejust\FormBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('WearejustFormBundle:Default:index.html.twig');
    }
}
