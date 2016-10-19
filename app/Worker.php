<?php

namespace App;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use Filterable;

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'job',
        'rate',
        'birthday',
        'bank',
        'address',
        'note',
        'gdrive',
        'status',
        'type',
    ];

    /**
     * Dates array.
     *
     * @var array
     */
    protected $dates = ['birthday', 'created_at', 'updated_at'];

    /**
     * Specifies the belongs to many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }

    /**
     * Specifies the has many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function taskLogs()
    {
        return $this->hasMany(TaskLog::class);
    }

    /**
     * Specifies the has many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requests()
    {
        return $this->hasMany(TaskRequest::class);
    }

    /**
     * Specifies the has many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function worksheets()
    {
        return $this->hasMany(Worksheet::class);
    }

    /**
     * Specifies the belongs to relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
