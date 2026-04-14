<?php

namespace App\Services;

use App\Models\Tender;
use App\Models\TenderInquiry;
use App\Models\User;
use App\Notifications\InquiryAnsweredNotification;

class TenderInquiryService
{
    public function submit(Tender $tender, User $user, string $question): TenderInquiry
    {
        return TenderInquiry::create([
            'tender_id' => $tender->id,
            'user_id' => $user->id,
            'company_id' => $user->company()->id,
            'question' => $question,
        ]);
    }

    public function reply(TenderInquiry $inquiry, string $answer): void
    {
        $inquiry->update([
            'answer' => $answer,
            'answered_by' => auth()->id(),
            'answered_at' => now(),
        ]);

        $inquiry->user->notify(new InquiryAnsweredNotification($inquiry));
    }
}
