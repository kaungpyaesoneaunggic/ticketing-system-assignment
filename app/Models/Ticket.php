<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;


    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_ticket', 'ticket_id', 'category_id');
    }

    public function category(){
        return $this->belongsTo(Category::class);
        //return $this->belongsTo(Category::class,"category_name","name");
    }

    public function labels()
    {
        return $this->belongsToMany(label::class, 'label_ticket', 'ticket_id', 'label_id');
    }


}

