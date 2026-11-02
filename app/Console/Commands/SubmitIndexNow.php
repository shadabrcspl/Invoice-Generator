<?php

namespace App\Console\Commands;

use App\Services\IndexNowService;
use Illuminate\Console\Command;

class SubmitIndexNow extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seo:indexnow {urls?* : Optional list of specific URLs to index} {--sitemap : Extract and submit all URLs from sitemap.xml}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Submit URLs to Bing, Yahoo, Yandex, and Naver in real-time via IndexNow API';

    /**
     * Execute the console command.
     */
    public function handle(IndexNowService $service)
    {
        $this->info('Starting IndexNow submission for host: ' . $service->getHost());

        $urls = $this->argument('urls');

        if ($this->option('sitemap') || empty($urls)) {
            $this->info('Extracting all URLs from public/sitemap.xml...');
            $result = $service->submitSitemap();
        } else {
            $this->info('Submitting ' . count($urls) . ' specified URL(s)...');
            $result = $service->submitUrls($urls);
        }

        if ($result['success'] ?? false) {
            $this->info("✓ SUCCESS ({$result['status']}): {$result['count']} URL(s) submitted to IndexNow (Bing & Yahoo).");
            return 0;
        } else {
            $status = $result['status'] ?? 'Error';
            $msg = $result['body'] ?? $result['message'] ?? 'Unknown error';
            $this->error("✗ FAILED ({$status}): {$msg}");
            return 1;
        }
    }
}
