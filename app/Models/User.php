<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

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
        'email',
        'fname',
        'lname',
        'gender',
        'screen_name',
        'dob',
        'age',
        'height',
        'weight',
        'address1',
        'address2',
        'city',
        'state',
        'zip_code',
        'country',
        'phone',
        'whats_app_phone',
        'referred_by',
        'emergency_contact_name',
        'emergency_contact_number',
        'emergency_contact_relation',
        'tc_agree',
        'role_id',
        'image',
        'password',
        'email_verified_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email_verified_at', 'tc_agree'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'dob' => 'datetime:Y-m-d',
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

    public function username()
    {
        return $this->fname . ' ' . $this->lname;
    }

    // Relations ...

    public function sessions()
    {
        return $this->belongsToMany(Session::class, 'sessions_members', 'member_id', 'session_id', 'id', 'id');
    }

    public function historysessions()
    {
        return $this->belongsToMany(Session::class, 'sessions_history', 'member_id', 'session_id', 'id', 'id');
    }

    public function sessionmembers()
    {
        return $this->hasMany(SessionsMember::class, 'member_id', 'id');
    }

    public function sessionhistory()
    {
        return $this->hasMany(SessionsHistory::class, 'member_id', 'id');
    }

    public function membersessiondata()
    {
        return $this->hasMany(MemberSessionData::class, 'member_id', 'id');
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'packages_members', 'member_id', 'package_id', 'id', 'id');
    }

    public function packagemembers()
    {
        return $this->hasMany(PackagesMember::class, 'member_id', 'id');
    }

    public function paymentinfos()
    {
        return $this->hasMany(PaymentsInfo::class, 'member_id', 'id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'member_id', 'id');
    }

    public function books()
    {
        return $this->hasMany(Book::class, 'member_id', 'id');
    }

    public function memberbooksession($session)
    {
        $val = $this->hasMany(Book::class, 'member_id', 'id')->where('session_id', $session)->first();
        if ($val != null)
            return ['bookid' => $val->id, 'info' => true];
        else
            return null;
    }

    public function memberbooksessionindat($session, $date)
    {
        $val = $this->hasMany(Book::class, 'member_id', 'id')->where('session_id', $session)->whereDate('bookdate', $date)->where('status', 'Pending')->first();
        if ($val != null)
            return ['bookid' => $val->id, 'info' => true];
        else
            return null;
    }

    public function medicalinformaion()
    {
        return $this->hasMany(MedicalInformation::class, 'member_id', 'id');
    }

    public function requests()
    {
        return $this->hasMany(Request::class, 'member_id', 'id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'member_id', 'id');
    }

    public function userinfo()
    {
        return $this->hasOne(UserInformation::class, 'member_id', 'id');
    }

    public function gettotalbalance()
    {
        $packagesinfo = Package::get();
        $packages = $this->hasMany(PackagesMember::class, 'member_id')->where('purchase_status', 'valid')->get();
        $sessionscount = 0;
        foreach ($packages as $key => $package) {
            if ($package->freeze_approved) {
                $startfreez = Carbon::parse($package->freeze_start_date);
                $endfreez = Carbon::parse($package->freeze_start_date)->addMonths($package->freeze_value);
                if (!now()->between($startfreez, $endfreez)) {
                    $temp = $packagesinfo->where('id', $package->package_id)->first();
                    $sessionscount += $temp->sessions_count;
                }
            } else {
                $temp = $packagesinfo->where('id', $package->package_id)->first();
                $sessionscount += $temp->sessions_count;
            }
        }
        return $sessionscount;
    }

    public function hasfrozenpackages()
    {
        $packages = $this->hasMany(PackagesMember::class, 'member_id')->where('purchase_status', 'valid')->get();

        $data = false;
        foreach ($packages as $key => $package) {
            if ($package->freeze_approved) {
                $startfreez = Carbon::parse($package->freeze_start_date);
                $endfreez = Carbon::parse($package->freeze_start_date)->addMonths($package->freeze_value);
                if (now()->between($startfreez, $endfreez)) {
                    $data = true;
                }
            }
        }
        return $data;
    }

    public function isAdmin()
    {
        return Auth::user()->role_id == 1 ? true : false;
    }

    public function getavailablebalance()
    {
        $packagesinfo = Package::get();
        $packages = $this->hasMany(PackagesMember::class, 'member_id')->where('purchase_status', 'valid')->get();
        $sessionscount = 0;
        foreach ($packages as $key => $package) {
            if ($package->freeze_approved) {
                $startfreez = Carbon::parse($package->freeze_start_date);
                $endfreez = Carbon::parse($package->freeze_start_date)->addMonths($package->freeze_value);
                if (!now()->between($startfreez, $endfreez)) {
                    $temp = $packagesinfo->where('id', $package->package_id)->first();
                    $sessionscount += $temp->sessions_count;
                }
            } else {
                $temp = $packagesinfo->where('id', $package->package_id)->first();
                $sessionscount += $temp->sessions_count;
            }
        }
        $bokedsessinscount =  $this->books->where('status', 'Pending')->count();
        $sessionscount  -= $bokedsessinscount;
        return $sessionscount;
    }

    public function getbookedbalance()
    {
        $bokedsessinscount =  $this->books->where('status', 'Pending')->count();
        return $bokedsessinscount;
    }

    public function fees()
    {
        return $this->hasMany(Fee::class, 'member_id', 'id');
    }

    public function hasattendfreeclass()
    {
        return $this->packagemembers->where('package_id', 1)->count() > 0 ? true : false;
    }
}
