<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Tender;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class TenderService
{
    /**
     * Upload tender attachments and save their records.
     * Handles both direct UploadedFile objects and pre-uploaded file arrays.
     */
    public function uploadAttachments(Tender $tender, array $attachments)
    {
        $attachmentRecords = [];

        foreach ($attachments as $attachment) {
            // Case 1: Direct file upload via multipart/form-data
            if ($attachment instanceof UploadedFile) {
                $path = $attachment->store('tenders/attachments', 'public_uploads');
                
                $attachmentRecords[] = [
                    'file_path' => $path,
                    'file_name' => $attachment->getClientOriginalName(),
                    'file_type' => $attachment->getClientMimeType(),
                    'file_size' => $attachment->getSize(),
                ];
            } 
        }

        return $tender->attachments()->createMany($attachmentRecords);
    }
}