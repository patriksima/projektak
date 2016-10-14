<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskRequest extends Model
{
    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = ['estimate', 'reason'];

    /**
     * Specifies the belongs to relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function task()
    {
        return $this->belongsTo('App\Task');
    }

    /**
     * Specifies the belongs to relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function worker()
    {
        return $this->belongsTo('App\Worker');
    }

    /**
     * Approves given task request by incrementing the estimated time and
     * setting the status id to 6.
     *
     * @return void
     */
    public function approve()
    {
        $this->task->increment('estimate', $this->estimate);

        $this->task->update(['status_id' => 6]);

        $this->delete();
    }
}
