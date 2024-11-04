<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Establece una relación uno a muchos con el modelo Idea.
     * Esto indica que un usuario puede tener múltiples ideas asociadas a su cuenta.
     * Cada idea que crea estará vinculada a este usuario.
     *
     * @return HasMany
     */    
    public function ideas(): HasMany
    {
        return $this->hasMany(Idea::class);
    }

    /**
     * Establece una relación muchos a muchos con el modelo Idea.
     * Esto permite que un usuario pueda "gustar" o "apoyar" múltiples ideas,
     * y que cada idea pueda ser "gustada" por múltiples usuarios.
     * Se espera que exista una tabla pivote (por defecto llamada 'idea_user') 
     * que relacione los usuarios con las ideas que han gustado.
     *
     * @return BelongsToMany
     */
    public function ideasLike(): BelongsToMany
    {
        return $this->belongsToMany(Idea::class);
    }
}
