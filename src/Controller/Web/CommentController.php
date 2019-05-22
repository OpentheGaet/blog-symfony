<?php

namespace App\Controller\Web;

use App\Entity\Comment;
use App\Entity\User;
use App\Entity\Album;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    /**
     * @Route("/sendComment", name="comment")
     * 
     * @param Request $request
     * @param ObjectManager $manager
     * @return void
     */
    public function index(Request $request, ObjectManager $manager)
    {
        $comment = new Comment();
        $user = $manager->getRepository(User::class);
        $album = $manager->getRepository(Album::class);

        if ($request->isXmlHttpRequest()) {
            $data = json_decode($_POST['data']);

            if (empty($data->comment)) {
                return new JsonResponse(false);
            } else if (empty($data->user)) {
                return new JsonResponse(false);
            } else if (empty($data->album)) {
                return new JsonResponse(false);
            }
            
            $comment->setContent($data->comment);
            $comment->setDate(new \DateTime());
            $comment->setUser($user->find($data->user));
            $comment->setAlbum($album->find($data->album));

            $manager->persist($comment);
            $manager->flush();
        }
        $repository = $manager->getRepository(Comment::class);
        $comments   = $repository->getCommentByAlbumId($data->album);

        return new JsonResponse($comments);
    }
}
