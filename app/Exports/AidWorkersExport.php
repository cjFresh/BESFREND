<?php

namespace App\Exports;

use App\AidWorker;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings; // used for adding header row
use Illuminate\Support\Facades\DB; //-> in order to use db schema builder

//class EvacsExport implements FromCollection (mas paspas ang fromquery)
class AidWorkersExport implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {   

        return AidWorker::select('person_id', 'field', 'status')->orderBy('id', 'desc');
     //  return AidWorker::all();// select('field', 'status', 'person.first_name', 'person.middle_name', 'person.last_name')->get();
     /*   return DB::table('aid_workers')
        ->leftJoin('people', 'people.id', '=', 'aid_workers.person_id')
        ->select('people.first_name', 'people.middle_name', 'people.last_name', 'aid_workers.field', 'aid_workers.status')
        ->orderBy('id', 'desc');
        
        // ->get();
    */
    }

    public function headings(): array
    {
        return [
            'Name',
            'Field',
            'Status'
        ];
    }
    /*
    public function collection()
    {
        //other way of retrieving with joins
        return DB::table('posts')
                        ->leftJoin('users', 'users.id', '=', 'posts.user_id')
                        ->select('posts.title','posts.body','users.name')
                        ->get();
    }*/
}
