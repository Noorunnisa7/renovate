<?php

namespace App\Http\Controllers;
use App\Interfaces\LeadsRepositoryInterface;
use Illuminate\Http\Request;


class leadsController extends Controller
{
    protected $leadsRepository;

    public function __construct(LeadsRepositoryInterface $leadsRepository)
    {
        $this->leadsRepository = $leadsRepository;
    }

    public function  leadsView(){
        return view('leads.list');
    }
    


    public function leadsCreate()
    {
       
        $data = $this->leadsRepository->leadsCreate();

        return view('leads.create', $data);
    }

    public function storeLead(){
        
    }

   
}
