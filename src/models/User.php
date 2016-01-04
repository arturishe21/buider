<?php namespace Vis\Builder;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Cartalyst\Sentry\Users\Eloquent\User as SentryUserModel;

class User extends SentryUserModel implements UserInterface, RemindableInterface {

    use UserTrait,
        RemindableTrait,
        \Venturecraft\Revisionable\RevisionableTrait,
        \Vis\Builder\Helpers\Traits\ImagesTrait,
        \Vis\Builder\Helpers\Traits\QuickEditTrait;

    protected $fillable = [];
    protected $revisionFormattedFieldNames = array(
        'title'  => 'Название',
        'description'  => 'Описание',
        'is_active' => 'Активация',
        'picture' => 'Изображение',
        'short_description' => 'Короткий текст',
        'created_at' => 'Дата создания'
    );
    protected $revisionFormattedFields = array(
        '1'  => 'string:<strong>%s</strong>',
        'public' => 'boolean:No|Yes',
        'deleted_at' => 'isEmpty:Active|Deleted'
    );

    protected $revisionCleanup = true;
    protected $historyLimit = 500;

    public function getFillable()
    {
        return $this->fillable;
    }

    public function setFillable(array $params)
    {
        $this->fillable = $params;
    }

    public static function boot()
    {
        parent::boot();
    }
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