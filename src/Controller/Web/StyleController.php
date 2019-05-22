<?php

namespace App\Controller\Web;

use App\Entity\Type;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StyleController extends AbstractController
{
    /**
     * @Route("/stylesJSON")
     *
     * @param Request $request
     * @return void
     */
    public function getStylesJSON(Request $request) 
    {
        $styles = $this->getDoctrine()->getRepository(Type::class)->findAll();

        if ($request->isXmlHttpRequest()) {
            $data = [];
            $i = 0;
            foreach ($styles as $style) {
                $row = [
                    'id'   => $i,
                    'name' => $style->getName()
                ];
                $data[$i++] = $row;
            }
        }
        return new JSONresponse($data);
    }

    /**
     * @Route("/styles", name="styles")
     * 
     * @return void
     */
    public function index()
    {
        $types = $this->getDoctrine()->getRepository(Type::class)->findAll();

        return $this->render('Web/styles/index.html.twig', [
            'data' => $types,
        ]);
    }
}
