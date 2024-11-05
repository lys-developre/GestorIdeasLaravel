<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Idea extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'description',
        'user_id',
    ];

    protected $casts =['created_at'=>'datetime'];


    /**
     * Define la relación que indica que cada idea pertenece a un solo usuario.
     * Esto significa que cada idea está asociada a un único creador (usuario)..
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }


    /**
     * Define la relación muchos a muchos con el modelo User.
     * Esto permite que múltiples usuarios puedan "gustar" o "apoyar" una idea.
     * Se espera que exista una tabla pivote (por defecto llamada 'idea_user') 
     * que relacione las ideas con los usuarios que las han gustado.
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
