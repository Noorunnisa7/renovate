<?php

namespace App\Interfaces;


use Illuminate\Http\Request;

interface AdminRepositoryInterface
{
    public function getAllAdmin(array $select);
}