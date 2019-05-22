<?php

namespace App\Controller\Admin;

use App\Entity\Album;
use App\Form\Admin\AlbumForm;
use Acme\Bundle\Entity\ImageFile;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AlbumsController extends AbstractController
{

    /**
     * @Route("/admin/insert-album", name="ad_album_insert")
     *
     * @param Request $request
     * @param ObjectManager $manager
     * @return void
     */
    public function insertType(Request $request, ObjectManager $manager)
    {
        $album = new Album();

        $form = $this->createForm(AlbumForm::class, $album);

        $form->handleRequest($request);

        if ($form->isSubmitted() AND $form->isValid()) {
            $manager->persist($album);
            $manager->flush();

            return $this->redirectToRoute('ad_albums');
        }

        return $this->render('Admin/albums/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

   /**
    * @Route("/admin/update-albums{id}", name="ad_album_update")
    *
    * @param [type] $id
    * @param Request $request
    * @param ObjectManager $manager
    * @return void
    */
    public function updateAlbum($id, Request $request, ObjectManager $manager)
    {
        $album = $manager->getRepository(Album::class)->find($id);

        if (!$album) {
            return $this->render('Admin/error/index.html.twig', [
                'error' => 'no user found for this id = '.$id.'',
            ]);
        }

        $form = $this->createForm(AlbumForm::class, $album);

        $form->handleRequest($request);

        if ($form->isSubmitted() AND $form->isValid()) {
            $manager->persist($album);
            $manager->flush();

            return $this->redirectToRoute('ad_albums');
        }

        return $this->render('Admin/albums/update.html.twig', [
            'form'   => $form->createView(),
            'album'  => $album
        ]);
    }

    /**
     * @Route("/admin/delete-album{id}", name="ad_album_delete")
     *
     * @param [type] $id
     * @param ObjectManager $manager
     * @return void
     */
    public function deletAlbum($id, ObjectManager $manager)
    {
        $album = $manager->getRepository(Album::class)->find($id);

        if (!$album) {
            return $this->render('Admin/error/index.html.twig', [
                'error' => 'no user found for this id = '.$id.'',
            ]);
        }

        $manager->remove($album);
        $manager->flush();
        return $this->redirectToRoute('ad_albums');
    }

    /**
     * @Route("/admin/albums", name="ad_albums")
     * 
     * @param ObjectManager $manager
     * @return void
     */
    public function index(ObjectManager $manager)
    {
        $albums = $manager->getRepository(Album::class);

        return $this->render('Admin/albums/index.html.twig', [
            'data' => $albums->findAll(),
        ]);
    }
}
