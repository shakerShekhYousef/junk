<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $class_id
 * @property int    $capacity
 * @property int    $coach_id
 * @property int    $status
 * @property int    $recuring_interval
 * @property int    $session_total_count
 * @property string $start_time
 * @property string $end_time
 * @property string $recurring_type
 * @property string $minimum_open_type
 * @property string $minimum_open_value
 */
class Session extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sessions';

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
        'music_id', 'class_id', 'session_cost', 'total_cost', 'open_date', 'qrcode', 'start_time', 'end_time', 'capacity', 'coach_id', 'status', 'recurring_type', 'recuring_interval', 'session_total_count', 'minimum_open_type', 'minimum_open_value', 'isfull'
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
        'class_id' => 'int',
        'start_time' => 'string',
        'end_time' => 'string',
        'qrcode' => 'string',
        'capacity' => 'int',
        'coach_id' => 'int',
        'status' => 'string',
        'recurring_type' => 'string',
        'recuring_interval' => 'string',
        'session_total_count' => 'int',
        'minimum_open_type' => 'string',
        'minimum_open_value' => 'string',
        'open_date' => 'string',
        'created_at' => 'datetime:Y-m-d H:m:s',
        'updated_at' => 'datetime:Y-m-d H:m:s'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        //
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

    public function coachname()
    {
        $temp = $this->hasOne(User::class, 'id', 'coach_id')->first();
        if ($temp == null)
            return null;
        else
            return  $temp->username();
    }
    public function classm()
    {
        return $this->belongsTo(ClassM::class, 'class_id', 'id');
    }

    public function music()
    {
        return $this->belongsTo(Music::class, 'music_id', 'id');
    }

    public function session_customize()
    {
        return $this->hasMany(SessionCustomize::class, 'session_id', 'id');
    }

    public function packages_sessions()
    {
        return $this->hasMany(PackagesSession::class, 'session_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'sessions_members', 'session_id', 'member_id', 'id', 'id');
    }

    public function historyusers()
    {
        return $this->belongsToMany(User::class, 'sessions_history', 'session_id', 'member_id', 'id', 'id');
    }

    public function membersessiondata()
    {
        return $this->hasMany(MemberSessionData::class, 'session_id', 'id');
    }

    public function sessionmemberscount()
    {
        return $this->belongsToMany(User::class, 'sessions_members', 'session_id', 'member_id', 'id', 'id')->wherePivot('role_id', 4)->count();
    }

    public function sessionbookedmemberscountinday($session, $date)
    {
        $books = Session::join('books', 'books.session_id',  '=', 'sessions.id')->where('sessions.id', $session)->whereDate('books.bookdate', $date)->where('books.status', 'Pending')->count();
        return $books;
    }

    public function finishedsessionbookedmemberscountinday($session, $date)
    {
        $books = Session::join('books', 'books.session_id',  '=', 'sessions.id')->where('sessions.id', $session)->whereDate('books.bookdate', $date)->where('books.status', 'Finished')->count();
        return $books;
    }

    public function sessionmembers()
    {
        return $this->belongsToMany(User::class, 'sessions_members', 'session_id', 'member_id', 'id', 'id')->wherePivot('role_id', 4)->pluck('member_id');
    }

    public function issessionmember($id)
    {
        $val = $this->belongsToMany(User::class, 'sessions_members', 'session_id', 'member_id', 'id', 'id')->wherePivot('member_id', $id)->first();
        return $val == null ? false : true;
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'packages_sessions', 'session_id', 'package_id', 'id', 'id');
    }

    public function todaypendingbooks()
    {
        return $this->hasMany(Book::class, 'session_id', 'id')->where('status', 'Pending')->whereDate('bookdate', today()->toDateString());
    }

    public function finishedbooks()
    {
        return $this->hasMany(Book::class, 'session_id', 'id')->where('status', 'Finished');
    }
}
