<?php

namespace App\Controller;

use App\Entity\Dossier;
use App\Form\DossierType;
use App\Repository\DossierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

class DossierController extends AbstractController
{
    /**
     * @Route("/dossier", name="dossier")
     */
    public function index(): Response
    {
        return $this->render('dossier/index.html.twig', [
            'controller_name' => 'DossierController',
        ]);
    }

    /**
     * @Route("/removeD/{id}", name="remove_dossier")
     */
    public function remove($id)
    {
        $dossier = $this->getDoctrine()->getRepository(Dossier::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($dossier);
        $em->flush();
        return $this->redirectToRoute('dossier_show');
    }

    /**
     * @Route("/listdossier", name="dossier_show")
     */
    public function afficheDossier()
    {
        $dossier = $this->getDoctrine()->getRepository(dossier::class)->findAll();
        return $this->render("dossier/ShowDoc.html.twig", array("dossiers" => $dossier));

    }
    /**
     * @Route("/dossier/add", name="dossier_create")
     */
    public function CreerDossier (Request $request){

        $dossier=new Dossier();
        $form=$this->createForm(DossierType::class,$dossier);

        $form->handleRequest($request);
        $dossier->setDateCreation(new \DateTime('now'));


        if($form->isSubmitted()
            //&& $form->isValid()
        )
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($dossier);
            $em->flush();
            
            mkdir(__DIR__ . '/../../public/uploads/' . $dossier->getDescription());

            return $this->redirectToRoute('dossier_show');
        }
        return $this->render('dossier/create.html.twig' , ['formDossier' =>$form->createView()]);
    }
    /**
     * @Route("/dossier/{id}/edit", name="edit_dossier")
     */
    function UpdateDoc(DossierRepository $repository, $id,Request $request)
    {
        $dossier = $repository->find($id);
        $form = $this->createForm(DossierType::class, $dossier);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($dossier);
            $em->flush();

            return $this->redirectToRoute("dossier_show");


        }
        return $this->render('dossier/UpdateDoc.html.twig', ['form' => $form->createView()]);}

    // /**
    // * @Route("dossier/recherche", name="recherche")
    //  */
    // function Recherche(DossierRepository $repository,Request $request)
    //{
    //   $data=$request->get('search');
    //  $dossier=$repository->findBy(['id'=>$data]);
    //  return $this->render('dossier/ShowDoc.html.twig', array("dossiers" => $dossier));
    // }

}
