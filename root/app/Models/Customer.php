<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;

    protected $appends = ['status_conversion'];

    // アクセサ（取得時に加工）
    protected function statusConversion(): Attribute
    {
        return Attribute::make(
            get: fn () => match ($this->status) {
                'prospected'    => '見込み',
                'corresponding' => '対応中',
                'completed'     => '完了',
            },
        );
    }
}