<?php

namespace Wearejust\FormBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait Blockable
{
    /**
     * @ORM\Column(type="json", nullable=true)
     */
    protected $content = [];

    public function getContent(): ?array
    {
        return $this->content;
    }

    public function setContent(?array $content): self
    {
        $this->content = $content;

        return $this;
    }
}
