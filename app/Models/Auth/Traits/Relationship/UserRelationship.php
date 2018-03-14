<?php

namespace App\Models\Auth\Traits\Relationship;

use App\Models\Post;
use App\Models\System\Session;
use App\Models\Auth\SocialAccount;

/**
 * Class UserRelationship.
 */
trait UserRelationship
{
    /**
     * @return mixed
     */
    public function providers()
    {
        return $this->hasMany(SocialAccount::class);
    }

    /**
     * @return mixed
     */
    public function sessions()
    {
        return $this->hasMany(Session::class);
    }

    public function posts(){
        return $this->hasMany(Post::class, 'id');
    }
}
