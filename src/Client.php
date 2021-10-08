<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle;

use Answear\FocusContactCenterBundle\Exception\ApiError;
use Answear\FocusContactCenterBundle\Exception\MalformedResponse;
use Answear\FocusContactCenterBundle\Exception\ServiceUnavailable;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Webmozart\Assert\Assert;

class Client
{
    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * @var HashGenerator
     */
    private $hashGenerator;

    /**
     * @var ClientInterface
     */
    private $guzzle;

    public function __construct(Configuration $configuration, HashGenerator $hashGenerator, ClientInterface $guzzle)
    {
        $this->configuration = $configuration;
        $this->hashGenerator = $hashGenerator;
        $this->guzzle = $guzzle;
    }

    public function fccAddRecords(Request\FCC\AddRecords $request): Response\FCC\AddRecords
    {
        return Response\FCC\AddRecords::fromArray($this->request('fcc-add-records', $request));
    }

    public function fccUpdateRecords(Request\FCC\UpdateRecords $request): Response\FCC\UpdateRecords
    {
        return Response\FCC\UpdateRecords::fromArray($this->request('fcc-update-records', $request));
    }

    public function fccUpsertRecords(Request\FCC\UpsertRecords $request): Response\FCC\UpsertRecords
    {
        return Response\FCC\UpsertRecords::fromArray($this->request('fcc-upsert-records', $request));
    }

    private function request(string $endpoint, Request\Request $request): array
    {
        $change = $this->configuration->getChangeIdGenerator()->generate();
        $auth = [
            'login' => $this->configuration->getLogin(),
            'change' => $change,
            'hash' => $this->hashGenerator->hash($change),
            'method' => $this->configuration->getHashMethod(),
            'campaigns_id' => $this->configuration->getCampaignsId(),
        ];
        try {
            $response = $this->guzzle->request(
                'POST',
                sprintf('%s/%s', $this->configuration->getUrl(), $endpoint),
                [
                    RequestOptions::JSON => \array_merge($auth, $request->toArray()),
                ]
            );
            if ($response->getBody()->isSeekable()) {
                $response->getBody()->rewind();
            }
            $responseText = $response->getBody()->getContents();
        } catch (GuzzleException $e) {
            throw new ServiceUnavailable($e->getMessage(), $e->getCode(), $e);
        }

        $decoded = \json_decode($responseText, true);
        try {
            Assert::isArray($decoded);
            Assert::keyExists($decoded, 'success');
            if (false === $decoded['success']) {
                Assert::keyExists($decoded, 'message');

                throw new ApiError($decoded['message'], $request);
            }
        } catch (\InvalidArgumentException $e) {
            throw new MalformedResponse($e->getMessage(), $decoded, $e);
        }

        return $decoded;
    }
}
