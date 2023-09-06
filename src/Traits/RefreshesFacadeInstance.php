<?php

namespace Glue\SpApi\Laravel\Traits;

trait RefreshesFacadeInstance
{
    /**
     * Get the root object behind the facade.
     *
     * @return mixed
     */
    public static function getFacadeRoot()
    {
        if (!static::isMock()) {
            static::clearResolvedInstance(static::getFacadeAccessor());
        }

        return static::resolveFacadeInstance(static::getFacadeAccessor());
    }
}
