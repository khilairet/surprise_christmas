<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('CoreBundle:User')->findAll();
        return $this->render('CoreBundle:Homepage:index.html.twig', array(
            'users' => $users
        ));
    }

    public function giftToAction(){
        $santa = $this->getUser();
        if($santa){
            $em = $this->getDoctrine()->getManager();
            $users = $em->getRepository('CoreBundle:User')->getUsersByNotGiftToFilterNotMe($santa);

            $giftTo = rand(0, count($users) - 1);
            $users[$giftTo]->setSanta($santa);
            $em->flush();
        }

        return $this->redirectToRoute('core_homepage');

    }
}
