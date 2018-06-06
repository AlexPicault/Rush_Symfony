<?php

namespace AppBundle\Controller;

use AppBundle\Entity\rate;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Rate controller.
 *
 * @Route("rate")
 */
class rateController extends Controller
{
    /**
     * Lists all rate entities.
     *
     * @Route("/", name="rate_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $rates = $em->getRepository('AppBundle:rate')->findAll();
        $users = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('rate/index.html.twig', array(
            'rates' => $rates,
            'users' => $users
        ));
    }

    /**
     * Creates a new rate entity.
     *
     * @Route("/new/{id}", name="rate_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $rate = new Rate();
        $form = $this->createForm('AppBundle\Form\rateType', $rate);
        $form->handleRequest($request);
        $id = $request->attributes->get('id');
        $product = $this->getProductById($id);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $rate->setProduct($product);
            $rate->setUser($product->getUser());
            $em->persist($rate);
            $em->flush();

            return $this->redirectToRoute('rate_show', array('id' => $rate->getId()));
        }

        return $this->render('rate/new.html.twig', array(
            'rate' => $rate,
            'form' => $form->createView(),
            'product'=>$product
        ));
    }

    /**
     * Finds and displays a rate entity.
     *
     * @Route("/{id}", name="rate_show")
     * @Method("GET")
     */
    public function showAction(rate $rate)
    {
        $deleteForm = $this->createDeleteForm($rate);

        return $this->render('rate/show.html.twig', array(
            'rate' => $rate,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing rate entity.
     *
     * @Route("/{id}/edit", name="rate_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, rate $rate)
    {
        $deleteForm = $this->createDeleteForm($rate);
        $editForm = $this->createForm('AppBundle\Form\rateType', $rate);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rate_edit', array('id' => $rate->getId()));
        }

        return $this->render('rate/edit.html.twig', array(
            'rate' => $rate,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a rate entity.
     *
     * @Route("/{id}", name="rate_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, rate $rate)
    {
        $form = $this->createDeleteForm($rate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($rate);
            $em->flush();
        }

        return $this->redirectToRoute('rate_index');
    }

    /**
     * Creates a form to delete a rate entity.
     *
     * @param rate $rate The rate entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(rate $rate)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('rate_delete', array('id' => $rate->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    private function getProductByID($id)
    {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('AppBundle:product')->find($id);
    }
}
