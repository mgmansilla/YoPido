<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class login extends Model
{
    protected $table = 'login';

   protected $primaryKey ='id';

   public $timestamps = false ; // agrega dos columas de actualizacion y creacion

   protected $fillable = [
       'correo',
       'contrasena',
       
       
   ];
   /*public function ordenes()
   {
       return $this->belongsTo(Ordenes::class);

   }*/
   protected $guarded =[

   ];
}
