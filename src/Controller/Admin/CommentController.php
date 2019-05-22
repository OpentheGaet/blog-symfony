<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentController extends AbstractController
{
    /**
     * @Route("/admin/show-comment/{id}", name="show-comment")
     *
     * @param [type] $id
     * @param ObjectManager $manager
     * @return void
     */
    public function getComment($id, ObjectManager $manager) 
    {
        $comment = $manager->getRepository(Comment::class)->find($id);

        return $this->render('Admin/comments/comment.html.twig', [
            'comment' => $comment
        ]);
    }

   /**
    * @route("/admin/ad_comment_delete/{id}", name="ad_comment_delete")
    *
    * @param [type] $id
    * @param ObjectManager $manager
    * @return void
    */
    public function deleteComment($id, ObjectManager $manager) 
    {
        $comment = $manager->getRepository(Comment::class)->find($id);

        if (!$comment) {
            return $this->render('Admin/error/index.html.twig', [
                'error' => 'no user found for this id = '.$id.'',
            ]);
        }

        $manager->remove($comment);
        $manager->flush();

        return $this->redirectToRoute('ad_comments');
    }

    /**
     * @Route("/admin/comments", name="ad_comments")
     *
     * @param ObjectManager $manager
     * @return void
     */
    public function index(ObjectManager $manager)
    {
        $comments = $manager->getRepository(Comment::class)->findAll();

        return $this->render('Admin/comments/index.html.twig', [
            'data' => $comments
        ]);
    }
}
