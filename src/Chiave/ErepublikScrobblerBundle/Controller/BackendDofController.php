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
     * @Template()
     */
    public function indexAction(Request $request)
    {

        $timeMaster = $this->container->get('date_time');

        $todayDay = $timeMaster->getErepublikDate(1);

        $post = $request->request->get('form');

        isset($post['startDay']) && $post['startDay'] != null ?
            $data['startDay'] = $post['startDay'] :
            $data['startDay'] = $todayDay
        ;
        isset($post['endDay']) && $post['endDay'] != null ?
            $data['endDay'] = $post['endDay'] :
            $data['endDay'] = $todayDay
        ;
        isset($post['div']) && $post['div'] != null ?
            $data['div'] = $post['div'] :
            $data['div'] = null
        ;
        isset($post['status']) && $post['status'] != null ?
            $data['status'] = $post['status'] :
            $data['status'] = ''
        ;

        $searchForm = $this->createSearchForm($data);

        $startDate = $timeMaster->getDateByDay($data['startDay']);
        $endDate = $timeMaster->getDateByDay($data['endDay'])->modify('+1 day');

        $query = $this->getEm()
            ->getRepository('ChiaveErepublikScrobblerBundle:CitizenHistory')
            ->createQueryBuilder('ch')

            ->where('ch.createdAt >= :startDate')
            ->andWhere('ch.createdAt < :endDate')
                ->setParameter('startDate', $startDate)
                ->setParameter('endDate', $endDate);

            if ($data['div'] != null) {
                $query->andWhere('ch.division = :div')
                    ->setParameter('div', $data['div']);
            }
            if ($data['status'] !== '') {
                $query->andWhere('ch.dof = :status')
                    ->setParameter('status', $data['status']);
            }

            $query->andWhere('ch.egovHits != 0')
                ->orderBy('ch.nick', 'ASC')
            ;

        $histories = $query->getQuery()->getResult();

        return array(
            'searchForm'    => $searchForm->createView(),
            'histories' => $histories,
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


    /**
    * Creates a form for dof picking.
    *
    * @return \Symfony\Component\Form\Form Form
    */
    public function createSearchForm($data)
    {
        return $this->createFormBuilder(null, array('csrf_protection' => false))
            ->add('startDay', 'integer', array(
                'precision' => 0,
                'data'      => $data['startDay'],
                'required'  => false,
            ))
            ->add('endDay', 'integer', array(
                'precision' => 0,
                'data'      => $data['endDay'],
                'required'  => false,
            ))
            ->add('div', 'choice', array(
                'choices'   => array(
                    '' => 'Wszystkie',
                    '1' => 'I',
                    '2' => 'II',
                    '3' => 'III',
                    '4' => 'IV',
                ),
                'data'      => $data['div'],
                'required'  => false,
            ))
            ->add('status', 'choice', array(
                'choices'   => array(
                        '0'     => 'niewydane',
                        '1'     => 'wydane',
                        '-1'    => 'pominięte',
                        ''      => 'wszystkie',
                ),
                'data'      => $data['status'],
                'required'  => false,
            ))
            // ->add('div', 'integer', array(
                // 'precision' => 0,
                // 'data'      => $data['div'],
                // // 'mapped'    => false,
                // 'required'  => false,
            // ))
            ->add('send', 'submit')
            ->getForm();
    }

    private function getEm()
    {
        return $this->getDoctrine()->getEntityManager();
    }
}
