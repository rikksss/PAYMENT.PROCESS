<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;  // Add this to extend Authenticatable
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable  // Extending Authenticatable to integrate with authentication system
{
    use HasFactory, Notifiable; // Use Notifiable for notifications (optional)

    protected $table = 'users';

    protected $fillable = [
        'username',
        'email',
        'contact_number',
        'address',
        'password',
        'user_type',
        'user_profile',
    ];

    // Automatically handle timestamps (created_at and updated_at)
    public $timestamps = true;

    // Optionally, define hidden attributes like password and remember_token
    protected $hidden = [
        'password', 
        'remember_token',
    ];

    // Optionally, define cast attributes for certain data types
    protected $casts = [
        'email_verified_at' => 'datetime', // If you have an email_verified_at field
    ];

    // If needed, you can define a method to get the user's full name (or any other helper methods)
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name; // Example, if first_name & last_name exist
    }

    public function products()
{
    return $this->hasMany(Product::class, 'user_id');
}

}