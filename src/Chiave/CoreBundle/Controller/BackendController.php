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
        return $this->render(
            'ChiaveCoreBundle:Backend:dashboard.html.twig'
        );
    }
}
