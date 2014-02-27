<?php

namespace Chiave\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class BackendController extends Controller
{
    /**
     * dashboard Action
     *
     * @Route("/admin", name="admin_dashboard")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function dashboardAction()
    {
        // RAW DATA FOR USER
        // $this->container
        //     ->get('erepublik_citizen_scrobbler')
        //     ->showRawData(4241769)
        // ;

        // NEW FIELD UPDATER SNIPPET
        $em = $this->getDoctrine()->getManager();

        $citizens = $em
            ->getRepository('ChiaveErepublikScrobblerBundle:Citizen')
            ->findAll()
        ;

        foreach ($citizens as $citizen) {
            $citizen->setRankPoints($citizen->getRankPoints());
        }

        $em->flush();

        // // TESTING
        // // FIELDNAMES FOR CLASS

        // var_dump(
        //      $this->container
        //         ->get('doctrine.orm.entity_manager')
        //         ->getClassMetadata('Chiave\ErepublikScrobblerBundle\Entity\Citizen')
        //         ->getFieldNames()
        // );

        return $this->render(
            'ChiaveCoreBundle:Backend:dashboard.html.twig'
        );
    }
}
