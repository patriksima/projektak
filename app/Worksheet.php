<?php

namespace App;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;

class Worksheet extends Model
{
    use Filterable;

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = [
        'task',
        'description',
        'start',
        'end',
        'duration',
        'tags',
        'amount',
        'currency',
        'billable',
    ];

    /**
     * Dates array.
     *
     * @var array
     */
    protected $dates = ['start', 'end', 'created_at', 'updated_at'];

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
    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }
}
