<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Import this
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable // Extend from Authenticatable
{
    use Notifiable, HasFactory;
    protected $guard = 'admin';


    // Your model properties and methods

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

}
