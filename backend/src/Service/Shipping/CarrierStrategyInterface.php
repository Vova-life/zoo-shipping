<?php
namespace App\Service\Shipping;

interface CarrierStrategyInterface {
    public function calculate(float $weight): float;
    public function supports(string $carrierSlug): bool;
}
