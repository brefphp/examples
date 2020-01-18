<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\UploadModel;
use App\Form\UploadType;
use Aws\S3\S3Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DefaultController extends AbstractController
{
    /**
     * @var S3Client
     */
    private $s3Client;

    /**
     * @var string
     */
    private $bucket;

    public function __construct(S3Client $s3Client, string $bucket)
    {
        $this->s3Client = $s3Client;
        $this->bucket = $bucket;
    }

    public function index()
    {
        return $this->render('index.html.twig', [
        ]);
    }

    public function upload(Request $request)
    {
        $model = new UploadModel();
        $form = $this->createForm(UploadType::class, $model);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $resource = fopen($model->getFile()->getRealPath(), 'r');

            // This example hard code the file name to "my_file"
            $this->s3Client->upload($this->bucket, 'my_file', $resource, 'private');

            return $this->redirectToRoute('index');
        }

        return $this->render('upload.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function download()
    {
        // This example hard code the file name to "my_file"
        $result = $this->s3Client->getObject([
            'Bucket'=>$this->bucket,
            'Key'=>'my_file'
        ]);

        // We want to hide the S3 URL from the user because we want to control who has access to this file.
        $response = new StreamedResponse(function () use ($result): void {
            echo $result->get('Body')->__toString();
        });

        // This example hard code the content type to application/pdf
        $response->headers->set('Content-Type', 'image/png');
        $response->headers->set('Cache-Control', 'private');
        $response->headers->set('Content-Disposition', 'attachment; filename="my-file.png";');

        return $response;
    }
}