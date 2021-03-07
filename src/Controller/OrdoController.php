<?php

namespace App\Controller;

use App\Entity\Medicament;
use App\Entity\Ordonnance;
use App\Form\OrdonnanceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class OrdoController extends AbstractController
{

    /*public function index(): Response
    {

        return $this->render('ordo/index.html.twig', [
            'controller_name' => 'OrdoController',
        ]);
    }*/

    /**
     * @Route("/Supprimer/{id}", name="Supprimer")
     */

    public function remove($id)
    {         $em = $this->getDoctrine()->getManager();

        $ord = $this->getDoctrine()->getRepository(Ordonnance::class)->find($id);
        $em->remove($ord);
        $em->flush();
        return $this->redirectToRoute('ShowOrdo');

    }


    /**
     * @Route("/ShowOrdo", name="ShowOrdo")
     */
    public function ListOrdonnances()
    {
        $ord = $this->getDoctrine()->getRepository(Ordonnance::class)->findAll();
        return $this->render("ordo/ShowOrdo.html.twig", array("ord" => $ord));

    }

    /**
     * @Route("/AddOrdo", name="AddOrdo")
     */
    public function AddOrdonnance(Request $request)
    {
        $medics= $this->getDoctrine()->getManager()->getRepository(Medicament::class)->findAllMed();
        $array = [];
        foreach ($medics as $med) {
            if (!empty($med->getNom())) {
                $array[$med->getNom()] = $med->getNom();
            }
        }
        $ord = new Ordonnance();
        $form = $this->createForm(OrdonnanceType::class, $ord)
            ->add('Medicament',ChoiceType::class,array(
                'attr'  =>  array('class' => 'form-control',
                    'style' => 'margin:5px 0;'),
                'choices' =>$array,
                'multiple' =>false,
                'required' => true,
            ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $medica = $form['Medicament']->getData();
            foreach ((array) $medica as $medic) {
                $us1 = $em->getRepository(Medicament::class)->findEntitiesByString($medic);
                foreach ($us1 as $us1) {
                    $ord->setMedicament($us1);
                }
            }
            $em->persist($ord);
            $em->flush();
            return $this->redirectToRoute("ShowOrdo");
        }
        return $this->render('ordo/AddOrdonnance.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/edit/{id}", name="edit")
     */

    function Update(Ordonnance $ordo, Request $request)
    {
        $form = $this->createForm(OrdonnanceType::class, $ordo);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Ordennance editée avec succes ');

            return $this->redirectToRoute('edit', array('id' => $ordo->getId()));

        }
        return $this->render('ordo/UpdateOrdo.html.twig', array(
            'ord' => $ordo,
            'form' => $form->createView()));
    }



}
