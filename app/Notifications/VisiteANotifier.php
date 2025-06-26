<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Visite;

class VisiteANotifier extends Notification
{
    use Queueable;

    public $visite;

    /**
     * Create a new notification instance.
     */
    public function __construct(Visite $visite)
    {
        $this->visite = $visite;
    }

    /**
     * Les canaux de notification.
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail']; // Tu peux mettre juste ['database'] si tu veux désactiver l'email
    }

    /**
     * Notification par mail.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Nouvelle visite à confirmer')
            ->greeting('Bonjour ' . $notifiable->nom)
            ->line("Un visiteur a été enregistré pour vous.")
            ->action('Voir la visite', url('/locataire/visites/' . $this->visite->id))
            ->line('Merci d’utiliser notre application.');
    }

    /**
     * Notification en base de données.
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'message' => 'Vous avez une nouvelle visite à confirmer.',
            'visite_id' => $this->visite->id,
            'url' => url('/locataire/visites/' . $this->visite->id),
        ];
    }
}
