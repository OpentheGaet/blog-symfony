<?php

namespace App\Controller\Web;

use App\Entity\Artist;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ArtistController extends AbstractController
{
    /**
     * @Route("/artistsJSON")
     * 
     * @param Request $request
     * @return void
     */
    public function getartistsJSON(Request $request)
    {
        $artists = $this->getDoctrine()->getRepository(Artist::class)->findAll();

        if ($request->isXmlHttpRequest()) {
            $data = [];
            $i = 0;
            foreach ($artists as $artist) {
                $row = [
                    'id'   => $i,
                    'name' => $artist->getName()
                ];
                $data[$i++] = $row;
            }
            return new jsonResponse($data);
        }
    }

    /**
     * @Route("/artists", name="artists")
     * 
     * @param ObjectManager $manager
     * @return void
     */
    public function index(ObjectManager $manager)
    {
        $artists = $manager->getRepository(Artist::class)->findAll();

        return $this->render('Web/artists/index.html.twig', [
            'data' => $artists
        ]);
    }
}
