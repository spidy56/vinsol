<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    public function makeOrder($data)
    {
        $data['updated_at'] = now();
        $data['created_at'] = now();
        unset($data['_token']);
        $query_data = DB::table('cms')->insertGetId($data);
        return $query_data;
    }
}
