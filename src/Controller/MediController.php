<?php

namespace App\Controller;
use App\Entity\Medicament;
use App\Form\MedicamentType;
use App\Repository\MedicamentRepository;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class MediController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        $med=$this->getDoctrine()->getRepository(Medicament::class)->findAllMed();
        //instance bundle chart
        $ob1 = new Highchart();
        //ne5tarou el type mta3 el chart piechart hoya type doura
        $ob1->chart->renderTo('piechart');
        $ob1->title->text('MEDICAMENT PAR STOCK');
        $ob1->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',

            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));
        $data = null;
        foreach($med as $value)
        {
            $data[] = array(
                '' .$value->getNom(), (int)$value->getStock(),
            );
        }

        $ob1->series(array(array('type' => 'pie', 'name' => 'Browser share', 'data' => $data)));

        return $this->render('medi/index.html.twig', [
            'controller_name' => 'MediController','piechart'=>$ob1
        ]);
    }


    /**
     * @Route("/remove/{id}", name="remove_medicament")
     */

    public function remove($id)
    {         $em = $this->getDoctrine()->getManager();

        $med = $this->getDoctrine()->getRepository(Medicament::class)->find($id);
        $em->remove($med);
        $em->flush();
        return $this->redirectToRoute('ShowMedic');

    }


    /**
     * @Route("/ShowMedic", name="ShowMedic")
     */
    public function ShowMedicament()
    {
        $med = $this->getDoctrine()->getRepository(Medicament::class)->findAll();
        return $this->render("medi/ShowMedic.html.twig", array("medic" => $med));

    }

    /**
     * @Route("/Medicament/new", name="AddMedicament")
     */
    public function AddMedicament(Request $request)
    {
        $med = new Medicament();
        $form = $this->createForm(MedicamentType::class, $med);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($med);
            $em->flush();
            return $this->redirectToRoute("ShowMedic");
        }
        return $this->render('medi/AddMedicament.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/editmed/{id}", name="editmed")
     */

    function Update(Medicament $medicament, Request $request)
    {
        $form = $this->createForm(MedicamentType::class, $medicament);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'medicament edit avec succes ');

            return $this->redirectToRoute('editmed', array('id' => $medicament->getId()));


        }
        return $this->render('medi/edit.html.twig', array(
            'medicament' => $medicament,
            'form' => $form->createView()));
    }





}
