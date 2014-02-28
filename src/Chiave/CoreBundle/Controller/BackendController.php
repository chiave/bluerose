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
        $em = $this->getDoctrine()->getManager();

        // // // RAW DATA FOR USER
        // $citizen = $em
        //     ->getRepository('Chiave\ErepublikScrobblerBundle\Entity\Citizen')
        //     ->findOneByCitizenId(4241769)
        // ;
        // $this->container
        //     ->get('erepublik_citizen_scrobbler')
        //     ->updateCitizen($citizen)
        // ;

        //2494465 - djstrach
        //4241769 - aplhanumerix

        // // NEW FIELD UPDATER SNIPPET

        // $citizens = $em
        //     ->getRepository('ChiaveErepublikScrobblerBundle:Citizen')
        //     ->findAll()
        // ;

        // foreach ($citizens as $citizen) {
        //     $changes = $citizen->getChanges();

        //     foreach ($changes as $change) {
        //         if ($change->getValue() == '') {
        //             $em->remove($change);
        //         }
        //     }
        //     // $citizen->setRankPoints($citizen->getRankPoints());
        // }

        // $em->flush();

        // TESTING
        // FIELDNAMES FOR CLASS

        var_dump(
             $this->container
                ->get('doctrine.orm.entity_manager')
                ->getClassMetadata('Chiave\ErepublikScrobblerBundle\Entity\Citizen')
                ->getFieldNames()
        );


        // // DATETIME PLAYGROUND

        // todays day change
        // $lastDayChange = new \DateTime('now');
        // $lastDayChange->modify('+8 hours');

        // if($lastDayChange->format('G') < 9) {
        //     $lastDayChange->modify('-1 day');
        // }

        // $lastDayChange->setTime(9, 0);

        // return $lastDayChange;

        // die;

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
