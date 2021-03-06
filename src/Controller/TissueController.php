<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\TissueRepository;
use App\Entity\Tissue;
use Doctrine\ORM\Mapping as ORM;

class TissueController extends AbstractController
{
    /**
     * @Route("/tissue", name="tissue")
     */
    public function index(): Response
    {
        //return $this->render('tissue/index.html.twig');
        return $this->render('tissue/webgl_loader_nrrd.html.twig');
    }

    /**
     * @Route("/tissue/get/all", name="tissue_get_all")
     */
    public function getTissue(){
        //$cells = $this->getDoctrine()->getRepository(Tissue::class)->findAll();
        //return $this->json($cells);
        // read from file csv
        // return to client
        $fileName = "uploaded_files/data.csv";
        $cells = Array();
        $id = 0;
        if (($handle = fopen($fileName, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($id != 0){ //ignore header
                    dump($data);
                    $cell = [
                        'id' => $id,
                        'sampleName' => $data[0],
                        'wellNumber' => $data[1],
                        'xMosaic' => $data[2],
                        'yMosaic' => $data[3],
                        'objectNumber' => $data[4],
                        'cellClass' => $data[5],
                        'centroidX' => $data[6],
                        'centroidY' => $data[7],
                        'centroidZ' => $data[8],
                        'volume' => $data[9],
                        'compactness' => $data[10],
                        'elongation' => $data[11],
                    ];
                    array_push($cells, $cell);
                }
                $id++;
            }
            fclose($handle);
        }
        return $this->json($cells);
    }

    /**
     * @Route("/tissue/get/{cellType}", name="tissue_get_all_by_type")
     */
    public function getTissueByType($cellType){
        $tissues = $this->getDoctrine()->getRepository(Tissue::class)->findBy([
            'cellClass' => $cellType
        ]);
        return $this->json($tissues);
    }

    /**
     * @Route("/tissue/get/statistics", name="tissue_get_statistics")
     */
    public function getStatistics(Request $request)
    {
        $data = json_decode($request->getContent());
        $centroid = $data->centroid;
        $size = $data->size;
        // get the left-bottom point of the plane
        $x_low = $centroid->x - ($size / 2);
        $y_low = $centroid->y - ($size / 2);
        // get the right-top point of the plane
        $x_high = $centroid->x + ($size / 2);
        $y_high = $centroid->y + ($size / 2);
        $cellClass = 'lectine';
        $tissues = $this->getDoctrine()->getRepository(Tissue::class)->findAllRecordsInsidePlane(
            $x_low, $x_high, $y_low, $y_high, $centroid->z, $cellClass
        );

        return $this->json($tissues);
    }

    /**
     * @Route("/file/upload/data", name="upload_files_data")
     */
    public function fileUploadData(Request $request)
    {
        $file = $request->files->get('file');
        //$fileName = $request->get("file_name");
        $fileName = "uploaded_files/data.csv";
        if(!is_null($file)){
            // generate a random name for the file but keep the extension
            //$filename = uniqid() . "." . $file->getClientOriginalExtension();
            $path = "/Users/diananguyen/project/public/uploaded_files";
            $file->move($path, $fileName); // move the file to a path
            $status = array('status' => "success", "fileUploaded" => true);
         }
        return new JsonResponse(true);
    }

    /**
     * @Route("/file/upload", name="upload_files")
     */
    public function fileUpload(Request $request)
    {
        $file = $request->files->get('file');
        //$fileName = $request->get("file_name");
        $fileName = "uploaded_files/image.nrrd";
        if(!is_null($file)){
            // generate a random name for the file but keep the extension
            //$filename = uniqid() . "." . $file->getClientOriginalExtension();
            $path = "/Users/diananguyen/project/public/uploaded_files";
            $file->move($path, $fileName); // move the file to a path
            $status = array('status' => "success", "fileUploaded" => true);
         }
        return new JsonResponse(true);
    }
}
