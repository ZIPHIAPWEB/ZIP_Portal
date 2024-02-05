<?php

namespace App\Notifications;

use App\Repositories\Student\StudentRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class VerifiedDepositSlipNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $id;
    public function __construct($id)
    {
        $this->id = $id;
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
    public function toMail($notifiable, StudentRepository $studentRepository)
    {
        $student = $studentRepository->findOneBy(['user_id' => $this->id]);

        return (new MailMessage())
                    ->line('The Accounting has verified the payslip of ' . $student->first_name . ' ' . $student->last_name)
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
