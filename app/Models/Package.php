<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $valid_for_type
 * @property string $image
 * @property float  $cost
 * @property int    $valid_for_value
 */
class Package extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'packages';

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
        'name', 'cost', 'cost_type', 'valid_for_type', 'valid_for_value', 'image', 'barcode', 'sku', 'type', 'sessions_count'
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
        'name' => 'string',
        'sku' => 'string',
        'barcode' => 'string',
        'cost' => 'float',
        'string' => 'cost_type',
        'valid_for_type' => 'string',
        'valid_for_value' => 'int',
        'image' => 'string',
        'created_at' => 'datetime: Y-m-d'
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

    public function sessions()
    {
        return $this->belongsToMany(Session::class, 'packages_sessions', 'package_id', 'session_id', 'id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'packages_members', 'package_id', 'member_id', 'id', 'id');
    }
}
