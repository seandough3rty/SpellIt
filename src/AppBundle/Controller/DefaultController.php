<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showHomeAction(Request $request)
    {
        $sets = $this->getAllSets();

        return $this->renderResponse('default/index.html.twig', array('sets' => $sets));
    }
}
