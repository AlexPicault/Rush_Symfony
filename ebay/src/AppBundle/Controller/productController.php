<?php

namespace AppBundle\Controller;

use AppBundle\Entity\product;
use AppBundle\Form\searchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Algolia\SearchBundle\IndexManagerInterface;
use AppBundle\Form\searchCategoryType;
/**
 * Product controller.
 *
 * @Route("product")
 */
class productController extends Controller
{

    /**
     * Lists all product entities.
     *
     * @Route("/", name="product_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository('AppBundle:product')->findAll();
        $formSearchCategory = $this->createForm(searchCategoryType::class);
        $formSearch = $this->createForm(searchType::class);
        $formSearch->handleRequest($request);
        $formSearchCategory->handleRequest($request);

        if($formSearch->isSubmitted()) {
            $findname = $request->request->get("search")["name"];
            $results = $this->getSearch($findname);
            return $this->render('product/index.html.twig', array(
                'results' => $results,
                'form' => $formSearch->createView(),
                'formCategory' => $formSearchCategory->createView(),
            ));
        }
                if($formSearchCategory->isSubmitted())
                {
                   $findcategory = $request->request->get("searchCategory")["category"];
                   $results = $this->getSearchCategory($findcategory);
                    return $this->render('product/index.html.twig', array(
                        'results' => $results,
                        'form' => $formSearch->createView(),
                        'formCategory' => $formSearchCategory->createView(),
                    ));
        }else {
            return $this->render('product/index.html.twig', array(
                'products' => $products,
                'form' => $formSearch->createView(),
                'formCategory' => $formSearchCategory->createView(),
            ));
        }
    }

    protected $indexManager;

    public function __construct(IndexManagerInterface $indexingManager)
    {
        $this->indexManager = $indexingManager;
    }

    /**
     * Lists all product entities.
     *
     * @Route("/my")
     * @Method("GET")
     */
    public function myIndexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository('AppBundle:product')->findAll();

        return $this->render('product/myIndex.html.twig', array(
            'products' => $products,
        ));
    }

    /**
     * Lists all product entities.
     *
     * @Route("/mybid", name="mybid")
     * @Method("GET")
     */
    public function myBidIndexAction()
    {
        $tabs=[];
        $bids = $this->getBid(1);

        foreach ($bids  as $key => $bid) {
            $product = $this->getProductById($bid["product_id"]);
            $tabs[$key] = array($bid, $product);
        }


        return $this->render('product/myBidIndex.html.twig', array(
            'tabs'=> $tabs
        ));
    }

    /**
     * Creates a new product entity.
     *
     * @Route("/new", name="product_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $product = new Product();
        $form = $this->createForm('AppBundle\Form\productType', $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $product->setUser($this->getUser());
            $product->setSell(false);
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('product_show', array('id' => $product->getId()));
        }

        return $this->render('product/new.html.twig', array(
            'product' => $product,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a product entity.
     *
     * @Route("/{id}", name="product_show")
     * @Method("GET")
     */
    public function showAction(product $product)
    {
        $deleteForm = $this->createDeleteForm($product);
        $product->setProductVisits($product->getProductVisits()+ 1);
        $this->getDoctrine()->getManager()->flush();

        return $this->render('product/show.html.twig', array(
            'product' => $product,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing product entity.
     *
     * @Route("/{id}/edit", name="product_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, product $product)
    {
        $deleteForm = $this->createDeleteForm($product);
        $editForm = $this->createForm('AppBundle\Form\productType', $product);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_edit', array('id' => $product->getId()));
        }

        return $this->render('product/edit.html.twig', array(
            'product' => $product,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a product entity.
     *
     * @Route("/{id}", name="product_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, product $product)
    {
        $form = $this->createDeleteForm($product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($product);
            $em->flush();
        }

        return $this->redirectToRoute('product_index');
    }

    /**
     * Creates a form to delete a product entity.
     *
     * @param product $product The product entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(product $product)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('product_delete', array('id' => $product->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function getSearch($name)
    {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('AppBundle:product')->search($name);

    }

    public function getSearchCategory($category)
    {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('AppBundle:product')->searchCategory($category);

    }

    private function getBid($user_id)
    {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('AppBundle:bidding')->findBid($user_id);
    }

    private function getProductById($id)
    {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('AppBundle:product')->find($id);
    }
}
