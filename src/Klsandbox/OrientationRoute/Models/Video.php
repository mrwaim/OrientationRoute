<?php

namespace Klsandbox\OrientationRoute\Models;

use Illuminate\Database\Eloquent\Model;
use Klsandbox\SiteModel\SiteExtensions;

/**
 * Klsandbox\OrientationRoute\Models\Video
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property integer $order_number
 * @property string $embed_code
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserVideo[] $watchedVideo
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\OrientationRoute\Models\Video whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\OrientationRoute\Models\Video whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\OrientationRoute\Models\Video whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\OrientationRoute\Models\Video whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\OrientationRoute\Models\Video whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\OrientationRoute\Models\Video whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\OrientationRoute\Models\Video whereOrderNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\OrientationRoute\Models\Video whereEmbedCode($value)
 * @mixin \Eloquent
 * @property integer $site_id
 * @method static \Illuminate\Database\Query\Builder|\Klsandbox\OrientationRoute\Models\Video whereSiteId($value)
 */
class Video extends Model
{
    use SiteExtensions;

    /**
     * @var array
     */
    protected $fillable = ['title', 'description', 'order_number', 'slug', 'embed_code'];

    /**
     * Relationship with `user_video` table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function watchedVideo()
    {
        return $this->hasMany(\Klsandbox\OrientationRoute\Models\UserVideo::class, 'video_id', 'id');
    }

    public function watchedByUser($user)
    {
        return $this->watchedVideo()->where('user_id', '=', $user->id)->count() > 0;
    }
}
