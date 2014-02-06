<?php

namespace Chiave\ErepublikScrobblerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\DependencyInjection\ContainerAware;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }
    /**
     * @Route("/test/{id}")
     * @Template()
     */
    public function testAction($id)
    {
        $this->get('erepublik_citizen_scrobbler')->getAllData($id);
        die;

        return array();
    }
}
