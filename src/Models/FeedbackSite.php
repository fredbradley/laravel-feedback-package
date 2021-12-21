<?php

namespace FredBradley\Feedback\Models;

use FredBradley\Feedback\ModelInterface;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class FeedbackSite extends Model implements ModelInterface
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'url',
    ];
    /**
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'url'  => 'string',
    ];

    /**
     * @param  array  $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setConnection(config('feedback.databaseConnection'));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function records()
    {
        return $this->hasMany(FeedbackRecord::class, "site_id");
    }
}
