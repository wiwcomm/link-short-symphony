<?php
namespace App\Controller;


use App\Repository\LinksRepository;
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
            throw $this->createNotFoundException(
                'Link not found by this id: '.$id
            );
        }

        return $this->redirect($short_link -> getLink());

    }
}