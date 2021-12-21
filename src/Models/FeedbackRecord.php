<?php

namespace FredBradley\Feedback\Models;

use Fredbradley\Feedback\ModelInterface;
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
        'site_id' => 'integer',
        'feedback' => 'json',
        'client_meta' => 'json',
        'other_comments' => 'string',
    ];

    /**
     * @param  string|null  $connection
     */
    public function setConnection(?string $connection): void
    {
        $connection = config('feedback.databaseConnection');
        $this->connection = $connection;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function site(): BelongsTo
    {
        return $this->belongsTo(FeedbackSite::class);
    }
}
