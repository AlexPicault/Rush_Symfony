<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\searchProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class searchController extends Controller
{
    /**
     *
     *
     * @Route("/search", name="search")
     * @Method({"GET", "POST"})
     */
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('AppBundle:product')->findAll();
        $form = $this->createForm(searchProductType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
//            $product = $form["name"]->getData();
//            $maxPrice = $form["immediatePrice"]->getData();
//            $minPrice = $form["price"]->getData();

            $name = "";
            $maxPrice = "";
            $minPrice = "";
            $category_id = 2;
            $this->getSearchAll($name, $category_id, $maxPrice, $minPrice);
        }

        return $this->render('search/search.html.twig', array(
            'products' => $products,
            'form' => $form->createView()
        ));
    }

    public function getSearchAll($name, $category_id, $maxPrice, $minPrice)
    {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('AppBundle:product')->searchAll($name, $category_id, $maxPrice, $minPrice);

    }

}
