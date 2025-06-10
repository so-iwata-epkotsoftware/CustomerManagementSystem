<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login_log extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'ip_address', 'user_agent', 'updated_at'];

    protected $appends = ['created_at_formatted'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

     // created_at のフォーマット済みアクセサ
    protected function createdAtFormatted(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->created_at
                ? $this->created_at->format('Y年m月d日 H時m分')
                : null,
        );
    }
}
