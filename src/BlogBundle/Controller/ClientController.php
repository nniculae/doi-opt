<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Client;
use BlogBundle\Form\ClientType;
use Doctrine\Common\Collections\Criteria;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientController extends Controller
{
    /**
     * @Route("/show-by-date-range")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showByDateRangeAction(Request $request): Response
    {
        $form = $this->createForm(ClientType::class);
        $form->add('save', SubmitType::class, ['label' => 'Select Range']);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $dates = $form->getData();
            $createdAt = $dates['createdAt'];
            $expiresAt = $dates['expiresAt'];
            $clients = $this->getDoctrine()
                ->getRepository(Client::class)
                ->findByDateRange($createdAt, $expiresAt);
            if (!empty($clients)) {
                return $this->render('BlogBundle:Client:show_by_date_range.html.twig', array(
                    'form' => $form->createView(),
                    'clients' => $clients,
                ));
            }
        }
        return $this->render('BlogBundle:Client:show_by_date_range_form.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("show-all-clients")
     */
    public function showAction()
    {
        $repo = $this->getDoctrine()->getRepository(Client::class);
        $collection = $repo->findVitaOrRogers();
        $filtered = $collection->filter(function ($client) {
            return ($client->getFirstName() !== 'Vita');
        });

        $expr = Criteria::expr();
        $criteria = Criteria::create();

        $criteria->where($expr->eq('firstName', 'Jordan'));

        $matched = $filtered->matching($criteria); // Jordan



        return $this->render('BlogBundle:Client:show_all_teste.html.twig', [
            'clients' => $matched,
        ]);
    }
}
