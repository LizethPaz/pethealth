<?php

namespace App\Mail;

use App\Models\Cita;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CitaConfirmacionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $cita;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Cita $cita)
    {
        $this->cita = $cita;
        // Cargar relaciones necesarias para el correo
        $this->cita->load(['dueno', 'mascota', 'veterinario']);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Confirmación de Cita - PetHealth')
                    ->view('emails.cita-confirmacion');
    }
}