<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $type
 * @property string $body
 * @property string $approved_by
 * @property string $status
 * @property int    $member_id
 * @property int    $report_id
 */
class RequestM extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'requests';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'body', 'member_id', 'approved_by', 'status', 'session_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'type' => 'string', 'body' => 'string', 'member_id' => 'int', 'approved_by' => 'string', 'status' => 'string'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;

    // Scopes...

    // Functions ...

    // Relations ...

    public function user()
    {
        return $this->belongsTo(User::class, 'member_id', 'id');
    }

    public function approvedby()
    {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }
}
