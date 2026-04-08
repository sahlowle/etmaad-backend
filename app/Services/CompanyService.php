<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Company;
use App\Models\CompanyDocument;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CompanyService
{
    public function uploadDocuments(Company $company, array $documents)
    {
        $attachmentRecords = [];

        foreach ($documents as $document) {
            $file = $document['file'] ?? null;

            if ($file instanceof UploadedFile) {
                // Case 1: Direct upload (sync usage)
                $path = $file->store('companies/documents', 'public_uploads');

            } elseif (! empty($document['temp_path'])) {
                // Case 2: From queue job — move from temp to permanent
                $permanentPath = 'companies/documents/'.basename($document['temp_path']);
                Storage::disk('public_uploads')->writeStream(
                    $permanentPath,
                    Storage::disk('local')->readStream($document['temp_path'])
                );
                Storage::disk('local')->delete($document['temp_path']);
                $path = $permanentPath;

            } else {
                continue; // skip invalid entries
            }

            $attachmentRecords[] = [
                'file_path' => $path,
                'file_name' => $document['file_name'],
                'issue_date' => $document['issue_date'],
                'expiry_date' => $document['expiry_date'],
            ];
        }

        return $company->documents()->createMany($attachmentRecords);
    }

    public function deleteDocuments(Company $company, array $documentsIds): void
    {
        DB::transaction(function () use ($company, $documentsIds) {
            $company->documents()->whereIn('id', $documentsIds)->each(function (CompanyDocument $document) {
                Storage::disk('public_uploads')->delete($document->file_path);
                $document->delete();
            });
        });
    }
}
