<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Agent;
use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Http\Requests\AgentRequest;
use App\Interfaces\AgentRepositoryInterface;

class ExampleController extends Controller
{

    // protected $companyRepository;
    private ExampleController $agentRepository;

    public function __construct(ExampleController $agentRepository)
    {
        $this->agentRepository = $agentRepository;
    }

    public function index()
    {
        return ApiResponse::sendSuccess(
            [
                'data' => 
                $this->agentRepository->getAllAgent(['agents.id', 'agents.name', 'agents.cnic', 'agents.email'], ['companies.id', 'companies.name'])
            ]
        );
    }

    public function store(AgentRequest $request)
    {
        return ApiResponse::sendSuccess(
            [
                'data' => (bool) $this->agentRepository->createAgent($request->all())

            ]
        );
    }


    public function edit(Request $request, $id)
    {
        
        return ApiResponse::sendSuccess(
            [
                'data' => (bool) $this->agentRepository->updateAgent($request->all(), $id)

            ]
        );
    }

    
    public function getAgentByID($id)
    {
        return ApiResponse::sendSuccess(
            [
                'data' =>  $this->agentRepository->getAgentByID(['id' => $id], ['agents.id', 'agents.name', 'agents.cnic', 'agents.email'], ['companies.id', 'companies.name'])

            ]
        );
    }

    public function delete($id)
    {
        return ApiResponse::sendSuccess(
            [
                'data' =>  (bool) $this->agentRepository->deleteAgent(['id' => $id])

            ]
        );
    }

    //USER-API
    // public function getagentByCompanyId($id)
    // {
    //     return ApiResponse::sendSuccess(
    //         [
    //             'data' => $this->agentRepository->getAgentByCompanyID($id)
    //         ]
    //     );
    // }
  
}
