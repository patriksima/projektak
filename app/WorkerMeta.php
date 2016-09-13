<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkerMeta extends Model
{
    protected $fillable = ['meta_key', 'meta_value'];

    public function worker()
    {
        return $this->belongsTo('App\Worker');
    }
}
