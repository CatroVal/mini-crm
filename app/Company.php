<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {
    //Indicar que tabla de la base de datos va a modificar este modelo
    protected $table = 'companies';

    //Relacion One To Many. Va a servir para sacar todos los trabajadores vinculados a una empresa
    public function employees() {
        return $this->hasMany('App\Employee');//->orderBy('last_name', 'desc');
    }
}
