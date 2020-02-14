<?php

namespace Wearejust\FormBundle\Entity;

interface BlockableInterface
{
    public function getContent(): ?array;

    public function setContent(?array $content);
}
