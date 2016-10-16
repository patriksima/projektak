<?php

namespace App;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use Filterable;

    /**
     * Fillale fields.
     *
     * @var array
     */
    protected $fillable = ['status_id', 'name', 'type', 'note', 'deadline'];

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
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Specifies the belongs to relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(ProjectStatus::class);
    }

    /**
     * Specifies the has many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
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
     * Returns the project total duration
     *
     * @return float
     */
    public function duration()
    {
        return array_sum(
            $this->worksheets->pluck('duration')->toArray()
        );
    }

    /**
     * Returns the project total cost
     *
     * @return float
     */
    public function totalCost()
    {
        return array_sum(
            $this->worksheets->pluck('amount')->toArray()
        );
    }
}
