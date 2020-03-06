<?php

declare(strict_types=1);

namespace Answear\FocusContactCenterBundle;

use Answear\FocusContactCenterBundle\Exception\ApiError;
use GuzzleHttp\RequestOptions;

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
     * @var \GuzzleHttp\Client
     */
    private $guzzle;

    public function __construct(Configuration $configuration, HashGenerator $hashGenerator, \GuzzleHttp\Client $guzzle)
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
        $response = $this->guzzle->request(
            'POST',
            sprintf('%s/%s', $this->configuration->getUrl(), $endpoint),
            [
                RequestOptions::JSON => \array_merge($auth, $request->toArray()),
            ]
        );
        $responseText = $response->getBody()->getContents();

        $decoded = \json_decode($responseText, true);
        // TODO validate
        if (false === $decoded['success']) {
            throw new ApiError($decoded['message'], $request);
        }

        return $decoded;
    }
}
