<?php

namespace App\Entities\Auth;

use App\Entities\AccessLog;
use App\Entities\Lesson\Forum\Answer;
use App\Entities\Lesson\Forum\Question;
use App\Entities\Lesson\Lesson;
use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

use Silber\Bouncer\Database\HasRolesAndAbilities;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'document_number',
        'email',
        'password',
        'facebook_id',
        'avatar',
        'google_id',
        'address_street',
        'address_number',
        'address_neighborhood',
        'address_city',
        'address_state',
        'is_admin'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Make a new Password Reset Hash
     *
     * @return string
     */
    public function generateResetToken(){
        $token = rand(100000,999999);
        DB::table('password_resets')->insert(
            [
                'email' => $this->email,
                'token' => $token,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
        return $token;
    }

    public function logs(){
        return $this->hasMany(AccessLog::class);
    }

    public function lessons(){
        return $this->belongsToMany(
            Lesson::class,
            'lessons_finished',
            'user_id',
            'lesson_id'
        );
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
