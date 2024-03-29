<?php

namespace App\Controller;

use App\DTO\Post as PostDTO;
use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    public function index(PostRepository $postRepository): Response
    {
        return $this->render('post/index.html.twig', [
            'posts' => $postRepository->findAll(),
        ]);
    }

    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $postDTO = new PostDTO();
        $form = $this->createForm(PostType::class, $postDTO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post = Post::fromPostDTO($postDTO);
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('post/new.html.twig', [
            'post' => $postDTO,
            'form' => $form,
        ]);
    }

    public function show(Post $post): Response
    {
        return $this->render('post/show.html.twig', [
            'post' => $post,
        ]);
    }

    public function edit(Request $request, Post $post, EntityManagerInterface $entityManager): Response
    {
        $postDTO = PostDTO::fromEntity($post);
        $form = $this->createForm(PostType::class, $postDTO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post = Post::fromPostDTO($postDTO, $post);
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('post/edit.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    public function delete(Request $request, Post $post, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post->getId(), $request->request->get('_token'))) {
            $entityManager->remove($post);
            $entityManager->flush();
        }

        return $this->redirectToRoute('post_index', [], Response::HTTP_SEE_OTHER);
    }
}
