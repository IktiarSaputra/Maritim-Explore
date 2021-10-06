<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    //MEMBUAT RELASI KE MODEL DISTRICT.PHP
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    protected $appends = ['status_label', 'ref_status_label', 'commission','total'];

    public function getTotalAttribute()
    {
        return $this->subtotal + $this->cost;
    }

    public function getStatusLabelAttribute()
    {
        if ($this->status == 0) {
            return '<span class="badge badge-secondary">Baru</span>';
        } elseif ($this->status == 1) {
            return '<span class="badge badge-primary">Dikonfirmasi</span>';
        } elseif ($this->status == 2) {
            return '<span class="badge badge-info">Proses</span>';
        } elseif ($this->status == 3) {
            return '<span class="badge badge-warning">Dikirim</span>';
        }
        return '<span class="badge badge-success">Selesai</span>';
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function return()
    {
        return $this->hasOne(OrderReturn::class);
    }

    /**
     * Get the user associated with the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */

    public function getRefStatusLabelAttribute()
    {
        if ($this->ref_status == 0) {
            return '<span class="badge badge-secondary">Pending</span>';
        }
        return '<span class="badge badge-success">Dicairkan</span>';
    }

    public function getCommissionAttribute()
    {
        //KOMISINYA ADALAH 10% DARI SUBTOTAL
        $commission = ($this->subtotal * 10) / 100;
        //TAPI JIKA LEBIH DARI 10.000 MAKA YANG DIKEMBALIKAN ADALAH 10.000
        return $commission > 10000 ? 10000:$commission;
    }
}
