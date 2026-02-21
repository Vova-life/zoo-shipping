<?php
namespace App\Controller\Api;

use App\Service\Shipping\ShippingCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/shipping', name: 'api_shipping_')]
class ShippingController extends AbstractController {
    #[Route('/calculate', name: 'calculate', methods: ['POST', 'OPTIONS'])]
    public function calculate(Request $request, ShippingCalculator $calculator): JsonResponse {
        // ДОЗВОЛЯЄМО ЗАПИТИ З ПОРТУ 5173
        $response = new JsonResponse();
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'POST, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type');

        if ($request->getMethod() === 'OPTIONS') {
            return $response;
        }

        $data = json_decode($request->getContent(), true);
        
        if (!isset($data['carrier']) || !isset($data['weightKg'])) {
            $response->setData(['error' => 'Missing parameters']);
            $response->setStatusCode(400);
            return $response;
        }

        try {
            $price = $calculator->calculate($data['carrier'], (float)$data['weightKg']);
            $response->setData([
                'carrier' => $data['carrier'],
                'weightKg' => $data['weightKg'],
                'currency' => 'EUR',
                'price' => $price,
            ]);
            return $response;
        } catch (\Exception $e) {
            $response->setData(['error' => $e->getMessage()]);
            $response->setStatusCode(400);
            return $response;
        }
    }
}
