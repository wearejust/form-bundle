<?php

namespace Wearejust\FormBundle\EventListener;

use Oneup\UploaderBundle\Event\PostPersistEvent;

class EditorJSUploadListener
{
    public function onUpload(PostPersistEvent $event)
    {
        $file = $event->getFile();

        $fullPath = $file->getPathname();
        $fullPath = preg_replace('#.*public#', '', $fullPath);

        $response = $event->getResponse();
        $response['success'] = 1;
        $response['file'] = [
            'url' => $fullPath
        ];
    }
}
