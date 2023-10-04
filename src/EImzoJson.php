<?php

namespace MrMusaev\EImzo;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\TransferException;
use MrMusaev\Eimzo\Exceptions\ParameterNotConfiguredException;
use MrMusaev\EImzo\Responses\ChallengeResponse;
use MrMusaev\EImzo\Responses\MobileAuthResponse;
use MrMusaev\EImzo\Responses\MobileStatusResponse;

class EImzoJson implements EImzoConnection
{
    private string $baseUrl;
    private int $operationTimeout;
    private int $connectionTimeout;

    public Client $client;
    public string $url;
    public array $headers = [];
    public array $requestParams = [];
    public array $response = [];

    /**
     * @throws ParameterNotConfiguredException
     */
    public function __construct()
    {
        $this->baseUrl = config('eimzo-json.base_url');
        $this->operationTimeout = config('eimzo-json.operation_timeout');
        $this->connectionTimeout = config('eimzo-json.connection_timeout');

        if (empty($this->baseUrl)) {
            throw new ParameterNotConfiguredException("One of the package parameters not configured correctly!");
        }

        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'connect_timeout' => $this->connectionTimeout,
            'timeout' => $this->operationTimeout,
        ]);
    }

    public function createChallenge(): ChallengeResponse
    {
        $this->url = '/frontend/challenge';

        $this->sendGetRequest();

        return new ChallengeResponse(
            challenge: $this->response['challenge'] ?? '',
            ttl: $this->response['ttl'] ?? 0,
            status: $this->response['status'] ?? 0,
            message: $this->response['message'] ?? '',
        );
    }

    public function mobileAuth(): MobileAuthResponse
    {
        $this->url = '/frontend/mobile/auth';

        $this->sendPostRequest();

        return new MobileAuthResponse(
            challange: $this->response['challange'] ?? '',
            documentId: $this->response['documentId'] ?? '',
            siteId: $this->response['siteId'] ?? '',
            status: $this->response['status'] ?? 0,
            message: $this->response['message'] ?? '',
        );
    }

    public function mobileStatus(string $documentId): MobileStatusResponse
    {
        $this->url = '/frontend/mobile/status';

        $this->requestParams = [
            'documentId' => $documentId,
        ];

        $this->sendPostRequest();

        return new MobileStatusResponse(
            status: $this->response['status'] ?? 0,
            message: $this->response['message'] ?? '',
        );
    }

    private function sendPostRequest(): void
    {
        try {
            $guzzleResponse = $this->client->request('POST', $this->url, [
                'headers' => $this->headers,
                'form_params' => $this->requestParams,
            ]);

            $this->response = json_decode($guzzleResponse->getBody(), true);
        } catch (TransferException $e) {
            throw new TransferException($e->getMessage());
        } catch (GuzzleException $e) {
            info($e->getMessage(), $e->getTrace());
        }
    }

    private function sendGetRequest(): void
    {
        try {
            $guzzleResponse = $this->client->request('GET', $this->url, [
                'headers' => $this->headers,
                'query' => $this->requestParams,
            ]);

            $this->response = json_decode($guzzleResponse->getBody(), true);
        } catch (TransferException $e) {
            throw new TransferException($e->getMessage());
        } catch (GuzzleException $e) {
            info($e->getMessage(), $e->getTrace());
        }
    }
}
