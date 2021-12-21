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
        'name', 'url',
    ];
    /**
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'url' => 'string',
    ];

    /**
     * @param  string|null  $connection
     */
    public function setConnection(?string $connection): void
    {
        $connection = config('feedback.databaseConnection');
        $this->connection = $connection;
    }
}
