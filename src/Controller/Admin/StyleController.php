<?php

namespace App\Controller\Admin;

use App\Entity\Type;
use App\Form\Admin\TypeForm;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class StyleController extends AbstractController
{

     /**
      * @Route("/admin/insert-styles", name="ad_styles_insert")
      *
      * @param Request $request
      * @param ObjectManager $manager
      * @return void
      */
    public function insertType(Request $request, ObjectManager $manager)
    {
        $type = new Type();

        $form = $this->createForm(TypeForm::class, $type);

        $form->handleRequest($request);

        if ($form->isSubmitted() AND $form->isValid()) {
            $manager->persist($type);
            $manager->flush();

            return $this->redirectToRoute('ad_styles');
        }

        return $this->render('Admin/styles/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/update-styles{id}", name="ad_styles_update")
     *
     * @param [type] $id
     * @param Request $request
     * @param ObjectManager $manager
     * @return void
     */
    public function updateType($id, Request $request, ObjectManager $manager)
    {
        $type = $manager->getRepository(Type::class)->find($id);

        if (!$type) {
            return $this->render('Admin/error/index.html.twig', [
                'error' => 'no user found for this id = '.$id.'',
            ]);
        }

        $form = $this->createForm(TypeForm::class, $type);

        $form->handleRequest($request);

        if ($form->isSubmitted() AND $form->isValid()) {
            $manager->persist($type);
            $manager->flush();

            return $this->redirectToRoute('ad_styles');
        }

        return $this->render('Admin/styles/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/delete-styles{id}", name="ad_styles_delete")
     *
     * @param [type] $id
     * @param ObjectManager $manager
     * @return void
     */
    public function deletType($id, ObjectManager $manager)
    {
        $type = $manager->getRepository(Type::class)->find($id);

        if (!$type) {
            return $this->render('Admin/error/index.html.twig', [
                'error' => 'no user found for this id = '.$id.'',
            ]);
        }

        $manager->remove($type);
        $manager->flush();
        return $this->redirectToRoute('ad_styles');

    }

    /**
     * @Route("/admin/styles", name="ad_styles")
     *
     * @param ObjectManager $manager
     * @return void
     */
    public function index(ObjectManager $manager)
    {
        $style = $manager->getRepository(Type::class);
        
        return $this->render('Admin/styles/index.html.twig', [
            'data' => $style->findAll(),
        ]);
    }
}
