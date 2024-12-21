<?php

namespace App\Repositories;

use App\Models\City;
use App\Models\All_Status;
use App\Models\Source;
use App\Models\User;
use App\Models\Lead;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use App\Interfaces\leadsRepositoryInterface;

class leadsRepository implements leadsRepositoryInterface
{
    #view lead

    public function  leadsCreate(){

        $cities = City::all();
        $statuses = All_Status::where('statusType', 1)->get();
        $sources = Source::all();
        $users = User::where('is_active', 1)->get();


        return [
            'cities' => $cities,
            'statuses' => $statuses,
            'sources' => $sources,
            'users' => $users,
        ];
    }

    #insert data in lead
    public function leadInsert(){
        
        return;
    }
}