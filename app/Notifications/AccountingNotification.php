<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Storage;

class AccountingNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Deposit Slip - ' . $this->data['full_name'])
                    ->greeting('Deposit Slip Details')
                    ->line('Name: ' . $this->data['full_name'])
                    ->line('Bank Code: ' . $this->data['payment']->bank_code)
                    ->line('Reference No.: ' . $this->data['payment']->reference_no)
                    ->line('Date: ' . $this->data['payment']->date_deposit)
                    ->line('Bank Account No.: ' . $this->data['payment']->bank_account_no)
                    ->line('Amount: ' . $this->data['payment']->amount)
                    ->action('View Deposit Slip', url('https://docs.google.com/gview?url='. Storage::disk('uploaded_files')->url($this->data['payment']->path) .'&embedded=true'))
                    ->action('Verify', route(''))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
