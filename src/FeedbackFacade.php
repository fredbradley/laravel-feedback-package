<?php

namespace FredBradley\Feedback;

use Illuminate\Support\Facades\Facade;

/**
 * @see \FredBradley\Feedback\Skeleton\SkeletonClass
 */
class FeedbackFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'feedback';
    }
}
