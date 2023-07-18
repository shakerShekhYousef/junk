<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $member_id
 * @property int      $session_id
 * @property int      $attended
 * @property DateTime $date_of_session
 */
class MemberSessionData extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'member_session_data';

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
        'member_id', 'session_id', 'date_of_session', 'attended' , 'day_name', 'start_at','end_at'
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
        'member_id' => 'int', 'session_id' => 'int', 'date_of_session' => 'datetime', 'attended' => 'int'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'date_of_session'
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

    public function user(){
        return $this->belongsTo(User::class, 'member_id', 'id');
    }

    public function session(){
        return $this->belongsTo(Session::class, 'session_id', 'id');
    }

}
