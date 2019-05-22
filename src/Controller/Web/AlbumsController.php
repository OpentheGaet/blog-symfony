<?php

namespace App\Controller\Web;

use App\Entity\Album;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AlbumsController extends AbstractController
{

    /**
     * @Route("/albumsJSON")
     * 
     * @param Request $request
     * @param ObjectManager $manager
     * @return void
     */
    public function getAlbumsJSON(Request $request, ObjectManager $manager)
    {
        $albums = $manager->getRepository(Album::class)->findAll();

        if ($request->isXmlHttpRequest()) {  
            $data = [];  
            $i = 0;  
            foreach($albums as $album) {  
               $row = [
                  'id' => $i,
                  'name' => $album->getName(),  
                  'imageName' => $album->getImageName(),  
               ];   
               $data[$i++] = $row;
            }  
        } 
        return new JsonResponse($data); 
    }

     /**
      * @Route("/albums", name="albums")
      *
      * @param ObjectManager $manager
      * @return void
      */
    public function index(ObjectManager $manager)
    {
        $albums = $manager->getRepository(Album::class)->findAll();

        $data = [];
        $i = 0;
        foreach ($albums as $album) {
            $row = [
                'id'   => $album->getId(),
                'name' => $album->getName(),
                'imageName' => $album->getImageName()
            ];
            $data[$i++] = $row;
        }

        return $this->render('Web/albums/index.html.twig', [
            'data' => $data
        ]);
    }
    
     
    /**
     * @Route("/album/{id}", name="album")
     *
     * @param [type] $id
     * @param ObjectManager $manager
     * @return void
     */
    public function findAlbum($id, ObjectManager $manager)
    {
        $album = $manager->getRepository(Album::class)->find($id);
        $comments = $album->getComments();

        return $this->render('Web/album/index.html.twig', [
            'album' => $album,
            'data'  => $comments
        ]);
    }

}
