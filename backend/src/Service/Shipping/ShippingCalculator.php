<?php
namespace App\Service\Shipping;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

class ShippingCalculator {
    private iterable $strategies;
    public function __construct(#[TaggedIterator('app.shipping_strategy')] iterable $strategies) {
        $this->strategies = $strategies;
    }
    public function calculate(string $carrier, float $weight): float {
        foreach ($this->strategies as $strategy) {
            if ($strategy->supports($carrier)) {
                return $strategy->calculate($weight);
            }
        }
        throw new \Exception("Unsupported carrier");
    }
}
