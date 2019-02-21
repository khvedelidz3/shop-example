<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $fillable = ['status_name', 'default'];
    public function orders()
    {
        return $this->hasMany(Order::class, 'status_id', 'id');
    }
}
