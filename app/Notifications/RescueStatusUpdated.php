<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RescueStatusUpdated extends Notification
{
    use Queueable;

    /**
     * Instancia del rescate cuyo estado ha cambiado.
     *
     * @var \App\Models\RescueRequest
     */
    protected $rescue;

    /**
     * Constructor de la notificación.
     *
     * @param \App\Models\RescueRequest $rescue
     */
    public function __construct($rescue)
    {
        $this->rescue = $rescue;
    }

    /**
     * Defino los canales de entrega de la notificación.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database']; 
    }

    /**
     * Construyo el mensaje de correo electrónico.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Estado de Rescate Actualizado')
            ->greeting('Hola ' . $notifiable->name . ',')
            ->line('El estado de tu solicitud de rescate ha sido actualizado a: ' . $this->rescue->status)
            ->action('Ver detalles', url('/profile/services'))
            ->line('Gracias por usar Refood.');
    }

    /**
     * Obtengo la representación de la notificación en una base de datos.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'rescue_id' => $this->rescue->id,
            'status' => $this->rescue->status,
            'message' => 'El estado de tu rescate ha cambiado a: ' . $this->rescue->status,
        ];
    }
}
