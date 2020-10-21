<?php
namespace App\Controller;

use App\Entity\Links;
use App\Entity\Input;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\UrlGeneratorService;
use App\Service\CheckLinkUnique;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class LinkShortController extends AbstractController
{
    /**
     * @Route("/short", name="short")
     * @param Request $request
     * @param UrlGeneratorService $urlGenerator
     * @return Response
     */

    public function shortLink(Request $request, UrlGeneratorService $urlGenerator, CheckLinkUnique $checkLinkUnique, ValidatorInterface $validator)
    {

        $parametersAsArray = [];
        if ($content = $request->getContent()) {
            $parametersAsArray = json_decode($content, true);
        }

        $json = new Input();
        $json -> setJson($content);

        $errors = $validator->validate($json);
        if (count($errors) > 0) {
            $result_json = json_encode(['error' => 'You\'ve entered an invalid Json.']);
            return new Response(
                $result_json,
                Response::HTTP_BAD_REQUEST,
                ['content-type' => 'application/json']
            );
        }

        $input_link = $parametersAsArray['link'];
        $checkLink = $checkLinkUnique -> checkLink($input_link);

        if ($checkLink) {
            $generated_link_uid = $checkLink;
        } else {
            $generated_link_uid = $urlGenerator->getRandomUrl();
            $link = new Links();
            $link -> setLink($input_link);
            $link -> setShortLink($generated_link_uid);
            $errors = $validator->validate($link);

            if (count($errors) > 0) {
                $result_json = json_encode(['error' => 'This value is not a valid URL.']);
                return new Response(
                    $result_json,
                    Response::HTTP_BAD_REQUEST,
                    ['content-type' => 'application/json']
                );
                return new Response($errorsString);
            }

            $entityManager = $this -> getDoctrine() -> getManager();
            $entityManager -> persist($link);
            $entityManager -> flush();
        }

        $result_link = $this->generateUrl('link_go', ['id' => $generated_link_uid], UrlGeneratorInterface::ABSOLUTE_URL);
        $result_json = json_encode(['short_url' => $result_link]);

        return new Response(
            $result_json,
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }
}