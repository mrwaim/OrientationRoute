<?php

namespace Klsandbox\OrientationRoute\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Klsandbox\OrientationRoute\Models\UserVideo
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $video_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Video $video
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\OrientationRoute\Models\UserVideo whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\OrientationRoute\Models\UserVideo whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\OrientationRoute\Models\UserVideo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\OrientationRoute\Models\UserVideo whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\OrientationRoute\Models\UserVideo whereVideoId($value)
 * @mixin \Eloquent
 */
class UserVideo extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'video_id'];

    /**
     * @var string
     */
    protected $table = 'user_video';

    /**
     * Relationship with `users` table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    /**
     * Relationship with `videos` table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function video()
    {
        return $this->belongsTo(\Klsandbox\OrientationRoute\Models\Video::class, 'video_id', 'id');
    }
}
