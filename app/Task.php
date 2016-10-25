<?php

namespace App;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use Filterable;

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = [
        'status_id',
        'name',
        'description',
        'source_int',
        'source_ext',
        'deadline',
        'estimate',
        'checked',
    ];

    /**
     * Dates array.
     *
     * @var array
     */
    protected $dates = ['deadline', 'created_at', 'updated_at'];

    /**
     * Specifies the belongs to relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Specifies the belongs to relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(TaskStatus::class);
    }

    /**
     * Specifies the belongs to many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function workers()
    {
        return $this->belongsToMany(Worker::class);
    }

    /**
     * Specifies the has many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logs()
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
}
