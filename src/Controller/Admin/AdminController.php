<?php


namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin.index")
     */
    public function index()
    {
        return $this->render('home.html.twig');
    }


    /**
     * @Route("/admin/searchusers", name="admin.search")
     * @param UserRepository $userRepository
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function search(UserRepository $userRepository,Request $request)
    {
        $templateData =[];

       if ($request->request->count())
       {
          $name = $request->request->get('name');
          $firstname = $request->request->get('firstname');

           $templateData['users']= $userRepository->findBy(['name'=>$name]);
//dd($templateData);
           return $this->render('admin/search.html.twig',['templateData'=>$templateData]);
       }else{
           $templateData['users']=$userRepository->findAll();
           return $this->render('admin/search.html.twig',['templateData'=>$templateData]);
       }
    }

}