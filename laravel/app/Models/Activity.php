<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['activity_id', 'seller_id', 'item_id', 'amount', 'applyAmount', 'effectiveStartTime', 'effectiveEndTime', 'limit', 'receive', 'surplus'];
    public static $rules = array(
        'activity_id' => 'required|unique:activities'
    );

    public static $messages = array(
        'activity_id.required' => '优惠券ID不能为空',
        'activity_id.unique' => '该优惠券已经在数据库中存在，不需要重复添加'
    );
}
