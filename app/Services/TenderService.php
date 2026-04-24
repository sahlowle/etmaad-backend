<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Tender;
use App\Models\TenderAttachment;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TenderService
{
    public function getAllTenders(Request $request)
    {
        return Tender::query()
            // ->with([
            //     'addressesAndDates', 'classification', 'boqs', 'attachments', 'news', 'evaluation',
            // ])
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->whereLike('name', "%{$request->search}%");
            })
            ->paginate(10);
    }

    public function underEvaluation(Request $request)
    {
        return Tender::query()
            ->underEvaluation()
            ->withCount('bids')
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->whereLike('name', "%{$request->search}%");
            })
            ->paginate(10);
    }

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

    public function deleteAttachment(Tender $tender, array $attachmentsIds): void
    {
        DB::transaction(function () use ($tender, $attachmentsIds) {
            $tender->attachments()->whereIn('id', $attachmentsIds)->each(function (TenderAttachment $attachment) {
                Storage::disk('public_uploads')->delete($attachment->file_path);
                $attachment->delete();
            });
        });
    }
}
