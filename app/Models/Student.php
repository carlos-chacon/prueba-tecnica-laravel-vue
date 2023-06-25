<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends BaseModel
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
        'last_name',
        'birth_year',
        'email',
    ];

    protected $appends = [
        'age'
    ];

    public function getAgeAttribute()
    {
        $currentDate = Carbon::now();

        return $currentDate->year - $this->attributes['birth_year'];
    }



    function course(): BelongsToMany
    {
        return $this->belongsToMany(Course::class)->withPivot('id');
    }

    public function deletingCheck()
    {
        // Verifica si existen relaciones dependientes
        if ($this->course()->exists()) {
            return true;
        }
        return false;
    }
}
