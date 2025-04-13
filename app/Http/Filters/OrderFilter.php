<?php

namespace App\Http\Filters;

class OrderFilter extends QueryFilter
{
    public function status_id($id = null)
    {
        if(!$id)
            return $this->builder;
        return $this->builder->where('status_id', $id);
    }
    public function payment_method_id($id = null)
    {
        if(!$id)
            return $this->builder;
        return $this->builder->where('payment_method_id', $id);
    }
    public function discount_id($id = null)
    {
        if(!$id)
            return $this->builder;
        return $this->builder->where('discount_id', $id);
    }
}
