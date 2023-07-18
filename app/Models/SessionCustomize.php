<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $session_id
 * @property string $member_id
 * @property string $music_type
 * @property string $music_list
 * @property string $location
 * @property string $other
 */
class SessionCustomize extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'session_customize';

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
        'session_id', 'member_id', 'music_type', 'music_list', 'location', 'other'
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
        'session_id' => 'int', 'member_id' => 'string', 'music_type' => 'string', 'music_list' => 'string', 'location' => 'string', 'other' => 'string'
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

    public function session(){
        return $this->belongsTo(Session::class, 'session_id', 'id');
    }
}
