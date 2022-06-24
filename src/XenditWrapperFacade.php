<?php

namespace AsagiriMoe\XenditWrapper;

use Illuminate\Support\Facades\Facade;

/**
 * @see \AsagiriMoe\XenditWrapper\Skeleton\SkeletonClass
 */
class XenditWrapperFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'xendit-wrapper';
    }
}
