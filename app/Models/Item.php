<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class)->withTrashed();
    }

    public function list_ukurans()
    {
        return $this->hasMany(List_ukuran::class);
    }

    public function wish_list()
    {
        return $this->hasOne(Wish_list::class);
    }

    public function scopeFilter($query, array $filter)
    {
        $query->when($filter['filter'] ?? false, function ($q, $f) {
            $q->when($f != 'latest' ?? false, function ($q) use ($f) {
                return $q->orderBy('harga', $f);
            }, function ($q) {
                return $q->latest();
            });
        }, function ($q) {
            return $q;
        });
        $query->when($filter['isChecked']  ? $filter['isChecked'] : false, function ($q, $c) {
            return $q->whereIn('kategori_id', $c);
        });
    }
}
