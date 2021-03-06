<?php

namespace Chiave\ErepublikScrobblerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Chiave\ErepublikScrobblerBundle\Entity\Citizen;
use Chiave\ErepublikScrobblerBundle\Form\CitizenType;

/**
 * Citizen controller.
 *
 * @Route("/admin/citizens/histories")
 * @Security("has_role('ROLE_ADMIN')")
 */
class BackendCitizenHistoryController extends Controller
{
    /**
     * Show all citizen changes.
     *
     * @Route("/{citizenId}", name="chiave_scrobbler_citizens_histories")
     * @Method("GET")
     * @Template()
     */
    public function showAction($citizenId)
    {
        $em = $this->getDoctrine()->getManager();

        $citizen = $em
            ->getRepository('ChiaveErepublikScrobblerBundle:Citizen')
            ->find($citizenId)
        ;
        // $histories = $em
        //     ->getRepository('ChiaveErepublikScrobblerBundle:CitizenHistory')
        //     ->findByCitizen($citizenId)
        // ;

        return array(
            'citizen' => $citizen,
            // 'histories' => $histories,
        );
    }
}
