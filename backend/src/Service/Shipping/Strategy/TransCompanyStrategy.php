<?php
namespace App\Service\Shipping\Strategy;
use App\Service\Shipping\CarrierStrategyInterface;

class TransCompanyStrategy implements CarrierStrategyInterface {
    public function calculate(float $weight): float {
        return $weight <= 10 ? 20.0 : 100.0;
    }
    public function supports(string $carrierSlug): bool {
        return $carrierSlug === 'transcompany';
    }
}
