<?php

namespace App;

use Carbon\Carbon;
use Koch\Filters\Behavior\Filterable;
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
        return $this->hasMany(TimeRequest::class);
    }

    /**
     * Returns loggable tasks.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function loggable()
    {
        return auth()->user()->worker->tasks()->newQuery()
            ->whereNotIn('status_id', [1, 10])->get()
            ->load(['project', 'project.client', 'status']);
    }

    /**
     * Starts logging of this task.
     *
     * @return void
     */
    public function startLogging()
    {
        $this->logs()->create([
            'start' => Carbon::now(),
            'worker_id' => auth()->user()->worker->id,
        ]);
    }

    /**
     * Stops logging of this task.
     *
     * @return void
     */
    public function stopLogging()
    {
        $this->logs->where('end', null)->first()
            ->update(['end' => Carbon::now()]);
    }
}
