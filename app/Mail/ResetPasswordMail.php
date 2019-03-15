<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 15/03/19
 * Time: 14:48
 */

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $user = $this->data['user']['first_name'];
        $token = $this->data['token'];
        $address = 'no-reply@he4rt.com';
        $subject = 'Redefinição de senha da sua conta na He4rt Learning';
        $name = 'He4rt Learning';
        return $this->view('vendor.mail.auth.password-reset')
            ->from($address, $name)
            ->subject($subject)
            ->with([ 'name' => $user, 'token' => $token ]);
    }
}