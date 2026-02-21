<?php
namespace App\Controller\Api;

use App\Service\Shipping\ShippingCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/shipping', name: 'api_shipping_')]
class ShippingController extends AbstractController {
    #[Route('/calculate', name: 'calculate', methods: ['POST'])]
    public function calculate(Request $request, ShippingCalculator $calculator): JsonResponse {
        $data = json_decode($request->getContent(), true);
        
        if (!isset($data['carrier']) || !isset($data['weightKg'])) {
            return $this->json(['error' => 'Missing parameters'], 400);
        }

        try {
            $price = $calculator->calculate($data['carrier'], (float)$data['weightKg']);
            return $this->json([
                'carrier' => $data['carrier'],
                'weightKg' => $data['weightKg'],
                'currency' => 'EUR',
                'price' => $price,
            ]);
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()], 400);
        }
    }
}
