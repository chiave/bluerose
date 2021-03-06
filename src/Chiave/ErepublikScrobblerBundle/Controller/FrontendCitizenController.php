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
 * @Route("/")
 */
class FrontendCitizenController extends Controller
{
    /**
     * Lists all citizens.
     *
     * @Route("/statystyki", name="chiave_scrobbler_citizens_frontend")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $citizens = $em
            ->getRepository('ChiaveErepublikScrobblerBundle:Citizen')
            ->findAll()
        ;

        return array(
            'citizens' => $citizens,
        );
    }

    // /**
    //  * @Route("/create", name="chiave_scrobbler_citizen_create")
    //  * @Method("POST")
    //  * @Security("has_role('ROLE_ADMIN')")
    //  * @Template("ChiaveErepublikScrobblerBundle:BackendCitizen:update.html.twig")
    //  */
    // public function createAction(Request $request)
    // {
    //     $citizen = new Citizen();

    //     $form = $this->createCitizenForm(
    //         $citizen,
    //         'chiave_scrobbler_citizen_create'
    //         );

    //     $form->handleRequest($request);

    //     if ($form->isValid()) {
    //         $em = $this->getDoctrine()->getManager();

    //         $citizen = $this
    //             ->get('erepublik_citizen_scrobbler')
    //             ->updateCitizen(
    //                 $citizen
    //             )
    //         ;

    //         // $em->persist($citizen);

    //         // $em->flush();

    //         return $this->redirect(
    //             $this->generateUrl('chiave_scrobbler_citizens')
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

    // /**
    //  * Edits an existing category.
    //  *
    //  * @Route("/{id}/update", name="chiave_gallery_categories_update")
    //  * @Method("POST")
    //  * @Security("has_role('ROLE_ADMIN')")
    //  * @Template()
    //  */
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
    //  * Deletes category.
    //  *
    //  * @Route("/{id}/delete", name="chiave_gallery_categories_delete")
    //  * @Method("POST")
    //  * @Security("has_role('ROLE_ADMIN')")
    //  */
    // public function deleteAction(Request $request, $id)
    // {
    //     $result = new \stdClass();
    //     $result->success = false;

    //     $em = $this->getDoctrine()->getManager();
    //     $category = $em->getRepository('ChiaveGalleryBundle:Categories')->find($id);

    //     if (!$category) {
    //         // throw $this->createNotFoundException('Unable to find Categories.');
    //         $result->error = 'Unable to find Categories.';
    //     } else {
    //         $em->remove($category);
    //         $em->flush();

    //         $result->success = true;
    //     }

    //     return new JsonResponse($result);
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
}
