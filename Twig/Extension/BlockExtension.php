<?php

namespace Wearejust\FormBundle\Twig\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Wearejust\FormBundle\Entity\BlockableInterface;

class BlockExtension extends AbstractExtension
{
    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('block_converter', function (BlockableInterface $entity) {
                $blocks = $entity->getContent();
                if (! count($blocks)) {
                    return [];
                }

                $blocks = $blocks['blocks'];

                return array_column($blocks, 'data', 'type');
            }),
        ];
    }
}
