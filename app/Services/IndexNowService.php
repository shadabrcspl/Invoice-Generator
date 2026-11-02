<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class IndexNowService
{
    protected string $key;
    protected string $host;
    protected string $endpoint;

    public function __construct()
    {
        $this->key = config('services.indexnow.key', env('INDEXNOW_KEY', '3edd1a85498f32f18ebe43031dbef1d4'));
        $this->host = config('services.indexnow.host', env('INDEXNOW_HOST', 'invoice.codxpert.com'));
        $this->endpoint = config('services.indexnow.endpoint', 'https://api.indexnow.org/indexnow');
    }

    /**
     * Submit a single URL to IndexNow.
     */
    public function submitUrl(string $url): array
    {
        return $this->submitUrls([$url]);
    }

    /**
     * Submit a batch of URLs to IndexNow.
     */
    public function submitUrls(array $urls): array
    {
        $urls = array_values(array_unique(array_filter($urls)));

        if (empty($urls)) {
            return [
                'success' => false,
                'status'  => 400,
                'message' => 'No URLs provided for IndexNow submission.',
            ];
        }

        // Limit to 10,000 per request as per IndexNow API spec
        $urls = array_slice($urls, 0, 10000);

        $payload = [
            'host'        => $this->host,
            'key'         => $this->key,
            'keyLocation' => "https://{$this->host}/{$this->key}.txt",
            'urlList'     => $urls,
        ];

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json; charset=utf-8',
            ])->timeout(15)->post($this->endpoint, $payload);

            $status = $response->status();
            $body = $response->body();

            $success = in_array($status, [200, 202]);

            if ($success) {
                Log::info("IndexNow: Successfully submitted " . count($urls) . " URLs to Bing/Yahoo/IndexNow. Status: {$status}");
            } else {
                Log::warning("IndexNow response: HTTP {$status} from {$this->endpoint}: {$body}");
            }

            return [
                'success' => $success,
                'status'  => $status,
                'count'   => count($urls),
                'body'    => $body,
            ];
        } catch (\Exception $e) {
            Log::error("IndexNow submission exception: " . $e->getMessage());
            return [
                'success' => false,
                'status'  => 500,
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * Extract and submit all URLs from public/sitemap.xml
     */
    public function submitSitemap(): array
    {
        $sitemapPath = public_path('sitemap.xml');
        if (!File::exists($sitemapPath)) {
            return [
                'success' => false,
                'message' => 'sitemap.xml not found in public directory.',
            ];
        }

        $xml = simplexml_load_file($sitemapPath);
        if ($xml === false) {
            return [
                'success' => false,
                'message' => 'Failed to parse sitemap.xml.',
            ];
        }

        $urls = [];
        foreach ($xml->url as $urlElement) {
            if (!empty($urlElement->loc)) {
                $urls[] = (string) $urlElement->loc;
            }
        }

        return $this->submitUrls($urls);
    }

    /**
     * Get the active IndexNow API key.
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * Get the host domain.
     */
    public function getHost(): string
    {
        return $this->host;
    }
}
