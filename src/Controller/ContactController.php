<?php
namespace App\Controller;

use App\Entity\Contact;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ContactController extends  Controller{
    /**
     * @Route("/", name="contact_list")
     * @Method({"GET"})
     */
    public function index(){

        $contact= $this->getDoctrine()->getRepository(Contact::class)->findAll();
        return $this->render('contact/index.html.twig', array('contact' => $contact));
    }
    /**
     * @Route("/contact/new", name="new_contact")
     * Method({"GET", "POST"})
     */
    public function new(Request $request)
    {
        $contact = new Contact();

        $form = $this->createFormBuilder($contact)
            ->add('naam', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('email', TextareaType::class, array(
                'required' => true,
                'attr' => array('class' => 'form-control')
            ))
            ->add('telefoonnummer', TextareaType::class, array(
                'required' => true,
                'attr' => array('class' => 'form-control')
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Create',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $contact = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();
            return $this->redirectToRoute('contact_list');
        }

        return $this->render('contact/new.html.twig', array(
            'form' => $form->createView()
        ));

    }

    /**
    //     * @Route("/contact/{id}", name="contact_show")
    //     */
    public function show($id){
        $contact = $this->getDoctrine()->getRepository(Contact::class)->find($id);
        return $this->render('contact/show.html.twig', array('contact' => $contact));
    }
    /**
     * @Route("/contact/delete/{id}")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id) {
        $contact = $this->getDoctrine()->getRepository(Contact::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($contact);
        $entityManager->flush();

        $response = new Response();
        $response->send();
    }
}
