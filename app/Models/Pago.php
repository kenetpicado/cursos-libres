<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    protected $fillable = ['alumno_id', 'grupo_id', 'concepto', 'monto', 'recibi_de', 'created_at'];

    public $timestamps = false;

    public function setConceptoAttribute($value)
    {
        $this->attributes['concepto'] = trim(strtoupper($value));
    }

    public function setRecibiDeAttribute($value)
    {
        $this->attributes['recibi_de'] = trim(strtoupper($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d-m-y', strtotime($value));
    }
}
