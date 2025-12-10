<?php

namespace App\Notifications;

use App\Models\Attempt;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AttemptInteracted extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $user, Attempt $attempt, string $action, $comment)
    {
        $this->personWhoInteracted = $user;
        $this->attemptInteracted = $attempt;
        $this->action = $action;
        if ($this->action == 'comment') {
            $this->comment = $comment;
        }
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // Will be mailed to User
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Someone has interacted with your Attempt')
            ->greeting('Hello!')
            ->lineIf($this->action == 'like', "You are receiving this email because {$this->personWhoInteracted->name} has liked your attempt.")
            ->lineIf($this->action == 'comment', "You are receiving this email because {$this->personWhoInteracted->name} has commented on your attempt.")
            ->action('View your Attempt', url("/attempts/{$this->attemptInteracted->id}"))
            ->line('Thank you for using my application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
