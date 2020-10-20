<?php
namespace App\Controller;

use App\Entity\Product;
use App\Entity\Links;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LinkGoController extends AbstractController
{
    /**
     * @Route("/go/{id}")
     * @param $id
     * @return RedirectResponse
     */

    public function goLink($id)
    {

        $repository = $this -> getDoctrine()->getRepository(Links::class);


        $short_link = $repository -> findOneBy(['short_link' => $id]);

        if (!$short_link) {
            throw $this->createNotFoundException(
                'Link not found by this id: '.$id
            );
        }

        return $this->redirect($short_link -> getLink());

    }
}