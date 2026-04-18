<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

final class FileUploadService
{
    public function __construct(
        private readonly string $disk = 'public_uploads',
    ) {}

    public function store(UploadedFile $file, string $path): string
    {
        return $file->store($path, $this->disk);
    }

    public function storeMany(array $files, string $path): array
    {
        return array_map(fn (UploadedFile $file) => $this->store($file, $path), $files);
    }

    public function delete(string|array $paths): void
    {
        Storage::disk($this->disk)->delete((array) $paths);
    }

    public function exists(string $path): bool
    {
        return Storage::disk($this->disk)->exists($path);
    }

    public function url(string $path): string
    {
        return Storage::disk($this->disk)->url($path);
    }
}
