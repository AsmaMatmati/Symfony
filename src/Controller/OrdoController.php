<?php

namespace App\Controller;

use App\Entity\Consultation;
use App\Entity\Medecin;
use App\Entity\Medicament;
use App\Entity\Ordonnance;
use App\Entity\Patient;
use App\Form\OrdonnanceType;
use App\Form\RechercheeType;
use App\Form\RechercheType;
use App\Repository\MedicamentRepository;
use App\Repository\OrdonnanceRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Dompdf\Dompdf;
use Dompdf\Options;


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
        $this->addFlash(
            'infos',
            'Ordennance Supprimée avec succés!'
        );
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
            if (!empty($med->getName())) {
                $array[$med->getName()] = $med->getName();
            }
        }
        $ord = new Ordonnance();
        $form = $this->createForm(OrdonnanceType::class, $ord);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();


            $medica = $form['Medicaments']->getData();
            foreach ( $medica as $medic) {
                $us1 = $em->getRepository(Medicament::class)->findEntitiesByString($medic);
                foreach ($us1 as $us1) {
                    $ord->setMedicaments($us1);
                }
            }

            $medc = $form['Users']->getData();
            foreach ( $medc as $nomm) {
                $us2 = $em->getRepository(Users::class)->findEntitiesByMedecin($nomm);
                foreach ($us2 as $us2) {
                    $ord->setUsers($us2);
                }
            }


            $mec = $form['Users']->getData();
            foreach ( $mec as $pre) {
                $usp = $em->getRepository(Users::class)->findEntitiesByPreMedecin($pre);
                foreach ($usp as $usp) {
                    $ord->setUsers($usp);
                }
            }




            $pat = $form['Patient']->getData();
            foreach ($pat as $pt) {
                $usp = $em->getRepository(Patient::class)->findEntitiesByPatient($pt);
                foreach ($usp as $usp) {
                    $ord->setPatient($usp);
                }
            }

            $pat = $form['Patient']->getData();
            foreach ( $pat as $pt1) {
                $usp1 = $em->getRepository(Patient::class)->findEntitiesByPrePatient($pt1);
                foreach ($usp1 as $usp1) {
                    $ord->setPatient($usp1);
                }
            }


            $cslt = $form['Consultation']->getData();
            foreach ($cslt as $dt) {
                $us4 = $em->getRepository(Consultation::class)->findEntitiesByDate($dt);
                foreach ($us4 as $us4) {
                    $ord->setConsultation($us4);
                   //$dt['dateC']->format('Y-m-d');
                }
            }
            $nbj=$form['nbr_jrs']->getData();
            $nbd=$form['nbr_doses']->getData();
            $nbf=$form['nbr_fois']->getData();
            $a=(int)$nbj ;
            $b=(float)$nbd;
            $c=(int)$nbf;
            $paq=$a*$b*$c;
            if($paq<=24)
            {
                $ord->setNbrPaquets(1);
            }
            if($paq>24)
            {
                $ord->setNbrPaquets(2);
            }
            if($paq>48)
            {
                $ord->setNbrPaquets(3);
            }
            if($paq>72)
            {
                $ord->setNbrPaquets(4);
            }
            if($paq>96)
            {
                $ord->setNbrPaquets(5);
            }
            if($paq>120)
            {
                $ord->setNbrPaquets(6);
            }
            if($paq>144)
            {
                $ord->setNbrPaquets(7);
            }
            if($paq>168)
            {
                $ord->setNbrPaquets(8);
            }
            if($paq>192)
            {
                $ord->setNbrPaquets(9);
            }
            if($paq>216)
            {
                $ord->setNbrPaquets(10);
            }
            if($paq>240)
            {
                $ord->setNbrPaquets(11);
            }
            $em->persist($ord);
            $em->flush();
            $this->addFlash(
                'info',
                'Ordennance Ajoutée avec succes!');

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

            $this->addFlash(
                'info',
                'Ordennance editée avec succes!');

            return $this->redirectToRoute('edit', array('id' => $ordo->getId()));

        }
        return $this->render('ordo/UpdateOrdo.html.twig', array(
            'ord' => $ordo,
            'form' => $form->createView()));
    }




    /**
     * @Route ("/ListOrdoByDateDESC", name="ListOrdoByDateDESC")
     */
    public function ListMedicByNameDESC(MedicamentRepository  $repository, Request $request)
    {
        $ord=$this->getDoctrine()->getRepository(Ordonnance::class )->ListOrdoByDateDESC();
        $form=$this->createForm(RechercheType::class);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $dateC=$form->getData()->getDateC();

            $odnResult=$this->getDoctrine()->getRepository(Ordonnance::class )->recherche($dateC);
            return $this->render("ordo/ShowOrdo.html.twig",array('ord'=>$odnResult,'form'=>$form->createView()));

        }
        return $this->render("ordo/ShowOrdo.html.twig",array('ord'=>$ord,'form'=>$form->createView()));


    }

    /**
     * @Route ("/ListOrdoByDateASC", name="ListOrdoByDateASC")
     */
    public function ListMedicByNameASC(MedicamentRepository  $repository, Request $request)
    {
        $ord=$this->getDoctrine()->getRepository(Ordonnance::class )->ListOrdoByDateASC();
        $form=$this->createForm(RechercheType::class);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $dateC=$form->getData()->getDateC();

            $odnResult=$this->getDoctrine()->getRepository(Ordonnance::class )->recherche($dateC);
            return $this->render("ordo/ShowOrdo.html.twig",array('ord'=>$odnResult,'form'=>$form->createView()));

        }
        return $this->render("ordo/ShowOrdo.html.twig",array('ord'=>$ord,'form'=>$form->createView()));


    }




    /**
     * @Route ("/listOrdonorderby", name="listOrdonorderby")
     */
    public function listOrdonorderby( Request $request)
    {
        $ord = $this->getDoctrine()->getRepository(Ordonnance::class)->findAll();
        $odn=$this->getDoctrine()->getRepository(Ordonnance::class)->listOrdonorderbyNomm();
        $form = $this->createForm(RechercheeType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted())
        {
            $nom = $form['Patient']->getData();
            if ( $nom=="") {
            $ordResult = $this->getDoctrine()->getRepository(Ordonnance::class)->findAll();
        } else {
            $ordResult = $this->getDoctrine()->getRepository(Ordonnance::class)->recherche($nom->getNom());
        }
            return $this->render('ordo/ListOrdonOrderBy.html.twig', array('odn' => $ordResult,'form' => $form->createView()));

        }

                 return $this->render('ordo/ListOrdonOrderBy.html.twig', array( 'odn' => $odn,'form' => $form->createView()));
        }



    /**
     * @Route("/PdfOrdo/{id}", name="PdfOrdo", methods={"GET"})
     */
    public function PdfOrdo($id)

    {
        $i=0;
        $i=$i+1;
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $ord=$this->getDoctrine()->getRepository( Ordonnance::class)->find($id);


            // Retrieve the HTML generated in our twig file
            $html = $this->renderView("ordo/Pdf.html.twig", array("ord" => $ord));

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Store PDF Binary Data
        $output = $dompdf->output();

        // In this case, we want to write the file in the public directory

        $publicDirectory = $this->getParameter('kernel.project_dir') . '/public/uploads';
        // e.g /var/www/project/public/mypdf.pdf
        $pdfFilepath =  $publicDirectory . '/Ordonnance'.$i.'pdf';

        // Write file to the desired path
        file_put_contents($pdfFilepath, $output);

        // Send some text response
        return new Response("The PDF file has been succesfully generated !");
    }
}
