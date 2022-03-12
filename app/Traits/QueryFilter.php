<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait QueryFilter
{
    // For filter
    public function scopeFilter($query, $params)
    {
        if (!$params) {
            return $query;
        }

        foreach ($params as $field => $value) {

            // ex: filterStatus
            $method = 'filter' . Str::studly($field);

            if ($value === '' || $value == null) {
                continue;
            }

            if (empty($this->filterable) || !is_array($this->filterable)) {
                continue;
            }

            // Check method exist and call it
            if (method_exists($this, $method)) {
                $this->{$method}($query, $value);
            } else {
                // Filter by field if field exits in params and in filterable model
                if (in_array($field, $this->filterable)) {
                    $query->where($this->table . '.' . $field, $value);
                    continue;
                }
            }
        }

        return $query;
    }
}
