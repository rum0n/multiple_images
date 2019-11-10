<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{

    public function getPic()
    {
        return explode('|', $this->pic);
    }
}
