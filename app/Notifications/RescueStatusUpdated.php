<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class RescueStatusUpdated extends Notification
{
    use Queueable;

    protected $rescue;

    public function __construct($rescue)
    {
        $this->rescue = $rescue;
    }

    public function via($notifiable)
    {
        return ['mail']; // Puedes agregar 'database' o 'whatsapp' si integras Twilio o similar
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Estado de tu rescate actualizado')
            ->line("El estado de tu rescate ha cambiado a: {$this->rescue->status}.")
            ->action('Ver en la plataforma', url('/profile/services'))
            ->line('Gracias por usar Refood.');
    }
}
