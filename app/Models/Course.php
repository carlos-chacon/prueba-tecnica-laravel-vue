<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends BaseModel
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            if (method_exists($model, 'deletingCheck') && $model->deletingCheck()) {
                return false;
            }
        });
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'schedule',
        'start_date',
        'end_date'
    ];

    public function getNumberStudentsAttribute($attr)
    {
        return $this->students()->count();
    }

    function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class);
    }

    public function deletingCheck()
    {
        // Verifica si existen relaciones dependientes
        if ($this->students()->exists()) {
            return true;
        }
        return false;
    }
}
