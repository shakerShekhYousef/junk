<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $session_id
 * @property int $package_id
 */
class PackagesSession extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'packages_sessions';

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
        'session_id', 'package_id'
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
        'session_id' => 'int', 'package_id' => 'int'
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
    public function classm()
    {
        return $this->hasOneThrough(ClassM::class, Session::class, 'id', 'id','session_id', 'class_id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
}
