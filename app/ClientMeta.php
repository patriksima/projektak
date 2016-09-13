<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientMeta extends Model
{
    protected $fillable = ['meta_key', 'meta_value'];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }
}
