<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Swift_Message;



class ReclamationController extends AbstractController
{
    /**
     * @Route("/rec", name="reclamation")
     */
    public function index(Request $request,\Swift_Mailer $mailer): Response
    {

        $form=$this->createForm(ContactType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $contact=$form->getData();
            $message=(new \Swift_Message('Nouveau Contact'))
                ->setFrom($contact['email'])

                ->setTo('asma.matmati@esprit.tn')
                ->setTo('recipient@example.com')

                ->setBody(
                    $this->renderView(
                            'emails/contact.html.twig', compact('contact')
                    ),
                    'text/html'
                );


                $mailer->send($message);

                $this->addFlash('message', 'Message envoyé');
                return $this->redirectToRoute('chambre_show');
            //dd($contact);
        }
        return $this->render('reclamation/index.html.twig', [
            'formContact' => $form->createView()
        ]);
    }
}
