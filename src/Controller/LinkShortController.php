<?php
namespace App\Controller;

use App\Entity\Links;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class LinkShortController extends AbstractController
{
    /**
     * @Route("/short")
     * @param Request $request
     * @return Response
     */

    public function shortLink(Request $request)
    {

        $parametersAsArray = [];
        if ($content = $request->getContent()) {
            $parametersAsArray = json_decode($content, true);
        }

        $input_link = $parametersAsArray['link'];

        $generated_link_uid = bin2hex(openssl_random_pseudo_bytes(10));

        $result_link = 'http://' . $_SERVER['HTTP_HOST'] . '/go/' . $generated_link_uid;

        $entityManager = $this -> getDoctrine() -> getManager();

        $link = new Links();
        $link -> setLink($input_link);
        $link -> setShortLink($generated_link_uid);

        $entityManager -> persist($link);

        $entityManager -> flush();

        $result_json = json_encode(['short_url' => $result_link]);
        return new Response(
            $result_json,
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }
}