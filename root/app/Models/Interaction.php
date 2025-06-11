<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Interaction extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'customer_id', 'content', 'supported_types', 'status'];

    protected $appends = ['status_conversion', 'created_at_formatted', 'supported_types_conversion'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // アクセサ（取得時に加工）
    protected function statusConversion(): Attribute
    {
        return Attribute::make(
            get: fn () => match ($this->status) {
                'prospected'    => '未対応',
                'corresponding' => '対応中',
                'completed'     => '完了',
            },
        );
    }
    // 対応種別
    protected function supportedTypesConversion(): Attribute
    {
        return Attribute::make(
            get: fn () => match ($this->supported_types) {
                'opposing' => '対面',
                'phone' => '電話',
                'email'     => 'メール',
                'other'     => 'その他',
            },
        );
    }

    // updated_at のフォーマット済みアクセサ
    protected function createdAtFormatted(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->created_at
                ? $this->created_at->format('Y年m月d日 H時m分')
                : null,
        );
    }
}
