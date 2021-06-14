<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class TissueController extends AbstractController
{
    /**
     * @Route("/tissue", name="tissue")
     */
    public function index(): Response
    {
        return $this->render('tissue/index.html.twig');
    }

    /**
     * @Route("/file/upload", name="upload_files")
     */
    public function fileUpload(Request $request)
    {
        $file = $request->files->get('file');
        if(!is_null($file)){
            // generate a random name for the file but keep the extension
            $filename = uniqid() . "." . $file->getClientOriginalExtension();
            $path = "/Users/diananguyen/project/public/uploaded_files";
            $file->move($path, $filename); // move the file to a path
            $status = array('status' => "success","fileUploaded" => true);
         }
        return new JsonResponse(true);

    }
}
