<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UploadType;
use App\Entity\Upload;

class UploadController extends AbstractController
{
    /**
     * @Route("/upload", name="upload")
     */
    public function index(Request $request): Response {
        $upload = new Upload();
        $form= $this->createForm(UploadType::class,$upload);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            //set the images_directory parameter into config/routes services.yaml
            $upload_repository = $this->getParameter('images_directory');

            //we get array of files

            $files = $upload->getName();

            //we loop through the files
            foreach($files as $file){
                $fileName = $file->getClientOriginalName();
                $file->move($upload_repository,$fileName);

            }
            //after uploading images generate a ply file 

            $process = shell_exec('python3.8 point_cloud.py');
            echo $process;
           

            return $this->redirectToRoute('home');
        }


        return $this->render('upload/index.html.twig',array('form' => $form->createView(),));
    }
}
