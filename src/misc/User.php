<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Cartalyst\Sentry\Users\Eloquent\User as SentryUserModel;

class User  extends SentryUserModel implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    public function getAvatar(array $imgParam)
    {
        if ($this->image) {
            $image = $this->image;
        } else {
            $image = "/packages/vis/builder/img/blank_avatar.gif";
        }

        return glide($image, $imgParam);
    }

    public function getFullName()
    {
        return $this->first_name." ".$this->last_name;
    }

}
