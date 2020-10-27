<?php

namespace App\Exports;

use App\Studentinfo;
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Studentinfo::all();
    }
}
