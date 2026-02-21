<?php
namespace App\Tests\Service\Shipping\Strategy;
use App\Service\Shipping\Strategy\TransCompanyStrategy;
use PHPUnit\Framework\TestCase;

class TransCompanyStrategyTest extends TestCase {
    public function testCalculate() {
        $strategy = new TransCompanyStrategy();
        $this->assertEquals(20.0, $strategy->calculate(5));
        $this->assertEquals(20.0, $strategy->calculate(10));
        $this->assertEquals(100.0, $strategy->calculate(11));
    }
}
