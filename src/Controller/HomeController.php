<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use BlaguesApi\BlaguesApiInterface;
use BlaguesApi\JokeTypes;

final class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(BlaguesApiInterface $blapi): Response
    {
        $allowedTypes = array_values(array_filter(JokeTypes::TYPES, fn($type) => $type === 'dark'));
        $joke = $blapi->getRandom($allowedTypes);

        return $this->render('home/index.html.twig', [
            'joke' => $joke


        ]);
    }
}
