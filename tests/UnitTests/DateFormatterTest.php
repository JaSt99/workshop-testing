<?php declare(strict_types=1);

namespace IW\Tests\Workshop\UnitTests;

use DateTime;
use Exception;
use IW\Workshop\DateFormatter;
use PHPUnit\Framework\TestCase;

/**
 * TestClass DateFormatterTest
 */
class DateFormatterTest extends TestCase
{
    /** @var DateFormatter $object */
    private $object;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->object = new DateFormatter();
    }

    /**
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->object);
    }

    /**
     * @dataProvider dataProviderDayParts
     *
     * @param int[]  $hours
     * @param string $partOfDay
     *
     * @return void
     *
     * @throws Exception
     */
    public function testGetPartOfDay(array $hours, string $partOfDay): void
    {
        foreach ($hours as $hour) {
            $dateTime = new DateTime(date('d.m.Y ' . $hour . ':00:00'));
            self::assertSame($partOfDay, $this->object->getPartOfDay($dateTime));
        }
    }

    /**
     * @return array<string, array<string, string|int[]>>
     */
    public function dataProviderDayParts(): array
    {
        return [
            'night' => [
                'hours' => [0, 1, 2, 3, 4, 5],
                'partOfDay' => 'Night',
            ],
            'morning' => [
                'hours' => [6, 7, 8, 9, 10, 11],
                'partOfDay' => 'Morning',
            ],
            'afternoon' => [
                'hours' => [12, 13, 14, 15, 16, 17],
                'partOfDay' => 'Afternoon',
            ],
            'evening' => [
                'hours' => [18, 19, 20, 21, 22, 23],
                'partOfDay' => 'Evening',
            ],
        ];
    }
}
