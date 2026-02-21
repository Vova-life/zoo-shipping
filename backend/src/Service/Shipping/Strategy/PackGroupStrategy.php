<?php
namespace App\Service\Shipping\Strategy;
use App\Service\Shipping\CarrierStrategyInterface;

class PackGroupStrategy implements CarrierStrategyInterface {
    public function calculate(float $weight): float {
        return $weight * 1.0;
    }
    public function supports(string $carrierSlug): bool {
        return $carrierSlug === 'packgroup';
    }
}
