<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Admin extends Model
{
    use HasFactory;
    use notifiable;

    protected $table = 'admins';
    
    protected $guard ='admin';
    
    protected $fillable = ['name','email','passowrd'];

    protected $hidden = ['password'];
}
