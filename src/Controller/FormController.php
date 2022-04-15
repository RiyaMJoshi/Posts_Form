<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class FormController extends AbstractController
{
    #[Route('/form', name: 'app_form')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {
        # Add new Post
        // $post = new Post();

        // # $post->setTitle('Welcome');
        // # $post->setDescription('Hello Ji.. This is my description');

        // $form = $this->createForm(PostType::class, $post, [
        //     'action' => $this->generateUrl('app_form')
        // ]);

        // // handle the request
        // $form->handleRequest($request);

        // if ($form->isSubmitted() && $form->isValid()) {
        //     # Saving to the database
        //     //dd($post);

        //     $em = $doctrine->getManager();
        //     $em->persist($post);
        //     $em->flush();
        // }
        # End Add new Post

        # Remove specific Post
        $em = $doctrine->getManager();
        $post = $em->getRepository(Post::class)->findOneBy([
            'id' => 4
        ]);

        $form = $this->createForm(PostType::class, $post, [
            'action' => $this->generateUrl('app_form')
        ]);
        $form->handleRequest($request);

        $em->remove($post);
        $em->flush();
        # End Remove specific Post

        return $this->render('form/index.html.twig', [
            'post_form' => $form->createView()
        ]);
    }
}
