<?php

namespace App\Controller;

use App\Entity\Test;
use App\Form\TestType;
use App\Repository\TestRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TestController extends AbstractController
{
    public function index(TestRepository $testRepository): Response
    {
        return $this->render('test/index.html.twig', [
            'tests' => $testRepository->findAll(),
        ]);
    }

    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $test = new Test();
        $form = $this->createForm(TestType::class, $test);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($test);
            $entityManager->flush();

            return $this->redirectToRoute('test_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('test/new.html.twig', [
            'form' => $form,
        ]);
    }

    public function show(Test $test): Response
    {
        return $this->render('test/show.html.twig', [
            'test' => $test,
        ]);
    }

    public function edit(Request $request, Test $test, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TestType::class, $test);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($test);
            $entityManager->flush();

            return $this->redirectToRoute('test_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('test/edit.html.twig', [
            'test' => $test,
            'form' => $form,
        ]);
    }

    public function delete(Request $request, Test $test, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$test->getId(), $request->request->get('_token'))) {
            $entityManager->remove($test);
            $entityManager->flush();
        }

        return $this->redirectToRoute('test_index', [], Response::HTTP_SEE_OTHER);
    }
}