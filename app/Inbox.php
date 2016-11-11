<?php

namespace App;

use Koch\Filters\Behavior\Filterable;
use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    use Filterable;

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'inbox';

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = ['description', 'source_int', 'source_ext', 'done'];

    /**
     * Specifies the belongs to relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
