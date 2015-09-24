<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\EventManager;

use Traversable;

/**
 * Interface for messengers
 */
interface EventManagerInterface extends SharedEventManagerAwareInterface
{
    /**
     * Trigger an event
     *
     * Should allow handling the following scenarios:
     * - Passing Event object only
     * - Passing event name and Event object only
     * - Passing event name, target, and Event object
     * - Passing event name, target, and array|ArrayAccess of arguments
     * - Passing event name, target, array|ArrayAccess of arguments, and callback
     *
     * @param  string|EventInterface $event
     * @param  object|string $target
     * @param  array|object $argv
     * @param  null|callable $callback
     * @return ResponseCollection
     */
    public function trigger($event, $target = null, $argv = [], callable $callback = null);

    /**
     * Attach a listener to an event
     *
     * @param  string $event Event to which to listen.
     * @param  callable $listener
     * @param  int $priority Priority at which to register listener.
     */
    public function attach($event, callable $listener, $priority = 1);

    /**
     * Detach a listener.
     *
     * If no $event or '*' is provided, detaches listener from all events;
     * otherwise, detaches only from the named event.
     *
     * @param callable $listener
     * @param null|string $event Event from which to detach; null and '*'
     *     indicate all events.
     */
    public function detach(callable $listener, $event = null);

    /**
     * Get a list of events for which this collection has listeners
     *
     * @return array
     */
    public function getEvents();

    /**
     * Retrieve a list of listeners registered to a given event
     *
     * @param  string $event
     * @return array|object
     */
    public function getListeners($event);

    /**
     * Clear all listeners for a given event
     *
     * @param  string $event
     * @return void
     */
    public function clearListeners($event);

    /**
     * Set the event class to utilize
     *
     * @param  string $class
     * @return EventManagerInterface
     */
    public function setEventClass($class);

    /**
     * Get the identifier(s) for this EventManager
     *
     * @return array
     */
    public function getIdentifiers();

    /**
     * Set the identifiers (overrides any currently set identifiers)
     *
     * @param string[] $identifiers
     * @return EventManagerInterface
     */
    public function setIdentifiers(array $identifiers);

    /**
     * Add identifier(s) (appends to any currently set identifiers)
     *
     * @param string[] $identifiers
     * @return EventManagerInterface
     */
    public function addIdentifiers(array $identifiers);

    /**
     * Attach a listener aggregate
     *
     * @param  ListenerAggregateInterface $aggregate
     * @param  int $priority If provided, a suggested priority for the aggregate to use
     * @return mixed return value of {@link ListenerAggregateInterface::attach()}
     */
    public function attachAggregate(ListenerAggregateInterface $aggregate, $priority = 1);

    /**
     * Detach a listener aggregate.
     *
     * Should delegate to the aggregate's detach() method.
     *
     * @param  ListenerAggregateInterface $aggregate
     */
    public function detachAggregate(ListenerAggregateInterface $aggregate);
}
