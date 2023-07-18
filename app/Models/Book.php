<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $class_id
 * @property int    $session_id
 * @property int    $member_id
 * @property string $status
 */
class Book extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'books';

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
        'class_id', 'session_id', 'member_id', 'status','day_name','bookdate', 'attended'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'class_id' => 'int', 'session_id' => 'int', 'member_id' => 'int', 'status' => 'string'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;

    // Scopes...

    // Functions ...

    // Relations ...

    public function users()
    {
        return $this->belongsTo(User::class, 'member_id', 'id');
    }
}
