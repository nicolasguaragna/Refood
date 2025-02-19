<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
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
            ->subject('Estado de Rescate Actualizado')
            ->greeting('Hola ' . $notifiable->name . ',')
            ->line('El estado de tu solicitud de rescate ha sido actualizado a: ' . $this->rescue->status)
            ->action('Ver detalles', url('/profile/services'))
            ->line('Gracias por usar Refood.');
    }

    public function toArray($notifiable)
    {
        return [
            'rescue_id' => $this->rescue->id,
            'status' => $this->rescue->status,
        ];
    }
}
