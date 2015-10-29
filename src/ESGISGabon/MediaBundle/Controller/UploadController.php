<?php

namespace ESGISGabon\MediaBundle\Controller;

use BluEstuary\MediaBundle\Form\FileType;
use ESGISGabon\MediaBundle\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UploadController extends Controller
{
    public function uploadImageAction()
    {
        $image = new Image();
        $form = $this->createForm(new FileType(), $image);

        $request = $this->get('request');

        if($request->getMethod() == 'POST'){

            $form->handleRequest($request);

            if($form->isValid()){

                $em = $this->getDoctrine()->getManager();

                $em->persist($image);
                $em->flush();

                return new JsonResponse(array(
                    'id' => $image->getId()
                ));
            }
        }

        return new JsonResponse(array(
            'error' =>(string) $form->getErrors()
        ), 400);

//        $uploadHandler = $this->get('vich_uploader.upload_handler');
    }
}
