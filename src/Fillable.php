<?php namespace rkgrep;

trait Fillable {

    /**
     * All of the attributes set on the container.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Inject value into container
     *
     * @param  string|array $key
     * @param  mixed        $value
     * @param  bool $overwrite
     * @return $this
     */
    public function with($key, $value = null, $overwrite = true)
    {
        if (is_array($key))
        {
            $this->attributes = ($overwrite) ? array_merge($this->attributes, $key) : array_merge($key, $this->attributes);
        }
        else
        {
            if ($overwrite || !array_key_exists($key, $this->attributes))
            {
                $this->attributes[$key] = $value;
            }
        }

        return $this;
    }

    /**
     * Fill container with values
     *
     * @param  array   $data
     * @param  boolean $merge
     * @return $this
     */
    public function fill(array $data, $merge = true)
    {
        $this->attributes = ($merge) ? array_merge($this->attributes, $data) : $data;
        return $this;
    }
}