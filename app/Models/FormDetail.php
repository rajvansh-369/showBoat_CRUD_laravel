<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_data_id',
        'pan',
        'aadhaar',
        'address'
    ];


    public function formDetail(){
        return $this->belongsTo(FormData::class);
    }


    public function district(){
        return $this->belongsTo(District::class);
    }
}
