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
                $blocksArr = [];
                $blocks = $blocks['blocks'];

                $blocksArr = array_map( function ($a, $k) use ($blocks) { 
                    $a['prevType'] = $k > 0 ? $blocks[ $k - 1 ]['type'] : null;
                    $a['nextType'] = $k < ( count($blocks) - 1 ) ? $blocks[ $k + 1 ]['type'] : null;
                    return $a; 
                }, $blocks, array_keys($blocks));

                return $blocksArr;
            }),
        ];
    }
}
