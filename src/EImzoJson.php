<?php

namespace MrMusaev\EImzo;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\TransferException;
use MrMusaev\Eimzo\Exceptions\ParameterNotConfiguredException;
use MrMusaev\EImzo\Requests\AuthenticateRequest;
use MrMusaev\EImzo\Requests\DocumentRequest;
use MrMusaev\EImzo\Responses\AuthenticateResponse;
use MrMusaev\EImzo\Responses\ChallengeResponse;
use MrMusaev\EImzo\Responses\MobileAuthResponse;
use MrMusaev\EImzo\Responses\MobileSignResponse;
use MrMusaev\EImzo\Responses\MobileStatusResponse;
use MrMusaev\EImzo\Responses\MobileVerifyResponse;
use MrMusaev\EImzo\Responses\Pkcs7Info;
use MrMusaev\EImzo\Responses\SubjectCertificateInfo;
use MrMusaev\EImzo\Responses\TimestampedDocumentResponse;
use MrMusaev\EImzo\Responses\VerifyAttachedResponse;

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

    public function frontendChallenge(): ChallengeResponse
    {
        $this->url = '/frontend/challenge';

        $this->sendGetRequest();

        return new ChallengeResponse(
            status: $this->response['status'] ?? 0,
            challenge: $this->response['challenge'] ?? '',
            ttl: $this->response['ttl'] ?? 0,
            message: $this->response['message'] ?? '',
        );
    }

    public function backendAuth(DocumentRequest $request): AuthenticateResponse
    {
        $this->url = '/backend/auth';

        $this->headers = [
            'X-Real-IP' => $request->realIP,
            'Host' => $request->host,
        ];
        $this->requestParams = [$request->document];

        $this->sendPostRequest();

        return new AuthenticateResponse(
            status: $this->response['status'] ?? 0,
            message: $this->response['message'] ?? '',
            subjectCertificateInfo: SubjectCertificateInfo::from($this->response['subjectCertificateInfo'] ?? []),
        );
    }

    public function frontendTimestamp(DocumentRequest $request): TimestampedDocumentResponse
    {
        $this->url = '/frontend/timestamp/pkcs7';

        $this->headers = [
            'X-Real-IP' => $request->realIP,
            'Host' => $request->host,
        ];
        $this->requestParams = [$request->document];

        $this->sendPostRequest();

        $list = [];
        if (isset($this->response['timestampedSignerList']) && is_array($this->response['timestampedSignerList'])) {
            foreach ($this->response['timestampedSignerList'] as $item) {
                $list[] = SubjectCertificateInfo::from($item);
            }
        }

        return new TimestampedDocumentResponse(
            status: $this->response['status'] ?? 0,
            message: $this->response['message'] ?? '',
            timestampedSignerList: $list,
        );
    }

    public function backendVerifyAttached(DocumentRequest $request): VerifyAttachedResponse
    {
        $this->url = '/backend/pkcs7/verify/attached';

        $this->headers = [
            'X-Real-IP' => $request->realIP,
            'Host' => $request->host,
        ];
        $this->requestParams = [$request->document];

        $this->sendPostRequest();

        return new VerifyAttachedResponse(
            status: $this->response['status'] ?? 0,
            message: $this->response['message'] ?? '',
            pkcs7Info: Pkcs7Info::from($this->response['pkcs7Info'] ?? []),
        );
    }

    public function mobileAuth(): MobileAuthResponse
    {
        $this->url = '/frontend/mobile/auth';

        $this->sendPostRequest();

        return new MobileAuthResponse(
            status: $this->response['status'] ?? 0,
            siteId: $this->response['siteId'] ?? '',
            documentId: $this->response['documentId'] ?? '',
            challange: $this->response['challange'] ?? '',
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

    public function mobileAuthenticate(AuthenticateRequest $request): AuthenticateResponse
    {
        $this->url = '/backend/mobile/authenticate/' . $request->documentId;

        $this->headers = [
            'X-Real-IP' => $request->realIP,
            'Host' => $request->host,
        ];

        $this->sendGetRequest();

        return new AuthenticateResponse(
            status: $this->response['status'] ?? 0,
            message: $this->response['message'] ?? '',
            subjectCertificateInfo: SubjectCertificateInfo::from($this->response['subjectCertificateInfo'] ?? []),
        );
    }

    public function mobileSign(): MobileSignResponse
    {
        $this->url = '/frontend/mobile/sign';

        $this->sendPostRequest();

        return new MobileSignResponse(
            status: $this->response['status'] ?? 0,
            siteId: $this->response['siteId'] ?? '',
            documentId: $this->response['documentId'] ?? '',
            message: $this->response['message'] ?? '',
        );
    }

    public function mobileVerify(AuthenticateRequest $request, string $document): MobileVerifyResponse
    {
        $this->url = '/backend/mobile/verify/';

        $this->headers = [
            'X-Real-IP' => $request->realIP,
            'Host' => $request->host,
        ];

        $this->requestParams = [
            'documentId' => $request->documentId,
            'document' => $document,
        ];

        $this->sendPostRequest();

        return new MobileVerifyResponse(
            status: $this->response['status'] ?? 0,
            message: $this->response['message'] ?? '',
            subjectCertificateInfo: SubjectCertificateInfo::from($this->response['subjectCertificateInfo'] ?? []),
            verificationInfo: $this->response['verificationInfo'] ?? [],
            pkcs7Attached: $this->response['pkcs7Attached'] ?? '',
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
