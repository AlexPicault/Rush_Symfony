<?php

namespace AppBundle\Controller;

use AppBundle\Entity\bidding;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * Bidding controller.
 *
 * @Route("bidding")
 */
class biddingController extends Controller
{
    /**
     * Lists all bidding entities.
     *
     * @Route("/", name="bidding_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $biddings = $em->getRepository('AppBundle:bidding')->findAll();

        return $this->render('bidding/index.html.twig', array(
            'biddings' => $biddings,
        ));
    }


    /**
     * Creates a new bidding entity.
     *
     * @Route("/new/{id}", name="bidding_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {

        $maxBid = $this->getMaxBid($request->query->get('id'));

        $bidding = new Bidding();
        $form = $this->createForm('AppBundle\Form\biddingType', $bidding);
        $form->handleRequest($request);
        $product = $this->getProductById($request->attributes->get('id'));

        if ($bidding->getBid() >= $product->getImmediatePrice()) {
            $product->setSell(true);
            $em = $this->getDoctrine()->getManager();
            $bidding->setUser($this->getUser());
            $bidding->setProduct($product);
            $em->persist($bidding);
            $em->flush();
            $bid = $bidding->getId();
            $prod = $product->getId();
            return $this->redirectToRoute('sell', array('id' => $bid, 'id_product'=>$prod));
        }

        if ($maxBid != null) {
            if ($form->isSubmitted() && $form->isValid() && $bidding->getBid() >= ($product->getPrice() + 2) || $bidding->getBid() >= ($maxBid[0]["bid"] + 2)) {
                $em = $this->getDoctrine()->getManager();
                $bidding->setUser($this->getUser());
                $bidding->setProduct($product);
                $em->persist($bidding);
                $em->flush();
                return $this->redirectToRoute('bidding_show', array('id' => $bidding->getId(), 'id_product' =>
                    $product->getId()));
            }
            return $this->render('bidding/new.html.twig', array(
                'bidding' => $bidding,
                'form' => $form->createView(),
                'product' => $product,
                'maxBid' => $maxBid[0]["bid"],
            ));
        } else {

            if ($form->isSubmitted() && $form->isValid() && $bidding->getBid() >= ($product->getPrice() + 2)) {
                $em = $this->getDoctrine()->getManager();
                $bidding->setUser($this->getUser());
                $bidding->setProduct($product);
                $em->persist($bidding);
                $em->flush();
                return $this->redirectToRoute('bidding_show', array('id' => $bidding->getId(), 'id_product' =>
                    $product->getId()));
            }
            return $this->render('bidding/new.html.twig', array(
                'bidding' => $bidding,
                'form' => $form->createView(),
                'product' => $product,
                'maxBid' => 'no',
            ));
        }
    }
            /**
             * Finds and displays a bidding entity.
             *
             * @Route("/{id}/{id_product}", name="bidding_show")
             * @Method("GET")
             */
            public function showAction(Request $request, bidding $bidding)
            {
                $deleteForm = $this->createDeleteForm($bidding);
                $product = $this->getProductById('id_product');

                return $this->render('bidding/show.html.twig', array(
                    'bidding' => $bidding,
                    'delete_form' => $deleteForm->createView(),
                    'product'=>$product
                ));
            }

    /**
     * Finds and displays a bidding entity.
     *
     * @Route("/{id}/sell/", name="sell")
     * @Method("GET")
     */
    public function sell(Request $request, bidding $bidding)
    {
        $deleteForm = $this->createDeleteForm($bidding);
        $product = $this->getProductById($request->query->get('id_product'));

        return $this->render('bidding/sell.html.twig', array(
            'bidding' => $bidding,
            'delete_form' => $deleteForm->createView(),
            'product'=>$product
        ));
    }

            /**
             * Displays a form to edit an existing bidding entity.
             *
             * @Route("/{id}/edit", name="bidding_edit")
             * @Method({"GET", "POST"})
             */
            public function editAction(Request $request, bidding $bidding)
            {
                $deleteForm = $this->createDeleteForm($bidding);
                $editForm = $this->createForm('AppBundle\Form\biddingType', $bidding);
                $editForm->handleRequest($request);

                if ($editForm->isSubmitted() && $editForm->isValid()) {
                    $this->getDoctrine()->getManager()->flush();

                    return $this->redirectToRoute('bidding_edit', array('id' => $bidding->getId()));
                }

                return $this->render('bidding/edit.html.twig', array(
                    'bidding' => $bidding,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                ));
            }

            /**
             * Deletes a bidding entity.
             *
             * @Route("/{id}", name="bidding_delete")
             * @Method("DELETE")
             */
            public function deleteAction(Request $request, bidding $bidding)
            {
                $form = $this->createDeleteForm($bidding);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $em->remove($bidding);
                    $em->flush();
                }

                return $this->redirectToRoute('bidding_index');
            }

            /**
             * Creates a form to delete a bidding entity.
             *
             * @param bidding $bidding The bidding entity
             *
             * @return \Symfony\Component\Form\Form The form
             */
            private function createDeleteForm(bidding $bidding)
            {
                return $this->createFormBuilder()
                    ->setAction($this->generateUrl('bidding_delete', array('id' => $bidding->getId())))
                    ->setMethod('DELETE')
                    ->getForm();
            }

            private function getProductByID($id)
            {
                $em = $this->getDoctrine()->getManager();
                return $em->getRepository('AppBundle:product')->find($id);
            }

            public function getMaxBid($id)
            {
                $em = $this->getDoctrine()->getManager();
                return $em->getRepository('AppBundle:bidding')->maxBid($id);

            }
        }
