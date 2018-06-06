<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\BrowserKit\Request;

class userController extends Controller
{

    /**
     * Lists all category entities.
     *
     * @Route("/users", name="user_index")
     * @Method("GET")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('user/index.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * Finds and displays a category entity.
     *
     * @Route("/user/{user}", name="user_show")
     * @Method("GET")
     */
    public function showAction(User $user)
    {
            $em = $this->getDoctrine()->getManager();
            $rates = $em->getRepository('AppBundle:rate')->findBy(['user' => $user->getId()]);
            $user->setUserVisits($user->getUserVisits() + 1);
            $result = $this->avarageRate($user->getId());
            $user->setAverageRate($result["AVG(rate_user)"]);
            $this->getDoctrine()->getManager()->flush();

        return $this->render('user/show.html.twig', array(
                'user' => $user,
                'rates' => $rates
            ));
    }

    private function avarageRate($user_id)
    {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('AppBundle:User')->average($user_id);

    }
}
