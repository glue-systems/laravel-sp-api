<?php

namespace Glue\SpApi\Laravel\Traits;

trait RefreshesFacadeInstance
{
    /**
     * Resolve the facade root instance from the container.
     *
     * @param  object|string  $name
     * @return mixed
     */
    protected static function resolveFacadeInstance($name)
    {
        if (!static::isMock()) {
            static::clearResolvedInstance(
                static::getFacadeAccessor()
            );
        }
        return parent::resolveFacadeInstance($name);
    }
}
