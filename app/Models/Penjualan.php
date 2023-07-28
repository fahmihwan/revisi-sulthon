<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function alamat()
    {
        return $this->belongsTo(Alamat::class)->withTrashed();
    }

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kurir()
    {
        return $this->belongsTo(Kurir::class);
    }

    public function detail_penjualans()
    {
        return $this->hasMany(Detail_penjualan::class);
    }


    // filter rerport penjualan
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['periode'] ?? false, function ($q, $p) use ($filters) {
            return $q->with([
                'pembayaran:id,transaction_status',
                'user:id,email',
                'detail_penjualans.item:id,nama'
            ])->where('status_pengiriman', $filters['status_pengiriman'])
                ->whereBetween('tanggal_pembelian', [$p['start_date'], $p['end_date']]);
        }, function ($q) use ($filters) {
            return $q->with([
                'pembayaran:id,transaction_status',
                'user:id,email',
                'detail_penjualans.item:id,nama'
            ])
                ->where('status_pengiriman', $filters['status_pengiriman']);
        });
    }
}
