<?php

namespace Corbpie\HostHatchAPI;

class HostHatch
{
    private const API_URL = 'https://cloud.hosthatch.com/api/v1';//URL for HostHatch API

    private const API_KEY = '';//HostHatch API key

    protected string $api_key;

    public bool $debug_request = false;

    public function __construct()
    {
        try {

            if ($this->constApiKeySet()) {
                $this->api_key = self::API_KEY;
            }

        } catch (\Exception $exception) {//display error message
            echo $exception->getMessage();
        }
    }

    protected function constApiKeySet(): bool
    {
        return !(!defined("self::API_KEY") || empty(self::API_KEY));
    }

    public function setApiKey(string $api_key = ''): void
    {
        try {

            if (!isset($api_key) || trim($api_key) === '') {
                throw new \RuntimeException('$api_key cannot be empty');
            }

            $this->api_key = $api_key;

        } catch (\Exception $exception) {//display error message
            echo $exception->getMessage();
        }
    }

    protected function ApiCall(string $method, string $url, array $params = []): array
    {
        if (!isset($this->api_key) || $this->api_key === '') {
            return [
                'http_code' => 500,
                'response' => 'Please set your api key either with setApiKey() or the const API_KEY'
            ];
        }

        $curl = curl_init();
        if ($method === "GET") {//GET request
            if (!empty($params)) {
                $url = sprintf("%s?%s", $url, http_build_query($params));
            }
        } elseif ($method === "POST") {//POST request
            curl_setopt($curl, CURLOPT_POST, 1);
            if (!empty($params)) {
                $data = json_encode($params);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
        } elseif ($method === "PUT") {//PUT request
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            $data = json_encode($params);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }

        curl_setopt($curl, CURLOPT_URL, self::API_URL . $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Accept: application/json", "Authorization: Bearer $this->api_key", "Content-Type: application/json"));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 0);

        $result = curl_exec($curl);
        $responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $debug_info = curl_getinfo($curl);
        curl_close($curl);

        if ($this->debug_request) {
            return $debug_info;
        }

        if ($responseCode === 204) {
            return [
                'http_code' => $responseCode,
                'response' => json_decode($result, true),
            ];
        }

        if ($responseCode >= 200 && $responseCode < 300) {
            return json_decode($result, true) ?? [];
        }

        return [
            'http_code' => $responseCode,
            'response' => json_decode($result, true),
        ];
    }

    public function getProducts(): array
    {
        return $this->ApiCall("GET", "/products");
    }

    public function getServers(): array
    {
        return $this->ApiCall("GET", "/servers");
    }

    public function getServer(int $server): array
    {
        return $this->ApiCall("GET", "/servers/$server");
    }

    public function getServerStatus(int $server): array
    {
        return $this->ApiCall("GET", "/servers/$server/status");
    }

    public function deployServer(array $parameters): array
    {
        return $this->ApiCall("POST", "/deploy", $parameters);
    }

    public function bootServer(int $server): array
    {
        return $this->ApiCall("POST", "/servers/$server/boot");
    }

    public function shutdownServer(int $server): array
    {
        return $this->ApiCall("POST", "/servers/$server/shutdown");
    }

    public function rebootServer(int $server): array
    {
        return $this->ApiCall("POST", "/servers/$server/reboot");
    }

    public function upgradeServer(int $server): array
    {
        return $this->ApiCall("PUT", "/servers/$server/upgrade");
    }

    public function cancelServer(int $server): array
    {
        return $this->ApiCall("PUT", "/servers/$server/cancel");
    }

}