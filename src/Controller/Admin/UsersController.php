<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\Admin\UpdateForm;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Comment;

class UsersController extends AbstractController
{

    /**
     * @Route("/admin/user-check/{id}", name="user_check")
     *
     * @param [type] $id
     * @param ObjectManager $manager
     * @return void
     */
    public function updateUser($id, ObjectManager $manager)
    {
        $user = $manager->getRepository(User::class)->find($id);
        
        if (!$user) {
            return $this->render('Admin/error/index.html.twig', [
                'error' => 'no user found for this id = '.$id.'',
            ]);
        }

        $form = $this->createForm(UpdateForm::class, $user);

        return $this->render('Admin/users/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/users-cli-delete/{id}", name="cli_users_delete")
     *
     * @param [type] $id
     * @param ObjectManager $manager
     * @return void
     */
    public function deleteUser($id, ObjectManager $manager)
    {
        $user = $manager->getRepository(User::class)->find($id);
        $commentsArray = $manager->getRepository(Comment::class)->findBy(['user' => $id]);
        $arrayLength = count($commentsArray);
        if (!$user) {
            return $this->render('Admin/error/index.html.twig', [
                'error' => 'no user found for this id = '.$id.'',
            ]);
        }

        for($i = 0; $i < $arrayLength; $i++) {
            $manager->remove($commentsArray[$i]);
        }
        
        $manager->remove($user);
        $manager->flush();

        return $this->redirectToRoute('ad_users');
    }

    /**
     * @Route("/admin/users", name="users")
     *
     * @param ObjectManager $manager
     * @return void
     */
    public function index(ObjectManager $manager) 
    {   
        $users = $manager->getRepository(User::class);
        $query = $users->getUser();

        return $this->render('Admin/users/index.html.twig', [
            'data' => $query,
        ]);
    }
}
