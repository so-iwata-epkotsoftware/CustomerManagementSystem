<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Interaction;


class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;

    protected $appends = ['status_conversion', 'updated_at_formatted'];

    public function Interactions()
    {
        return $this->hasMany(Interaction::class);
    }

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

    // updated_at のフォーマット済みアクセサ
    protected function updatedAtFormatted(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->updated_at
                ? $this->updated_at->format('Y年m月d日')
                : null,
        );
    }
}
