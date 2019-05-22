<?php

namespace App\Controller\Admin;

use App\Entity\Artist;
use App\Form\Admin\ArtistForm;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ArtistController extends AbstractController
{

     /**
      * @Route("/admin/insert-artist", name="ad_artist_insert")
      *
      * @param Request $request
      * @param ObjectManager $manager
      * @return void
      */
    public function insertType(Request $request, ObjectManager $manager)
    {
        $artist = new Artist();

        $form = $this->createForm(ArtistForm::class, $artist);

        $form->handleRequest($request);

        if ($form->isSubmitted() AND $form->isValid()) {
            $manager->persist($artist);
            $manager->flush();

            return $this->redirectToRoute('ad_artists');
        }

        return $this->render('Admin/artists/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/update-artist{id}", name="ad_artist_update")
     *
     * @param [type] $id
     * @param Request $request
     * @param ObjectManager $manager
     * @return void
     */
    public function updateArtist($id, Request $request, ObjectManager $manager)
    {
        $artist = $manager->getRepository(Artist::class)->find($id);

        if (!$artist) {
            return $this->render('Admin/error/index.html.twig', [
                'error' => 'no user found for this id = '.$id.'',
            ]);
        }

        $form = $this->createForm(ArtistForm::class, $artist);

        $form->handleRequest($request);

        if ($form->isSubmitted() AND $form->isValid()) {
            $manager->persist($artist);
            $manager->flush();

            return $this->redirectToRoute('ad_artists');
        }

        return $this->render('Admin/artists/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/delete-artist{id}", name="ad_artist_delete")
     *
     * @param [type] $id
     * @param ObjectManager $manager
     * @return void
     */
    public function deletAtist($id, ObjectManager $manager)
    {
        $artist = $manager->getRepository(Artist::class)->find($id);
        $artist->setImage('');

        if (!$artist) {
            return $this->render('Admin/error/index.html.twig', [
                'error' => 'no user found for this id = '.$id.'',
            ]);
        }

        $manager->remove($artist);
        $manager->flush();
        return $this->redirectToRoute('ad_artists');

    }
    
    /**
     * @Route("/admin/artists", name="ad_artists")
     *
     * @param ObjectManager $manager
     * @return void
     */
    public function index(ObjectManager $manager)
    {
        $artist = $manager->getRepository(Artist::class);

        return $this->render('Admin/artists/index.html.twig', [
            'data' => $artist->findAll(),
        ]);
    }
}
