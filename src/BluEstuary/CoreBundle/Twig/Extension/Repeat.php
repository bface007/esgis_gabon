<?php

namespace BluEstuary\CoreBundle\Twig\Extension;

class Repeat extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('repeat', array($this, 'repeater'))
        );
    }

    public function repeater($word = "", $loop = 0)
    {
        $display = "";

        for($i = 0; $i < $loop; $i++)
            $display .= $word;

        return $display;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'repeat_extension';
    }
}
