<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle\Tests\Unit;

use Answear\FocusContactCenterBundle\ChangeGenerator;
use Answear\FocusContactCenterBundle\Client;
use Answear\FocusContactCenterBundle\Configuration;
use Answear\FocusContactCenterBundle\Exception\ApiError;
use Answear\FocusContactCenterBundle\Exception\MalformedResponse;
use Answear\FocusContactCenterBundle\Exception\ServiceUnavailable;
use Answear\FocusContactCenterBundle\HashGenerator;
use Answear\FocusContactCenterBundle\Request\Request;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    /**
     * @see http://docs.guzzlephp.org/en/stable/testing.html#history-middleware
     */
    private $guzzleHistory;

    /**
     * @var MockHandler
     */
    private $guzzleHandler;

    /**
     * @var Configuration
     */
    private $config;

    /**
     * @var Client
     */
    private $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setupClient(1);
    }

    /**
     * @test
     */
    public function requestWithCampaignsIdIsCorrect(): void
    {
        $this->guzzleHandler->append(new Response(200, [], \json_encode(['success' => true])));
        $this->request($this->createDummyRequest());

        $this->assertCount(1, $this->guzzleHistory);
        /** @var \GuzzleHttp\Psr7\Request $request */
        $request = reset($this->guzzleHistory)['request'];

        $this->assertSame(
            [
                'login' => $this->config->getLogin(),
                'change' => $this->config->getChangeIdGenerator()->generate(),
                'hash' => 'e5e49a1767ad90ca997914dbc10f28b6c1e03437',
                'method' => $this->config->getHashMethod(),
                'campaigns_id' => $this->config->getCampaignsId(),
                'foo' => 'bar',
            ],
            \json_decode($request->getBody()->getContents(), true)
        );
    }

    /**
     * @test
     */
    public function requestWithoutCampaignsIdIsCorrect(): void
    {
        $this->setupClient(null);

        $this->guzzleHandler->append(new Response(200, [], \json_encode(['success' => true])));
        $this->request($this->createDummyRequest());

        $this->assertCount(1, $this->guzzleHistory);
        /** @var \GuzzleHttp\Psr7\Request $request */
        $request = reset($this->guzzleHistory)['request'];

        $this->assertSame(
            [
                'login' => $this->config->getLogin(),
                'change' => $this->config->getChangeIdGenerator()->generate(),
                'hash' => 'e5e49a1767ad90ca997914dbc10f28b6c1e03437',
                'method' => $this->config->getHashMethod(),
                'foo' => 'bar',
            ],
            \json_decode($request->getBody()->getContents(), true)
        );
    }

    /**
     * @test
     */
    public function invalidJsonInResponse(): void
    {
        $this->expectException(MalformedResponse::class);
        $this->guzzleHandler->append(new Response(200, [], '{]'));
        $this->request($this->createDummyRequest());
    }

    /**
     * @test
     */
    public function noSuccessInResponse(): void
    {
        $this->expectException(MalformedResponse::class);
        $this->guzzleHandler->append(new Response(200, [], '{}'));
        $this->request($this->createDummyRequest());
    }

    /**
     * @test
     */
    public function unsuccessfulWithoutMessage(): void
    {
        $this->expectException(MalformedResponse::class);
        $this->guzzleHandler->append(new Response(200, [], \json_encode(['success' => false])));
        $this->request($this->createDummyRequest());
    }

    /**
     * @test
     */
    public function apiErrorIsThrown(): void
    {
        $this->guzzleHandler->append(new Response(200, [], \json_encode(['success' => false, 'message' => 'Foo'])));

        try {
            $this->request($this->createDummyRequest());
        } catch (ApiError $e) {
            $this->assertSame('Foo', $e->getMessage());

            return;
        }

        $this->fail(ApiError::class . ' should have been thrown');
    }

    /**
     * @test
     */
    public function serviceUnavailableIsThrown(): void
    {
        $this->expectException(ServiceUnavailable::class);
        $this->guzzleHandler->append(new Response(500, [], '{}'));
        $this->request($this->createDummyRequest());
    }

    private function request(Request $request): void
    {
        $rm = new \ReflectionMethod($this->client, 'request');
        $rm->setAccessible(true);
        $rm->invoke($this->client, 'endpoint', $request);

        $this->assertNotEmpty($this->guzzleHistory);
        /** @var \GuzzleHttp\Psr7\Request $request */
        $request = end($this->guzzleHistory)['request'];

        $this->assertSame('POST', $request->getMethod());
        $this->assertSame($this->config->getUrl() . '/endpoint', (string) $request->getUri());
    }

    private function createDummyRequest(): Request
    {
        return new class() implements Request {
            public function toArray(): array
            {
                return ['foo' => 'bar'];
            }
        };
    }

    private function setupGuzzle(): ClientInterface
    {
        $this->guzzleHandler = new MockHandler();
        $handlerStack = HandlerStack::create($this->guzzleHandler);

        $this->guzzleHistory = [];
        $history = Middleware::history($this->guzzleHistory);
        $handlerStack->push($history);

        return new \GuzzleHttp\Client(['handler' => $handlerStack]);
    }

    private function setupClient(?int $campaignsId): void
    {
        $this->config = new Configuration(
            'https://example.org',
            'test@example.org',
            'apikey',
            $campaignsId,
            'sha1',
            new class() implements ChangeGenerator {
                public function generate(): string
                {
                    return 'change';
                }
            }
        );

        $this->client = new Client($this->config, new HashGenerator($this->config), $this->setupGuzzle());
    }
}
