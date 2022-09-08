<?php

namespace App\Controller;

use Generator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Stopwatch\Stopwatch;

class TestController extends AbstractController
{
    #[Route('/test', name: 'test')]
    public function index(Stopwatch $stopwatch): Response
    {
        $sumGenerator = $sumArray = 0;

        $stopwatch->start('testGenerator');
        foreach ($this->getArrayWithGenerator() as $item) {
            $sumGenerator += $item;
        }
        $stopwatchEvent = $stopwatch->stop('testGenerator');
        dump($stopwatchEvent->getDuration());

        $stopwatch->start('testArray');
        foreach ($this->getArray() as $item) {
            $sumGenerator += $item;
        }
        $stopwatchEvent = $stopwatch->stop('testArray');
        dump($stopwatchEvent->getDuration());

        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

    private function getArrayWithGenerator(): Generator
    {
        for ($i = 0; $i < 200099; $i++)
        {
            yield $i;
        }
    }

    private function getArray(): array
    {
        $test = [];
        for ($i = 0; $i < 200099; $i++)
        {
            $test[] = $i;
        }

        return $test;
    }
}
