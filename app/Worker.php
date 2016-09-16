<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $fillable = ['name', 'email'];

    public function tasks()
    {
        return $this->belongsToMany('App\Task');
    }

    public function tasklogs()
    {
        return $this->hasMany('App\TaskLog');
    }

    public function requests()
    {
        return $this->hasMany('App\TaskRequest');
    }

    public function worksheets()
    {
        return $this->hasMany('App\Worksheet');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function metas($key = '')
    {
        $metas = $this->hasMany('App\WorkerMeta');

        if ($key) {
            $metas = $metas->where('meta_key', '=', $key);
        }

        return $metas;
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where('name', 'like', $search);
        }
    }

    public function scopeJoinMetas($query)
    {
        $keys = ['type', 'job', 'rate', 'birthday', 'bank', 'address', 'note', 'gdrive', 'status'];

        foreach ($keys as $i => $key) {
            $query = $query->leftJoin("worker_metas as wm$i", function ($join) use ($i, $key) {
                $join->on('workers.id', '=', "wm$i.worker_id")
                     ->where("wm$i.meta_key", '=', $key);
            })
            ->addSelect(DB::raw("MAX(wm$i.meta_value) as $key"));
        }

        return $query;
    }

    public function scopeJoinBanks($query)
    {
        return $query
            ->leftJoin('worker_metas as wm_bank', function ($join) {
                $join->on('workers.id', '=', 'wm_bank.worker_id')
                     ->where('wm_bank.meta_key', '=', 'bank');
            })
            ->leftJoin('banks', DB::raw('CONCAT(banks.account_num, "/", LPAD(banks.bank_num, 4, "0"))'), '=', 'wm_bank.meta_value')
            ->addSelect(DB::raw('abs(sum(banks.cash)) as costs'));
    }
}
