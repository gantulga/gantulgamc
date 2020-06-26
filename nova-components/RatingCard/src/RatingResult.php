<?php

namespace Qz\RatingCard;

use Closure;
use JsonSerializable;

class RatingResult implements JsonSerializable
{
    /**
     * The value of the result.
     *
     * @var array
     */
    public $value;

    /**
     * The metric value prefix.
     *
     * @var string
     */
    public $prefix;

    /**
     * The metric value suffix.
     *
     * @var string
     */
    public $suffix;

    /**
     * Create a new partition result instance.
     *
     * @param  mixed  $value
     * @return void
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Set the metric value prefix.
     *
     * @param  string  $prefix
     * @return $this
     */
    public function prefix($prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * Set the metric value suffix.
     *
     * @param  string  $suffix
     * @return $this
     */
    public function suffix($suffix)
    {
        $this->suffix = $suffix;

        return $this;
    }


    /**
     * Prepare the metric result for JSON serialization.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'value' => $this->value,
            'prefix' => $this->prefix,
            'suffix' => $this->suffix,
        ];
    }
}
