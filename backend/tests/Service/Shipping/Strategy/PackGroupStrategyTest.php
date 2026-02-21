<?php
namespace App\Tests\Service\Shipping\Strategy;
use App\Service\Shipping\Strategy\PackGroupStrategy;
use PHPUnit\Framework\TestCase;

class PackGroupStrategyTest extends TestCase {
    public function testCalculate() {
        $strategy = new PackGroupStrategy();
        $this->assertEquals(5.0, $strategy->calculate(5));
        $this->assertEquals(12.5, $strategy->calculate(12.5));
    }
}
