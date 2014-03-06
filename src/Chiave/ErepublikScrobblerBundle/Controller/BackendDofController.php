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

use Chiave\ErepublikScrobblerBundle\Entity\CitizenHistory;
use Chiave\ErepublikScrobblerBundle\Form\DofType;

/**
 * BackendDofController.
 *
 * @Route("/admin/dof")
 * @Security("has_role('ROLE_ADMIN')")
 */
class BackendDofController extends Controller
{
    /**
     * Lists all citizens.
     *
     * @Route("s/", name="chiave_dofs")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getEm();

        //only undofed, and
        //  with influ and
        //  with egov influ and
        //  not from today and
        //  not from first day
        $citizens = $em
            ->getRepository('ChiaveErepublikScrobblerBundle:Citizen')
            ->findAll()
        ;

        return array(
            'citizens' => $citizens,
        );
    }

    /**
     * Change dof status.
     *
     * @Route("/{historyId}/change/{status}", name="chiave_dof_change")
     * @Method("POST")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function changeAction(Request $request, $historyId, $status)
    {
        $result = new \stdClass();
        $result->success = false;

        $em = $this->getEm();
        $history = $em
            ->getRepository('ChiaveErepublikScrobblerBundle:CitizenHistory')
            ->find($historyId);

        if (!$history) {
            // throw $this->createNotFoundException('Unable to find Categories.');
            $result->error = 'Unable to find Citizen.';
        } else {
            $history->setDof($status);
            $em->flush();

            $result->success = true;
            $result->dofStatus = $history->getDofText();
        }

        return new JsonResponse($result);
    }

    // /**
    //  * @Route("/create", name="chiave_scrobbler_citizen_create")
    //  * @Method("POST")
    //  * @Security("has_role('ROLE_ADMIN')")
    //  * @Template("ChiaveErepublikScrobblerBundle:BackendCitizen:update.html.twig")
    //  */
    // public function createAction(Request $request)
    // {
    //     $em = $this->getEm();

    //     $citizen = new Citizen();

    //     $form = $this->createCitizenForm(
    //         $citizen,
    //         'chiave_scrobbler_citizen_create'
    //         );

    //     $form->handleRequest($request);

    //     if ($form->isValid()) {

    //             $em->persist($citizen);
    //             $em->flush();

    //             $firstHistory = $this->container
    //                 ->get('erepublik_citizen_scrobbler')
    //             ->updateCitizenHistory($citizen);

    //             return $this->redirect(
    //                 $this->generateUrl('chiave_scrobbler_citizens')
    //         );
    //     }

    //     return array(
    //         'citizen' => $citizen,
    //         'form'   => $form->createView(),
    //     );
    // }

    // /**
    //  * @Route("/new", name="chiave_scrobbler_citizen_new")
    //  * @Method("GET")
    //  * @Security("has_role('ROLE_ADMIN')")
    //  * @Template("ChiaveErepublikScrobblerBundle:BackendCitizen:update.html.twig")
    //  */
    // public function newAction(Request $request)
    // {
    //     $citizen = new Citizen();

    //     $form = $this->createCitizenForm(
    //         $citizen,
    //         'chiave_scrobbler_citizen_create'
    //         );

    //     return array(
    //         'citizen' => $citizen,
    //         'form'   => $form->createView(),
    //     );
    // }

    // /**
    //  * Displays a form to edit an existing category.
    //  *
    //  * @Route("/{id}/edit", name="chiave_gallery_categories_edit")
    //  * @Method("GET")
    //  * @Security("has_role('ROLE_ADMIN')")
    //  * @Template("ChiaveGalleryBundle:BackendCategories:update.html.twig")
    //  */
    // public function editAction($id)
    // {
    //     $em = $this->getDoctrine()->getManager();

    //     $category = $em->getRepository('ChiaveGalleryBundle:Categories')->find($id);

    //     if (!$category) {
    //         throw $this->createNotFoundException('Unable to find Categories.');
    //     }

    //     $form = $this->createCategoryForm(
    //         $category,
    //         'chiave_gallery_categories_update'
    //         );

    //     return array(
    //         'category'      => $category,
    //         'form'   => $form->createView(),
    //     );
    // }

    // *
    //  * Edits an existing category.
    //  *
    //  * @Route("/{id}/update", name="chiave_gallery_categories_update")
    //  * @Method("POST")
    //  * @Security("has_role('ROLE_ADMIN')")
    //  * @Template()

    // public function updateAction(Request $request, $id)
    // {
    //     $em = $this->getDoctrine()->getManager();

    //     $category = $em->getRepository('ChiaveGalleryBundle:Categories')->find($id);

    //     if (!$category) {
    //         throw $this->createNotFoundException('Unable to find Categories.');
    //     }

    //     $form = $this->createCategoryForm(
    //         $category,
    //         'chiave_gallery_categories_update'
    //         );
    //     $form->handleRequest($request);

    //     if ($form->isValid()) {
    //         $em->flush();

    //         return $this->redirect($this->generateUrl('chiave_gallery_categories_edit', array('id' => $id)));
    //     }

    //     return array(
    //         'category' => $category,
    //         'form'   => $form->createView(),
    //     );
    // }

    // /**
    // * Creates a form for citizen.
    // *
    // * @param User $citizen
    // * @param string $route
    // *
    // * @return \Symfony\Component\Form\Form Form for citizen
    // */
    // public function createCitizenForm(Citizen $citizen, $route)
    // {
    //     return $this->createForm(
    //         new CitizenType(),
    //         $citizen,
    //         array(
    //             'action' => $this->generateUrl(
    //                 $route,
    //                 array(
    //                     'id' => $citizen->getId(),
    //                 )),
    //             'method' => 'post',
    //         )
    //     );
    // }

    private function getEm()
    {
        return $this->getDoctrine()->getEntityManager();
    }
}
