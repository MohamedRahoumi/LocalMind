<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

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

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

   
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function hasFavorited($question)
    {
        $questionId = $question instanceof Question ? $question->id : $question;
        return $this->favorites()->where('question_id', $questionId)->exists();
    }

    public function hasLiked($question)
    {
        $questionId = $question instanceof Question ? $question->id : $question;
        return $this->likes()->where('question_id', $questionId)->exists();
    }
}