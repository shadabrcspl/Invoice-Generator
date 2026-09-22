<?php

namespace App\Traits;

trait ConvertsImageToBase64
{
    /**
     * Convert a storage-disk relative path to a base64 data URI for dompdf.
     * Supports jpg, jpeg, png, gif, webp, svg.
     */
    protected function imageToBase64(?string $storagePath): ?string
    {
        if (!$storagePath) {
            return null;
        }

        $absPath = storage_path('app/public/' . $storagePath);

        if (!file_exists($absPath) || !is_readable($absPath)) {
            return null;
        }

        $mimeMap = [
            'jpg'  => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png'  => 'image/png',
            'gif'  => 'image/gif',
            'webp' => 'image/webp',
            'svg'  => 'image/svg+xml',
        ];

        $ext  = strtolower(pathinfo($absPath, PATHINFO_EXTENSION));
        $mime = $mimeMap[$ext] ?? 'image/png';

        $data = base64_encode(file_get_contents($absPath));

        return "data:{$mime};base64,{$data}";
    }
}
