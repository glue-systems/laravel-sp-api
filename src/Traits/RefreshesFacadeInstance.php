<?php

namespace Glue\SpApi\Laravel\Traits;

/**
 * Using this trait will ensure that a new object is instantiated on each
 * static call to a Facade, overriding the default behavior in which a
 * static reference to the resolved instance is persisted on the parent
 * Facade class.
 *
 * Note that, depending on the implementation of the application binding,
 * it is still possible for the same instance to be returned on subsequent
 * calls to `getFacadeRoot`, such as when:
 *   i) The object is registered as a singleton in a Service Provider;
 *   ii) Testing helper methods like `[Facade]::shouldReceive` are used.
 *     a) This is because the Mockery library retains its own static
 *         references to its mocks.
 *     b) This behavior should be desirable in most cases, as this trait is
 *         not intended to disrupt Laravel's robust facade testing features.
 */
trait RefreshesFacadeInstance
{
    /**
     * Get the root object behind the facade.
     *
     * @return mixed
     */
    public static function getFacadeRoot()
    {
        static::clearResolvedInstance(static::getFacadeAccessor());

        return static::resolveFacadeInstance(static::getFacadeAccessor());
    }
}
