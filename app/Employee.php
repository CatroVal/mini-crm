<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model {
    protected $table = 'employees';

    protected $fillable = ['company_id'];

    //Relacion Many To One.
    public function company() {
        return $this->belongsTo('App\Company', 'company_id');
    }
}
