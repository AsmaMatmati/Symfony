<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{


    /**
     * @Route("/removeCat/{id}", name="remove_category")
     */

    public function remove($id)
    {
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();
        return $this->redirectToRoute('category_show');

    }
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/for", name="for")
     */


    /**
     * @Route("/listccategory", name="category_show")
     */
    public function listcategory()
    {
        $category = $this->getDoctrine()->getRepository(category::class)->findAll();
        return $this->render("category/showCategory.html.twig", array("categorys" => $category));

    }
    /**
     * @Route("/categorie/new", name="category_create")
     */
    public function create (Request $request){
        $category=new Category();
        $form=$this->createForm(CategoryType::class,$category);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
            return $this->redirectToRoute("category_show");
        }
        return $this->render('category/formCategory.html.twig' , ['formCategorie' =>$form->createView()]);
    }
    /**
     * @Route("/categorie/{id}/edit", name="edit_category")
     */
    function Update(CategoryRepository  $repository, $id,Request $request)
    {
        $category = $repository->find($id);
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute("category_show");


        }
        return $this->render('category/Updatecategory.html.twig', ['fCategory' => $form->createView()]);}


        /**
     * @Route("/stats", name="stats")
     */
    /**public function statistiques(CategoryRepository  $categRepo){
        // On va chercher toutes les catégories
        $categories = $categRepo->findAll();

        $categNom = [];
        $categColor = [];
        $categCount = [];

        // On "démonte" les données pour les séparer tel qu'attendu par ChartJS
        foreach($categories as $categorie){
            $categNom[] = $categorie->getNom();
            $categColor[] = $categorie->getColors();
            $categCount[] = count($categorie->getNom());
        }

        // On va chercher le nombre d'annonces publiées par date


        //$dates = [];
        //$annoncesCount = [];

        // On "démonte" les données pour les séparer tel qu'attendu par ChartJS



        return $this->render('admin/stats.html.twig', [
            'categNom' => json_encode($categNom),
            'categColor' => json_encode($categColor),
            'categCount' => json_encode($categCount),
           //'dates' => json_encode($dates),
            //'annoncesCount' => json_encode($annoncesCount),
        ]);
    }
*/




}