<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    protected $fillable = ['description', 'source_int', 'source_ext', 'done'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function scopeWithClients($query)
    {
        return $query->leftJoin('clients', 'clients.id', '=', 'inboxes.client_id')
                     ->select('inboxes.id', 'clients.name as client', 'inboxes.description', 'inboxes.source_int', 'inboxes.source_ext', 'inboxes.created_at');
    }

    public function scopeDone($query, $flag)
    {
        return $query->where('done', '=', $flag);
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function ($query) use ($search) {
                $query->where('inboxes.description', 'like', $search)
                      ->orWhere('clients.name', 'like', $search);
            });
        }
    }
}
