<?php

namespace App\Notifications;

use App\Models\TenderInquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InquiryAnsweredNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public TenderInquiry $inquiry) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(): MailMessage
    {
        return (new MailMessage)
            ->subject('Your inquiry has been answered')
            ->line("Your inquiry on tender: {$this->inquiry->tender->title}")
            ->line("Question: {$this->inquiry->question}")
            ->line("Answer: {$this->inquiry->answer}");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'inquiry_id' => $this->inquiry->id,
            'tender_id' => $this->inquiry->tender_id,
            'answer' => $this->inquiry->answer,
        ];
    }
}
