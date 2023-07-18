<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $package_id
 * @property int      $member_id
 * @property DateTime $valid_till
 * @property string   $purchase_status
 */
class PackagesMember extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'packages_members';

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
        'package_id', 'member_id', 'valid_till', 'purchase_status', 'freeze_value', 'freeze_start_date', 'freeze_approved'
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
        'package_id' => 'int', 'member_id' => 'int', 'valid_till' => 'datetime:Y-m-d', 'purchase_status' => 'string'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'valid_till'
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
}
