<?php

namespace FredBradley\Feedback\Models;

use FredBradley\Feedback\ModelInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 */
class FeedbackRecord extends Model implements ModelInterface
{
    /**
     * @var array
     */
    protected $fillable = [
        'site_id',
        'feedback',
        'other_comments',
        'client_meta',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'site_id'        => 'integer',
        'feedback'       => 'json',
        'client_meta'    => 'json',
        'other_comments' => 'string',
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function site(): BelongsTo
    {
        return $this->belongsTo(FeedbackSite::class);
    }
}
