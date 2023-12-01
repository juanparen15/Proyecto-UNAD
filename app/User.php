<?php

namespace App;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;

    // public function hasRole()
    // {
    //     return $this->role === 'Admin';
    // }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'apellido',
        'telefono',
        'documento',
        'areas_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    // Relacion Uno a Muchos (Inversa)
    public function area()
    {
        return $this->belongsTo(Area::class, 'areas_id');
    }
}


// class User extends Model implements MustVerifyEmail
// {
//     use Notifiable;

//     // ...

//     protected $fillable = [

//         'name',
//         'email',
//         'password',
//         'apellido',
//         'telefono',
//         'documento',
//         'areas_id'
//     ];

//     //Relacion Uno a Muchos (Inversa)
//     public function area()
//     {
//         return $this->belongsTo(Area::class);
//     }

//     public function hasVerifiedEmail()
//     {
//         return $this->email_verified_at !== null;
//     }

//     public function markEmailAsVerified()
//     {
//         $this->email_verified_at = $this->freshTimestamp();
//         $this->save();
//     }

//     public function sendEmailVerificationNotification()
//     {
//         // Aquí puedes enviar el correo electrónico de verificación
//     }

//     public function getEmailForVerification()
//     {
//         return $this->email;
//     }

//         /**
//      * The attributes that should be hidden for arrays.
//      *
//      * @var array
//      */
//     protected $hidden = [
//         'password', 'remember_token'
//     ];

//     /**
//      * The attributes that should be cast to native types.
//      *
//      * @var array
//      */
//     protected $casts = [
//         'email_verified_at' => 'datetime'
//     ];
// }
