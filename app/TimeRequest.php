<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeRequest extends Model
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
        return $this->belongsTo(Task::class);
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

    /**
     * Denies given task by simply deleting it from the table.
     *
     * @return void
     */
    public function deny()
    {
        $this->task->update(['status_id' => 2]);

        $this->delete();
    }
}
