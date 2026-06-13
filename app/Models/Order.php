<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'customer', 'total', 'status', 'payment'];
    protected static function boot()
    {
        parent::boot();

        // Beri nilai default untuk 'active' jika tidak diisi
        static::creating(function ($order) {
            if (!isset($order->active)) {
                $order->active = 1;
            }
        });
    }
    // Relasi ke OrderDetail
    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Format tanggal lebih rapi
    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->format('d M Y H:i');
    }

    // 🔹 Scope untuk pencarian berdasarkan customer atau ID order
    public function scopeSearch($query, $search)
    {
        if (!empty($search)) {
            return $query->where('customer', 'like', "%{$search}%")
                        ->orWhere('id', 'like', "%{$search}%");
        }
        return $query;
    }

    // 🔹 Scope untuk filter berdasarkan rentang tanggal
    public function scopeDateRange($query, $start_date, $end_date)
    {
        if (!empty($start_date) && !empty($end_date)) {
            return $query->whereBetween('created_at', [$start_date, $end_date . ' 23:59:59']);
        }
        return $query;
    }
}
