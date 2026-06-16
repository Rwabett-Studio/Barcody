<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

/**
 * Centralised, configuration-driven Chatberry / WhatsApp integration.
 * All endpoints, token and options come from config('services.chatberry'),
 * so nothing is hard-coded inside controllers.
 */
class WhatsappService
{
    protected array $cfg;
    protected Client $client;

    public function __construct()
    {
        $this->cfg = config('services.chatberry');

        $this->client = new Client([
            'timeout' => $this->cfg['timeout'] ?? 30,
            'verify'  => $this->cfg['verify_ssl'] ?? false,
        ]);
    }

    public function isConfigured(): bool
    {
        return !empty($this->cfg['token']);
    }

    protected function endpoint(string $path): string
    {
        return rtrim($this->cfg['base_url'], '/') . '/' . ltrim($path, '/');
    }

    protected function formatPhone(?string $phone): string
    {
        return preg_replace('/[^0-9]/', '', (string) $phone);
    }

    /**
     * Low-level POST helper. Returns ['success'=>bool, 'body'=>array, 'error'=>?string].
     */
    protected function post(string $path, array $payload): array
    {
        if (!$this->isConfigured()) {
            return ['success' => false, 'body' => [], 'error' => 'WhatsApp token not configured'];
        }

        try {
            $payload['token'] = $this->cfg['token'];

            $response = $this->client->post($this->endpoint($path), [
                'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
                'json'    => $payload,
            ]);

            $body = json_decode($response->getBody()->getContents(), true) ?: [];
            $ok = $response->getStatusCode() === 200 && (($body['status'] ?? null) === 'success' || !empty($body['message_id']));

            return ['success' => $ok, 'body' => $body, 'error' => $ok ? null : ($body['message'] ?? 'Unknown error')];
        } catch (\Throwable $e) {
            Log::error('Chatberry request failed', ['path' => $path, 'error' => $e->getMessage()]);
            return ['success' => false, 'body' => [], 'error' => $e->getMessage()];
        }
    }

    /**
     * Plain text (optionally with a media image url).
     */
    public function sendMessage(string $phone, string $message, ?string $mediaUrl = null): array
    {
        $payload = ['phone' => $this->formatPhone($phone), 'message' => $message];
        if ($mediaUrl) {
            $payload['media_url'] = $mediaUrl;
        }
        return $this->post('sendmessage', $payload);
    }

    /**
     * Approved WhatsApp template with optional header image + body params.
     */
    public function sendTemplate(string $phone, string $templateName, array $bodyParams = [], ?string $headerImage = null, ?string $language = null): array
    {
        $components = [];

        if ($headerImage) {
            $components[] = [
                'type' => 'header',
                'parameters' => [['type' => 'image', 'image' => ['link' => $headerImage]]],
            ];
        }

        if (!empty($bodyParams)) {
            $components[] = [
                'type' => 'body',
                'parameters' => array_map(fn ($t) => ['type' => 'text', 'text' => $t], $bodyParams),
            ];
        }

        return $this->post('sendtemplatemessage', [
            'phone'             => $this->formatPhone($phone),
            'template_name'     => $templateName,
            'template_language' => $language ?: ($this->cfg['template_language'] ?? 'ar'),
            'components'        => $components,
        ]);
    }

    /**
     * Interactive list message (e.g. choose number of guests).
     */
    public function sendList(string $phone, string $message, string $header, string $footer, string $buttonText, array $sections): array
    {
        return $this->post('sendmessage', [
            'phone'   => $this->formatPhone($phone),
            'message' => $message,
            'header'  => $header,
            'footer'  => $footer,
            'action'  => ['button' => $buttonText, 'sections' => $sections],
        ]);
    }

    /**
     * OTP: uses an approved template if configured, otherwise a plain message.
     */
    public function sendOtp(string $phone, string $otp, int $expiryMinutes = 10): array
    {
        if (!empty($this->cfg['otp_template'])) {
            return $this->sendTemplate($phone, $this->cfg['otp_template'], [(string) $otp]);
        }

        return $this->sendMessage($phone, "Your Barcody OTP code is: {$otp}\nValid for {$expiryMinutes} minutes.");
    }
}
