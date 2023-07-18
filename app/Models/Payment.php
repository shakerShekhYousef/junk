<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $payment_type
 * @property int    $payment_type_id
 * @property int    $member_id
 * @property float  $payment_value
 * @property float  $total_amount
 */
class Payment extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Payments';

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
        'payment_type', 'payment_type_id', 'payment_value', 'total_amount', 'member_id'
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
        'payment_type' => 'string', 'payment_type_id' => 'int', 'payment_value' => 'double', 'total_amount' => 'double', 'member_id' => 'int'
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

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'payment_id', 'id');
    }
}
