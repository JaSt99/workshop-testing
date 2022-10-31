<?php declare(strict_types=1);

namespace IW\Tests\Workshop\UnitTests;

use IW\Workshop\Client\Curl;
use IW\Workshop\PostService;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * TestClass PostServiceTest
 */
class PostServiceTest extends TestCase
{
    /** @var PostService $object */
    private $object;
    /** @var MockObject $client */
    private $client;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->client = $this->getMockBuilder(Curl::class)->getMock();
        $this->object = new PostService($this->client);
    }

    /**
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->object, $this->client);
    }

    /**
     * @dataProvider dataProviderIds
     *
     * @param int $id
     *
     * @return void
     */
    public function testCreatePostSuccessfully(int $id): void
    {
        $this->client->method('post')->withAnyParameters()->willReturn([201, '{"id": ' . $id . '}']);
        self::assertSame($id, $this->object->createPost([]));
    }

    /**
     * @return int[][]
     */
    public function dataProviderIds(): array
    {
        return [[1], [2], [3], [4]];
    }

    /**
     * @return void
     */
    public function testCreatePostArticleNotRetrieved(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('An id of article could not be retrieved.');

        $this->client->method('post')->withAnyParameters()->willReturn([201, '{}']);
        $this->object->createPost([]);
    }

    /**
     * @dataProvider dataProviderStatusCodes
     *
     * @param int $statusCode
     *
     * @return void
     */
    public function testCreatePostWrongStatusCode(int $statusCode): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Post could not be created.');

        $this->client->method('post')->withAnyParameters()->willReturn([$statusCode, '{}']);
        $this->object->createPost([]);
    }

    /**
     * @return int[][]
     */
    public function dataProviderStatusCodes(): array
    {
        return [
            [100], [101], [102], [103], [200], [202], [203], [204], [205], [206], [207], [208], [226], [300], [301],
            [302], [303], [304], [305], [306], [307], [308], [400], [401], [402], [403], [404], [405], [406], [407],
            [408], [409], [410], [411], [412], [413], [414], [415], [416], [417], [418], [421], [422], [423], [424],
            [425], [426], [428], [429], [431], [451], [500], [501], [502], [503], [504], [505], [506], [507], [508],
            [510], [511],
        ];
    }
}
