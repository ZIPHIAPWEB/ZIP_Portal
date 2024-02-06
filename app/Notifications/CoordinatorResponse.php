<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CoordinatorResponse extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $data;

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
        switch ($this->data['status']) {
            case 'Confirmed':
                return (new MailMessage())
                    ->from('system@ziptravel.com.ph', 'ZIP Travel PH')
                    ->subject('E-mail Notification')
                    ->markdown('mail.status.confirmed', ['data' => $this->data]);
                break;
            case 'Hired':
                return (new MailMessage())
                        ->from('system@ziptravel.com.ph', 'ZIP Travel PH')
                        ->subject('E-mail Notification')
                        ->markdown('mail.status.hired', ['data' => $this->data]);
                break;
            case 'For Visa Interview':
                return (new MailMessage())
                        ->from('system@ziptravel.com.ph', 'ZIP Travel PH')
                        ->subject('E-mail Notification')
                        ->markdown('mail.status.visa_interview', ['data' => $this->data]);
                break;
            case 'For PDOS & CFO':
                return (new MailMessage())
                        ->from('system@ziptravel.com.ph', 'ZIP Travel PH')
                        ->subject('E-mail Notification')
                        ->markdown('mail.status.for_pdos_cfo', ['data' => $this->data]);
                break;
            case 'Program Proper':
                return (new MailMessage())
                        ->from('system@ziptravel.com.ph', 'ZIP Travel PH')
                        ->subject('E-mail Notification')
                        ->markdown('mail.status.program_proper', ['data' => $this->data]);
                break;
        }
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
