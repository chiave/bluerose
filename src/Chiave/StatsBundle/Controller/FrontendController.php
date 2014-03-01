<?php

namespace Chiave\StatsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class FrontendController extends Controller
{
    /**
     * @Route("/zbiorki")
     * @Template()
     */
    public function gatheringAction()
    {
        $em = $this->getDoctrine()->getManager();

        $militaryUnits = $em
            ->getRepository('ChiaveMilitaryUnitBundle:MilitaryUnit')
            ->findAll()
        ;

        return array(
            'militaryUnits' => $militaryUnits,
        );
    }
}
