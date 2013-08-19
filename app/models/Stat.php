<?php

class Stat extends Eloquent {
    
    protected $guarded = array();

    public static $rules = array();
    
    public $timestamps = false;

    protected $table = 'stats';
   
}