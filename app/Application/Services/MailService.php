<?php

namespace App\Application\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
use Exception;

class MailService
{
    /**
     * Envía un correo con plantilla Blade
     *
     * @param string|array $to Destinatario(s)
     * @param string $subject Asunto del correo
     * @param string $view Nombre de la vista Blade (ej: 'emails.welcome')
     * @param array $data Datos para pasar a la vista
     * @param array|null $attachments Archivos adjuntos ['path' => 'nombre']
     * @param string|array|null $cc Copia
     * @param string|array|null $bcc Copia oculta
     * @return bool
     */
    public function sendWithTemplate(
        string|array $to,
        string $subject,
        string $view,
        array $data = [],
        ?array $attachments = null,
        string|array|null $cc = null,
        string|array|null $bcc = null
    ): bool {
        try {
            Mail::send($view, $data, function (Message $message) use ($to, $subject, $attachments, $cc, $bcc) {
                $message->to($to)
                    ->subject($subject);

                if ($cc) {
                    $message->cc($cc);
                }

                if ($bcc) {
                    $message->bcc($bcc);
                }

                if ($attachments) {
                    foreach ($attachments as $path => $name) {
                        if (is_numeric($path)) {
                            $message->attach($name);
                        } else {
                            $message->attach($path, ['as' => $name]);
                        }
                    }
                }
            });

            return true;
        } catch (Exception $e) {
            report($e);
            return false;
        }
    }

    /**
     * Envía un correo sin plantilla (HTML directo)
     *
     * @param string|array $to Destinatario(s)
     * @param string $subject Asunto del correo
     * @param string $htmlContent Contenido HTML del correo
     * @param array|null $attachments Archivos adjuntos
     * @param string|array|null $cc Copia
     * @param string|array|null $bcc Copia oculta
     * @return bool
     */
    public function sendWithoutTemplate(
        string|array $to,
        string $subject,
        string $htmlContent,
        ?array $attachments = null,
        string|array|null $cc = null,
        string|array|null $bcc = null
    ): bool {
        try {
            Mail::html($htmlContent, function (Message $message) use ($to, $subject, $attachments, $cc, $bcc) {
                $message->to($to)
                    ->subject($subject);

                if ($cc) {
                    $message->cc($cc);
                }

                if ($bcc) {
                    $message->bcc($bcc);
                }

                if ($attachments) {
                    foreach ($attachments as $path => $name) {
                        if (is_numeric($path)) {
                            $message->attach($name);
                        } else {
                            $message->attach($path, ['as' => $name]);
                        }
                    }
                }
            });

            return true;
        } catch (Exception $e) {
            report($e);
            return false;
        }
    }

    /**
     * Envía un correo de texto plano
     *
     * @param string|array $to Destinatario(s)
     * @param string $subject Asunto del correo
     * @param string $textContent Contenido de texto plano
     * @return bool
     */
    public function sendPlainText(
        string|array $to,
        string $subject,
        string $textContent
    ): bool {
        try {
            Mail::raw($textContent, function (Message $message) use ($to, $subject) {
                $message->to($to)
                    ->subject($subject);
            });

            return true;
        } catch (Exception $e) {
            report($e);
            return false;
        }
    }

    /**
     * Envía correos en cola (asíncrono)
     *
     * @param string|array $to Destinatario(s)
     * @param string $subject Asunto
     * @param string $view Vista Blade
     * @param array $data Datos
     * @return bool
     */
    public function sendQueued(
        string|array $to,
        string $subject,
        string $view,
        array $data = []
    ): bool {
        try {
            Mail::queue($view, $data, function (Message $message) use ($to, $subject) {
                $message->to($to)
                    ->subject($subject);
            });

            return true;
        } catch (Exception $e) {
            report($e);
            return false;
        }
    }

    public function sendWelcomeEmail(
        string $email,
        string $name,
        ?string $discountCode = 'BIENVENIDO15'
    ): bool {
        $data = [
            'name' => $name,
            'shopUrl' => url('/tienda'),
            'discountCode' => $discountCode,
            'facebookUrl' => config('social.facebook', '#'),
            'instagramUrl' => config('social.instagram', '#'),
            'whatsappUrl' => config('social.whatsapp', '#'),
            'unsubscribeUrl' => url('/unsubscribe'),
            'preferencesUrl' => url('/email-preferences'),
            'address' => config('company.address', 'Santiago, Chile'),
        ];

        return $this->sendWithTemplate(
            to: $email,
            subject: '🌿 ¡Bienvenido a ' . config('app.name') . '!',
            view: 'emails.welcome',
            data: $data
        );
    }
}

/**
 * EJEMPLOS DE USO:
 * 
 * // 1. Con plantilla Blade
 * $mailService = new MailService();
 * $mailService->sendWithTemplate(
 *     to: 'usuario@ejemplo.com',
 *     subject: 'Bienvenido a nuestra plataforma',
 *     view: 'emails.welcome',
 *     data: ['name' => 'Juan', 'url' => 'https://ejemplo.com']
 * );
 * 
 * // 2. Sin plantilla (HTML directo)
 * $mailService->sendWithoutTemplate(
 *     to: 'usuario@ejemplo.com',
 *     subject: 'Notificación importante',
 *     htmlContent: '<h1>Hola</h1><p>Este es un correo de prueba</p>'
 * );
 * 
 * // 3. Con múltiples destinatarios y archivos adjuntos
 * $mailService->sendWithTemplate(
 *     to: ['user1@ejemplo.com', 'user2@ejemplo.com'],
 *     subject: 'Factura mensual',
 *     view: 'emails.invoice',
 *     data: ['amount' => 100],
 *     attachments: ['/path/to/invoice.pdf' => 'factura.pdf'],
 *     cc: 'admin@ejemplo.com'
 * );
 * 
 * // 4. Texto plano
 * $mailService->sendPlainText(
 *     to: 'usuario@ejemplo.com',
 *     subject: 'Mensaje simple',
 *     textContent: 'Este es un mensaje de texto plano'
 * );
 * 
 * // 5. Envío en cola (asíncrono)
 * $mailService->sendQueued(
 *     to: 'usuario@ejemplo.com',
 *     subject: 'Newsletter semanal',
 *     view: 'emails.newsletter',
 *     data: ['articles' => $articles]
 * );
 */