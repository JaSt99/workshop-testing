<?php declare(strict_types=1);

namespace IW\Tests\Workshop\UnitTests;

use InvalidArgumentException;
use IW\Workshop\Calculator;
use PHPUnit\Framework\TestCase;

/**
 * TestClass CalculatorTest
 */
class CalculatorTest extends TestCase
{
    /** @var Calculator $object */
    private $object;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->object = new Calculator();
    }

    /**
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->object);
    }

    /**
     * @return void
     */
    public function testAddSuccessfully(): void
    {
        $firstNumber = rand(1, 999);
        $secondNumber = rand(1, 999);

        self::assertEquals($firstNumber + $secondNumber, $this->object->add($firstNumber, $secondNumber));
    }

    /**
     * @return void
     */
    public function testAddUnsuccessfully(): void
    {
        $firstNumber = rand(1, 999);
        $secondNumber = rand(1, 999);

        self::assertNotEquals($firstNumber - $secondNumber, $this->object->add($firstNumber, $secondNumber));
    }

    /**
     * @return void
     */
    public function testDivideSuccessfully(): void
    {
        $firstNumber = rand(1, 999);
        $secondNumber = rand(1, 999);

        self::assertEquals($firstNumber / $secondNumber, $this->object->divide($firstNumber, $secondNumber));
    }

    /**
     * @return void
     */
    public function testDivideUnsuccessfully(): void
    {
        $firstNumber = rand(1, 999);
        $secondNumber = rand(1, 999);

        self::assertNotEquals($firstNumber * $secondNumber, $this->object->divide($firstNumber, $secondNumber));
    }

    /**
     * @return void
     */
    public function testDivideException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Division by zero');

        $this->object->divide(rand(-999, 999), 0);
    }
}
