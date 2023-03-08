<?php

namespace App\Mail;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
class QuestionnaireEmail extends Mailable
{
    use Queueable, SerializesModels;

 public $reservation;
    public $leyend;
    /**
     * Create a new message instance.
     */
    
    public function __construct( $reservation)
    {
        $this->reservation = $reservation;

        $this->leyend = match($reservation->lang){
            'es' =>  'Nos gustaría saber su opinión',
            'en' => 'We would like to know your opinion',
            'fr' => 'Nous aimerions connaître votre avis',
            default => 'We would like to know your opinion'
        };
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $envelope = new Envelope(
            subject: $this->leyend
        );
        if(isset($this->reservation->room->hotel->email) && isset($this->reservation->room->hotel->name)){
            $envelope->from($this->reservation->room->hotel->email, $this->reservation->room->hotel->name);
        }

        return $envelope;
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.questionnaireEmail',
            with: [
                'reservation' => $this->reservation
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
