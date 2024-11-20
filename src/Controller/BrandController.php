<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\BrandRepository;

class BrandController extends AbstractController
{
    #[Route('/brand', name: 'brand_index')]
    public function index(EntityManagerInterface $manager): Response
    {
        //Get the data
        $brands = $manager->getRepository(Brand::class)->findAll();

        return $this->render('brand/index.html.twig', [
            'brands' => $brands,
        ]);
    }
}
