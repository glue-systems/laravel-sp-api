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
        // Note that this only clears the Facade's internal static reference
        // to the resolved instance. Depending on the implementation of the
        // binding, it is still possible for the same instance to be returned
        // on subsequent calls to resolveFacadeInstance, such as when the
        // object is registered as a singleton in a Service Provider, or when a
        // testing helper like `[Facade]::shouldReceive` is used, as the Mockery
        // library also retains static references to its mocks.
        static::clearResolvedInstance(static::getFacadeAccessor());

        return static::resolveFacadeInstance(static::getFacadeAccessor());
    }
}
