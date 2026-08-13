<?php

namespace App\Services;

use Cloudinary\Cloudinary;
use Cloudinary\Api\Upload\UploadApi;
use Illuminate\Http\UploadedFile;

class CloudinaryService
{
    protected $cloudinary;
    protected $enabled;

    public function __construct()
    {
        // Check if Cloudinary is configured
        $this->enabled = config('cloudinary.cloud_name') && 
                        config('cloudinary.api_key') && 
                        config('cloudinary.api_secret');

        if ($this->enabled) {
            try {
                $this->cloudinary = new Cloudinary([
                    'cloud' => [
                        'cloud_name' => config('cloudinary.cloud_name'),
                        'api_key' => config('cloudinary.api_key'),
                        'api_secret' => config('cloudinary.api_secret'),
                    ],
                    'url' => [
                        'secure' => config('cloudinary.secure', true)
                    ]
                ]);
            } catch (\Exception $e) {
                $this->enabled = false;
                \Log::error('Cloudinary initialization failed: ' . $e->getMessage());
            }
        }
    }

    /**
     * Check if Cloudinary is enabled and configured
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * Upload file ke Cloudinary
     * 
     * @param UploadedFile $file
     * @param string $folder
     * @param array $options
     * @return array
     */
    public function upload(UploadedFile $file, string $folder = 'sira', array $options = []): array
    {
        if (!$this->enabled) {
            return [
                'success' => false,
                'error' => 'Cloudinary belum dikonfigurasi. Silakan hubungi administrator.'
            ];
        }

        try {
            $defaultOptions = [
                'folder' => $folder,
                'resource_type' => 'auto',
                'transformation' => [
                    'quality' => 'auto:good',
                    'fetch_format' => 'auto'
                ]
            ];

            $uploadOptions = array_merge($defaultOptions, $options);

            $result = $this->cloudinary->uploadApi()->upload(
                $file->getRealPath(),
                $uploadOptions
            );

            return [
                'success' => true,
                'url' => $result['secure_url'],
                'public_id' => $result['public_id'],
                'format' => $result['format'],
                'width' => $result['width'] ?? null,
                'height' => $result['height'] ?? null,
            ];
        } catch (\Exception $e) {
            \Log::error('Cloudinary upload failed: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => 'Gagal upload gambar: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Hapus file dari Cloudinary
     * 
     * @param string $publicId
     * @return array
     */
    public function delete(string $publicId): array
    {
        if (!$this->enabled) {
            return [
                'success' => false,
                'error' => 'Cloudinary not configured'
            ];
        }

        try {
            $result = $this->cloudinary->uploadApi()->destroy($publicId);
            
            return [
                'success' => $result['result'] === 'ok',
                'result' => $result['result']
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Get optimized image URL
     * 
     * @param string $publicId
     * @param array $transformation
     * @return string
     */
    public function getUrl(string $publicId, array $transformation = []): string
    {
        if (!$this->enabled) {
            return '';
        }

        try {
            return $this->cloudinary->image($publicId)
                ->resize(\Cloudinary\Transformation\Resize::scale()->width(500))
                ->delivery(\Cloudinary\Transformation\Delivery::quality('auto'))
                ->delivery(\Cloudinary\Transformation\Delivery::format('auto'))
                ->toUrl();
        } catch (\Exception $e) {
            return '';
        }
    }
}
