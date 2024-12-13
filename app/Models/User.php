<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use App\Mail\TwoFactorCodeMail;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public function generateTwoFactorCode()
    {
        if (!$this->two_factor_code || $this->two_factor_expires_at <= now()) {
            $this->two_factor_code = rand(100000, 999999);
            $this->two_factor_expires_at = now()->addMinutes(10);
            $this->save();

            // Envoyer l'e-mail uniquement après génération
            Mail::to($this->email)->send(new TwoFactorCodeMail($this->two_factor_code));
        }
    }



    public function resetTwoFactorCode()
    {
        $this->two_factor_code = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
