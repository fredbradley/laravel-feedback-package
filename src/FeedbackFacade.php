<?php

namespace Fredbradley\Feedback;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Fredbradley\Feedback\Skeleton\SkeletonClass
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
