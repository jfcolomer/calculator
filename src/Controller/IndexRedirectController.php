<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class IndexRedirectController extends AbstractController
{
    /**
     * @Route("/", name="index_redirect")
     */
    public function index()
    {
        return new RedirectResponse($this->generateUrl('calculator'), '302');
    }
}
