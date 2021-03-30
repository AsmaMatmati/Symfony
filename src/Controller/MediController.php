<?php

namespace App\Controller;
use App\Entity\Medicament;
use App\Entity\Ordonnance;
use App\Form\MedicamentType;
use App\Form\RechercheMedType;
use App\Form\RechercheType;
use App\Repository\MedicamentRepository;
use Ob\HighchartsBundle\Highcharts\Highchart;
use phpDocumentor\Reflection\Types\Integer;
use PhpParser\Node\Expr\Cast\Double;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;


class MediController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        $i=0;$j=0;
        $med=$this->getDoctrine()->getRepository(Medicament::class)->findAll();
        $ord=$this->getDoctrine()->getRepository(Ordonnance::class)->findAll();
        $em = $this->getDoctrine()->getManager(); //on appelle Doctrine
        $query = $em->createQuery( //creation de la requête
            'SELECT sum(m.stock)
             FROM App\Entity\Medicament m'
        );

        $somme = $query->getResult();
        foreach($somme as $s)
        {
            //var_dump($s);
        }
        foreach($med as $v)
        {
            $i++;
        }
        foreach($ord as $vv)
        {
            $j++;
        }
        //instance bundle chart
        $ob1 = new Highchart();
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
                '' .$value->getName(), (int)$value->getStock(),
            );
        }
        $dat[]=null;

        $ob1->series(array(array('type' => 'pie', 'name' => 'Stock', 'data' => $data)));

        return $this->render('medi/index.html.twig', [
            'controller_name' => 'MediController','piechart'=>$ob1,'nb'=>$i,'nb1'=>$j,"somme"=>$s
        ]);
    }


    /**
     * @Route("/remove/{id}", name="remove_medicament")
     */

    public function remove($id)
    {
        $em = $this->getDoctrine()->getManager();
        $med = $this->getDoctrine()->getRepository(Medicament::class)->find($id);
        $em->remove($med);
        $em->flush();
        $this->addFlash(
            'infos',
            'Médicament Supprimé avec succés!');


        return $this->redirectToRoute('ShowMedic');

    }


    /**
     * @Route ("/ListMedicByNameASC", name="ListMedicByNameASC")
     */
    public function ListMedicByNameASC(MedicamentRepository  $repository, Request $request)
    {
        $medic=$this->getDoctrine()->getRepository(Medicament::class )->ListMedicByNameASC();
       $form=$this->createForm(RechercheMedType::class);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $name=$form->getData()->getName();


            $medicResult=$this->getDoctrine()->getRepository(Medicament::class )->recherche($name);
            return $this->render("medi/ShowMedic.html.twig",array('medic'=>$medicResult,'form'=>$form->createView()));

        }
        return $this->render("medi/ShowMedic.html.twig",array('medic'=>$medic,'form'=>$form->createView()));


    }


    /**
     * @Route ("/ListMedicByNameDESC", name="ListMedicByNameDESC")
     */
    public function ListMedicByNameDESC(MedicamentRepository  $repository, Request $request)
    {
        $medic=$this->getDoctrine()->getRepository(Medicament::class )->ListMedicByNameDESC();
        $form=$this->createForm(RechercheMedType::class);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $name=$form->getData()->getName();


            $medicResult=$this->getDoctrine()->getRepository(Medicament::class )->recherche($name);
            return $this->render("medi/ShowMedic.html.twig",array('medic'=>$medicResult,'form'=>$form->createView()));

        }
        return $this->render("medi/ShowMedic.html.twig",array('medic'=>$medic,'form'=>$form->createView()));


    }

    /**
     * @Route ("/ListMedicByPriceASC", name="ListMedicByPriceASC")
     */
    public function ListMedicByPriceASC(MedicamentRepository  $repository, Request $request)
    {
        $medic=$this->getDoctrine()->getRepository(Medicament::class )->ListMedicByPriceASC();
        $form=$this->createForm(RechercheMedType::class);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $prix=$form->getData()->getPrix();


            $medicResult=$this->getDoctrine()->getRepository(Medicament::class )->recherche($prix);
            return $this->render("medi/ShowMedic.html.twig",array('medic'=>$medicResult,'form'=>$form->createView()));

        }
        return $this->render("medi/ShowMedic.html.twig",array('medic'=>$medic,'form'=>$form->createView()));


    }

    /**
     * @Route ("/ListMedicByPriceDESC", name="ListMedicByPriceDESC")
     */
    public function ListMedicByPriceDESC(MedicamentRepository  $repository, Request $request)
    {
        $medic=$this->getDoctrine()->getRepository(Medicament::class )->ListMedicByPriceDESC();
        $form=$this->createForm(RechercheMedType::class);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $prix=$form->getData()->getPrix();


            $medicResult=$this->getDoctrine()->getRepository(Medicament::class )->recherche($prix);
            return $this->render("medi/ShowMedic.html.twig",array('medic'=>$medicResult,'form'=>$form->createView()));

        }
        return $this->render("medi/ShowMedic.html.twig",array('medic'=>$medic,'form'=>$form->createView()));


    }
    /**
     * @Route ("/ListMedicByStockASC", name="ListMedicByStockASC")
     */
    public function ListMedicByStockASC(MedicamentRepository  $repository, Request $request)
    {
        $medic=$this->getDoctrine()->getRepository(Medicament::class )->ListMedicByStockASC();
        $form=$this->createForm(RechercheMedType::class);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $stock=$form->getData()->getStock();


            $medicResult=$this->getDoctrine()->getRepository(Medicament::class )->rechercheStock($stock);
            return $this->render("medi/ShowMedic.html.twig",array('medic'=>$medicResult,'form'=>$form->createView()));

        }
        return $this->render("medi/ShowMedic.html.twig",array('medic'=>$medic,'form'=>$form->createView()));


    }

    /**
     * @Route ("/ListMedicByStockDESC", name="ListMedicByStockDESC")
     */
    public function ListMedicByStockDESC(MedicamentRepository  $repository, Request $request)
    {
        $medic=$this->getDoctrine()->getRepository(Medicament::class )->ListMedicByStockDESC();
        $form=$this->createForm(RechercheMedType::class);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $stock=$form->getData()->getStock();


            $medicResult=$this->getDoctrine()->getRepository(Medicament::class )->rechercheStock($stock);
            return $this->render("medi/ShowMedic.html.twig",array('medic'=>$medicResult,'form'=>$form->createView()));

        }
        return $this->render("medi/ShowMedic.html.twig",array('medic'=>$medic,'form'=>$form->createView()));


    }


    /**
     * @param MedicamentRepository $repository
     *@return \symfony\Component\HttpFoundation\Response
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
            $nom = $form['name']->getData();
            $stck = $form['stock']->getData();

            $em = $this->getDoctrine()->getManager();
            $us1 = $em->getRepository(Medicament::class)->findEntitiesByNom($nom);
            if($us1!=null)
            {
                 $em->getRepository(Medicament::class)->updateEntitiesByNom($nom,doubleval($stck));
            }
            else{
            $em->persist($med);
            $em->flush();
                $this->addFlash(
                    'info',
                    'Médicament Ajouté avec succés!');

            }
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
            $this->addFlash(
                'info',
                'Médicament édité avec succés!');

            return $this->redirectToRoute('editmed', array('id' => $medicament->getId()));


        }
        return $this->render('medi/edit.html.twig', array(
            'medicament' => $medicament,
            'form' => $form->createView()));
    }
}
