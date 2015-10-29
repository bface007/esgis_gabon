<?php
/**
 * Created by PhpStorm.
 * User: bface007
 * Date: 23/10/15
 * Time: 23:19
 */

namespace BluEstuary\MediaBundle\Form\DataTransformer;


use Doctrine\Common\Proxy\Exception\InvalidArgumentException;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class FileTransformer implements DataTransformerInterface
{


    public function transform($fileName)
    {
//throw new InvalidArgumentException(print_r($fileName));
        return array(
            'fileName' => $fileName
        );
    }


    public function reverseTransform($data)
    {
//        throw new InvalidArgumentException(print_r($data));
        return $data['fileName'];
    }
}