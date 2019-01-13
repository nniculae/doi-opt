<?php

namespace BlogBundle\Controller;
use BlogBundle\Form\Form1Type;
use BlogBundle\Form\Form2Type;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FormsController extends Controller
{
    /**
     * @Route("/form1")
     */
    public function form1Action()
    {
        $form = $this->createForm(Form1Type::class);
        return $this->render('BlogBundle:Forms:form1.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/form2")
     */
    public function form2Action()
    {
        $form = $this->createForm(Form2Type::class);
        return $this->render('BlogBundle:Forms:form2.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}