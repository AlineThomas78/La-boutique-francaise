<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountPasswordController extends AbstractController
{

    private $entityManager;

    /**
     * AccountPasswordController constructor
     * @param  $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager){

        $this->entityManger = $entityManager;
    }

    /**
     * @Route("/compte/modifier-mon-mot-de-passe", name="app_account_password")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder, EntityManagerInterface $entityManager )
    {
        $notification = null;

        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class, $user);

        $form ->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $old_pwd = $form ->get('old_password')->getData();

            if($encoder->isPasswordValid($user, $old_pwd)){
                $new_pwd = $form->get('new_password')->getData();
                $password = $encoder->encodePassword($user, $new_pwd);

                $user->setPassword($password);

                // $entityManager->persist($user);
                $entityManager->flush();
                $notification = "Votre mot de passe a bien été mis à jour";

            }else{
                $notification = "Votre mot de passe n'est pas le bon !";
            }
        }

       

        return $this->render('account/password.html.twig',[
            'form' => $form->createView(),
            "notification" => $notification
        ]);
    }
}
