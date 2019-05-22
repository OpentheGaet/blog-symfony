<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Role;
use App\Form\Admin\UserForm;
use App\Form\Admin\UpdateForm;
use App\Form\Admin\PassForm;
use Symfony\Component\Form\FormError;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdUsersController extends AbstractController
{
    /**
     * @Route("/admin/users-form", name="ad_users_form")
     *
     * @param Request $request
     * @param ObjectManager $manager
     * @param UserPasswordEncoderInterface $encoder
     * @return void
     */
    public function insertUser(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $role = $manager->getRepository(Role::class)->find('1');

        $form = $this->createForm(UserForm::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
                        
            $role->setName('ROLE_ADMIN')
                 ->addUser($user);

            $manager->persist($role);
            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                "Your account is registered now !"
            );

            return $this->redirectToRoute('ad_users');
        }

        return $this->render('Admin/ad_users/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/users-update/{id}", name="ad_users_update")
     *
     * @param [type] $id
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @param ObjectManager $manager
     * @return void
     */
    public function updateUser($id, Request $request, UserPasswordEncoderInterface $encoder, ObjectManager $manager)
    {
        $user = $manager->getRepository(User::class)->find($id);
        
        if (!$user) {
            return $this->render('Admin/error/index.html.twig', [
                'error' => 'no user found for this id = '.$id.'',
            ]);
        }

        $form = $this->createForm(UpdateForm::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('ad_users');
        }

        return $this->render('Admin/ad_users/update.html.twig', [
            'form' => $form->createView(),
            'idUser' => $user->getId()
        ]);
    }

    /**
     * @Route("/admin/user-pass/{id}", name="ad_users_pass")
     *
     * @param [type] $id
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @param ObjectManager $manager
     * @return void
     */
    public function passUser($id, Request $request, UserPasswordEncoderInterface $encoder, ObjectManager $manager)
    {
        $user = $manager->getRepository(User::class)->find($id);
        
        if (!$user) {
            return $this->render('Admin/error/index.html.twig', [
                'error' => 'no user found for this id = '.$id.'',
            ]);
        }

        $form = $this->createForm(PassForm::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            if(!password_verify($user->getOldPassword(), $user->getPassword())){
                $form->get('oldPassword')->addError(new FormError("No password found !"));
            } else {
                $hash = $encoder->encodePassword($user, $user->getNewPassword());

                $user->setPassword($hash);

                $manager->persist($user);
                $manager->flush();

                $this->addFlash(
                    'success',
                    "Votre mot de passe a bien été modifié !"
                );

                return $this->redirectToRoute('ad_users');
            }
        }

        $form = $this->createForm(PassForm::class, $user);
        $form->handleRequest($request);

        return $this->render('Admin/ad_users/pass.html.twig', [
            'form'   => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/users-delete/{id}", name="ad_users_delete")
     *
     * @param [type] $id
     * @param ObjectManager $manager
     * @return void
     */
    public function deleteUser($id, ObjectManager $manager)
    {
        $user = $manager->getRepository(User::class)->find($id);

        if (!$user) {
            return $this->render('Admin/error/index.html.twig', [
                'error' => 'no user found for this id = '.$id.'',
            ]);
        }

        $manager->remove($user);
        $manager->flush();

        return $this->redirectToRoute('ad_users');
    }

    /**
     * @Route("/admin/ad_users", name="ad_users")
     * 
     * @return void
     */
    public function index() 
    {   
        $users = $this->getDoctrine()->getRepository(User::class);
        $query = $users->getAdminUser();

        return $this->render('Admin/ad_users/index.html.twig', [
            'data' => $query,
        ]);
    }
}
