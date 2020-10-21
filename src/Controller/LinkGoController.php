<?php
namespace App\Controller;


use App\Repository\LinksRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class LinkGoController extends AbstractController
{
    /**
     * @Route("/go/{id}", name="go")
     * @param $id
     * @return RedirectResponse
     */

    private $linksRepository;

    public function __construct(LinksRepository $linksRepository)
    {
        $this->linksRepository = $linksRepository;
    }

    public function goLink($id)
    {
        $short_link = $this->linksRepository -> findOneBy(['short_link' => $id]);

        if (!$short_link) {

            $result_json = json_encode(['error' => 'Link not found by this id: '.$id]);
            return new Response(
                $result_json,
                Response::HTTP_NOT_FOUND,
                ['content-type' => 'application/json']
            );
        }

        return $this->redirect($short_link -> getLink());

    }
}