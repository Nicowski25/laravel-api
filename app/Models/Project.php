<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    
    protected $fillable = ['title', 'description', 'duration','slug', 'status', 'start_date', 'end_date', 'type_id'];

    public static function generateSlug($title)
    {
        return Str::slug($title, '-');
    }

    public function type(): BelongsTo {
        return $this->belongsTo(Type::class, 'type_id');
    }
}
