<?php

namespace App\Controller;
use App\Entity\Category;
use App\Entity\Chambre;
use App\Form\ChambreType;
use App\Form\RechercheChambreType;
use App\Form\RechercheType;
use App\Repository\CategoryRepository;
use Ob\HighchartsBundle\Highcharts\Highchart;

use App\Repository\ChambreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;





class ChambreController extends AbstractController
{
    /**
     * @Route("/chambre", name="chambre")
     */

    public function index(){

        $med=$this->getDoctrine()->getRepository(Chambre::class)->findAll();
        //instance bundle chart
        $ob2 = new Highchart();
        //ne5tarou el type mta3 el chart piechart hoya type doura
        $ob2->chart->renderTo('piechart');
        $ob2->title->text('chambre par categorie');
        $ob2->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',

            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));
        $data = null;
        foreach($med as $value)
        {
            $data[] = array(
                '' .$value->getnom(), (int)$value->getstock(),
            );
        }

        $ob2->series(array(array('type' => 'pie', 'name' => 'Stock', 'data' => $data)));

        return $this->render('chambre/index.html.twig', [
            'controller_name' => 'ChambreController','piechart'=>$ob2
        ]);
    }







    /**
     * @Route("/removeCh/{num}", name="remove_chambre")
     */

    public function remove($num){
        $chambre=$this->getDoctrine()->getRepository(Chambre::class)->find($num);

        $em=$this->getDoctrine()->getManager();
        $em->remove($chambre);

        $em->flush();
        return $this->redirectToRoute('chambre_show');

    }
    /**
     *@param Request $request
     *@return \Symfony\Component\HttpFoundation\Response
     * @Route("/for", name="for")
     */


        /**
         * @Route("/listchambre", name="chambre_show")
         */
        public function listchambre()
    {
        $chambres=$this->getDoctrine()->getRepository(chambre::class)->findAll();
        return $this->render("chambre/showchambre.html.twig",array("chambres"=>$chambres));

    }

    /**
     * @Route("/chambre/new", name="chambre_create")
     */
    public function create (Request $request){
            $chambre=new chambre();
        $form=$this->createForm(ChambreType::class,$chambre);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($chambre);
            $em->flush();
            return $this->redirectToRoute("chambre_show");
        }
        return $this->render('chambre/create.html.twig' , ['formChambre' =>$form->createView()]);
    }
    /**
     * @Route("/chambre/{num}/edit", name="edit_chambre")
     */
    function Update(ChambreRepository  $repository, $num,Request $request)
    {
        $chambre = $repository->find($num);
        $form = $this->createForm(ChambreType::class, $chambre);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($chambre);
            $em->flush();

            return $this->redirectToRoute("chambre_show");


        }
        return $this->render('chambre/Updatechambre.html.twig', ['fChambre' => $form->createView()]);}

    /**
     * @Route("/trie",name="listChambreOrderBy")
     */
    public function listChambreorderby(Request $request){

        $chambres=$this->getDoctrine()->getRepository(Chambre::class)->listChambreorderbyNum();
        $room=$this->getDoctrine()->getRepository(Chambre::class)->listChambreorderbyNbrplace();
        $chambre=$this->getDoctrine()->getRepository(Chambre::class)->listChambreorderbyEtage();

$form=$this->createForm(RechercheChambreType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() ){
            $num=$form->getData()->getNum();
            $category=$form->getData()->getCategory();
            $chambresR=$this->getDoctrine()->getRepository(Chambre::class)-> recherche($num);


            return $this->render('chambre/listChambreOrderBy.html.twig',array('chambres'=> $chambresR,'form'=>$form->createView()));

        }
        return $this->render('chambre/listChambreOrderBy.html.twig',array('chambres'=>$chambres,'chambres'=>$room,'chambres'=>$chambre,'form'=>$form->createView()));

    }
    /**
     * @Route("/triec",name="list")
     */

    public function countChambrePerCategory(){
        $chambres = $this->getDoctrine()
            ->getRepository(Chambre::class)
            ->findChambrebyCategorie();
        return $this->render('chambre/listChambreOrderBy.html.twig',array('chambres'=> $chambres));


    }

    /**
     * @Route("/homeCh", name="homeCh")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function affichecategoriee(ChambreRepository $rep,CategoryRepository $rep1)
    {
        $med=$this->getDoctrine()->getRepository(Chambre::class)->findAll();
        $cat=$this->getDoctrine()->getRepository(Category::class)->findAll();
        //$nombre=$this->getDoctrine()->getRepository(Chambre::class)->countid();
        //instance bundle chart
        $ob2 = new Highchart();
        //ne5tarou el type mta3 el chart piechart hoya type doura
        $ob2->chart->renderTo('piechart');
        $ob2->title->text('statistique chambre par categorie');
        $ob2->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));
        $data = null;
        foreach($cat as $value)
        {
            $data[] = array(
                '' .$value->getNom(), (int)$rep->countid($value->getId()),
            );
        }

        $ob2->series(array(array('type' => 'pie', 'name' => 'chambre', 'data' => $data)));

        return $this->render('chambre/index.html.twig', [
            'controller_name' => 'ChambreController','piechart'=>$ob2
        ]);
    }

}
