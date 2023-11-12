<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $with = [
        'form',
        'prescription',
        'impact',
        'substances',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function prescription()
    {
        return $this->belongsTo(Prescription::class);
    }

    public function impact()
    {
        return $this->belongsTo(Impact::class);
    }

    public function substances()
    {
        return $this->belongsToMany(Substance::class);
    }

    public function researches()
    {
        return $this->HasMany(Research::class);
    }
}
