<?php

namespace Fredbradley\Feedback\Models;

use Fredbradley\Feedback\ModelInterface;
use Illuminate\Database\Eloquent\Model;

class FeedbackSite extends Model implements ModelInterface
{
    /**
     * @param  string|null  $connection
     */
    public function setConnection(?string $connection): void
    {
        $connection = config('feedback.databaseConnection');
        $this->connection = $connection;
    }
}
