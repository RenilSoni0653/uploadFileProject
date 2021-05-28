<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'id'        => $row[0],
            'cust_name' => $row[1],
            'gender'    => $row[2], 
            'address'   => $row[3],
        ]);
    }
}
