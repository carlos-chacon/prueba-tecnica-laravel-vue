<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public function getCreatedAtAttribute($attr)
    {
        if ($attr) {

            return Carbon::parse($attr)->format('d-m-Y g:i A');
        }
        return null;

    }

    public function getUpdatedAtAttribute($attr)
    {
        if ($attr) {

            return Carbon::parse($attr)->format('d-m-Y g:i A');
        }
        return null;

    }

}
