<?php

namespace App\Controller\Web;

use App\Entity\User;
use App\Entity\Role;
use App\Form\Web\UserForm;
use App\Form\Web\ProfileForm;
use App\Form\Web\PassForm;
use App\Form\Web\Form;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsersController extends AbstractController
{
   /**
    * @Route("/register")
    *
    * @param Request $request
    * @param ObjectManager $manager
    * @param UserPasswordEncoderInterface $encoder
    * @return void
    */
    public function insertUser(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();

        $form = $this->createForm(UserForm::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);

            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                "Your account is registered now !"
            );

            return $this->redirectToRoute('home');
        }

        return $this->render('Web/users/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/profile", name="profile")
     *
     * @param Request $request
     * @param ObjectManager $manager
     * @return void
     */
    public function modifyUser(Request $request, ObjectManager $manager)
    {
        $user = $this->getUser();

        $form = $this->createForm(ProfileForm::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                "Les données du profil ont été enregistrée avec succès !"
            );
        }

        return $this->render('Web/users/profile.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/profile-pass", name="profile-pass")
     *
     * @param Request $request
     * @param ObjectManager $manager
     * @param UserPasswordEncoderInterface $encoder
     * @return void
     */
    public function changePassword(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder) 
    {
        $user = $this->getUser();

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

                return $this->redirectToRoute('home');
            }
        }

        return $this->render('Web/users/pass.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/register", name="register")
     * 
     * @return void
     */
    public function index()
    {
        return $this->render('Web/register/index.html.twig', [
            'controller_name' => 'AlbumsController',
        ]);
    }
}
