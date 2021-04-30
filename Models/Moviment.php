<?php

namespace Fnatic\Models;


use Illuminate\Database\Eloquent\Model;

class Moviment extends Model
{
    const CREDIT = "CREDIT";
    const DEBIT = "DEBIT";
    const REFOUND = "REFOUND";

    protected $fillable = ['idUser', 'value', 'movimentType'];
}
