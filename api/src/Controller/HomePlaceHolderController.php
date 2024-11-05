<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePlaceHolderController extends AbstractController
{
    #[Route("/", name: "home", methods: ["GET"])]
    public function register(Request $request): Response
    {
        return new JsonResponse([
            "serviceName" => "s-eco",
        ]);
    }
}
