<?php


namespace App\Controller;



use App\Form\UserFormType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{

    /**
     * @Route("/user/{id}", name="user.index")
     */
    public function index(UserRepository $userRepository, $id)
    {
        $userAccount = $userRepository->find($id);
//        dd($userAccount);
        return $this->render('user/account.html.twig',['user'=>$userAccount]);
    }

    /**
     * @Route("/new", name="user.new")
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $form = $this->createForm(UserFormType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $user = $form->getData();
            $plainPassword = $form['plainPassword']->getData();
            $encodePassword=$passwordEncoder ->encodePassword($user,$plainPassword);
            $user->setPassword($encodePassword);
            /** @var User $user */
            $user = $form->getData();
            $entityManager =$this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('succes',
                'Votre compte a bien été créer vous pouvez maintenant vous
                 <a href="'.$this->generateUrl('security.login').'">connecter !</a>');
            return $this->redirectToRoute('home.index');
        }
        return $this->render('user/new.html.twig',['form' => $form->createview()]);
    }
}