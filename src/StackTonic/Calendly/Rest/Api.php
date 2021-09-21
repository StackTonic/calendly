<?php

namespace StackTonic\Calendly\Rest;

use StackTonic\Calendly\Http\Response;
use StackTonic\Calendly\Exceptions\RestException;
use StackTonic\Calendly\Exceptions\CalendlyException;

class Api {
    protected $client;
    /**
     * @var string
     */
    private $baseUrl;

    public function __construct(Client $client) {
        $this->client = $client;
        $this->baseUrl = 'https://api.calendly.com';
    }

    public function fetch(string $method, string $uri,
                          array $params = [], array $data = [], array $headers = [],
                          string $username = null, string $password = null,
                          int $timeout = null) {
        $response = $this->request(
            $method,
            $uri,
            $params,
            $data,
            $headers,
            $username,
            $password,
            $timeout
        );

        // 3XX response codes are allowed here to allow for 307 redirect from Deactivations API.
        if ($response->getStatusCode() < 200 || $response->getStatusCode() >= 400) {
            throw $this->exception($response, 'Unable to fetch record');
        }

        return $response->getContent();
    }


    /**
     * Create the best possible exception for the response.
     *
     * Attempts to parse the response for Twilio Standard error messages and use
     * those to populate the exception, falls back to generic error message and
     * HTTP status code.
     *
     * @param Response $response Error response
     * @param string $header Header for exception message
     * @return CalendlyException
     */
    protected function exception(Response $response, string $header): CalendlyException {
        $message = '[HTTP ' . $response->getStatusCode() . '] ' . $header;

        $content = $response->getContent();
        if (\is_array($content)) {
            $message .= isset($content['message']) ? ': ' . $content['message'] : '';
            $code = isset($content['code']) ? $content['code'] : $response->getStatusCode();
            $moreInfo = $content['more_info'] ?? '';
            $details = $content['details'] ?? [];
            return new RestException($message, $code, $response->getStatusCode(), $moreInfo, $details);
        }

        return new RestException($message, $response->getStatusCode(), $response->getStatusCode());
    }
    public function request(string $method, string $uri,
                            array $params = [], array $data = [], array $headers = [],
                            string $user = null, string $password = null,
                            int $timeout = null): Response {
        $url = $this->absoluteUrl($uri);
        return $this->client->request(
            $method,
            $url,
            $params,
            $data,
            $headers,
            $user,
            $password,
            $timeout
        );
    }

    /**
     * Translate version relative URIs into absolute URLs
     *
     * @param string $uri Version relative URI
     * @return string Absolute URL for this domain
     */
    public function absoluteUrl(string $uri): string {
        return \implode('/', [\trim($this->baseUrl, '/'), \trim($uri, '/')]);
    }
    public function getClient(): Client {
        return $this->client;
    }

}
