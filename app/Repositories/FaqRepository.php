<?php

namespace App\Repositories;

use App\Http\Controllers\FaqController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Interfaces\FaqRepositoryInterface;
use App\Models\FaqCategory;
use App\Models\Faq;


class FaqRepository implements FaqRepositoryInterface
{
    # CATEGORY
    // public function getAgency($filters, $select = [])
    // {
    //     return Agency::select($select)
    //         ->where($filters)
    //         ->where('customer_id', request()->input('customer_id'))
    //         ->first();
    // }



    public function getAllCategory(array $select)
    {
        return FaqCategory::select($select)->get();
    }

    public function createCategory($data)
    {

        return FaqCategory::create($data);
    }

    public function getCategory(array $filters, array $select)
    {

        return FaqCategory::select($select)
            ->where($filters)
            ->get();
    }

    public function updateCategory(array $where, array $data)
    {

        $category = FaqCategory::where($where)->first();


        if ($category) {
            $category->update($data);
            return $category;
        }

        return null;
    }

    public function deleteCategory(array $filters)
    {
        $category = FaqCategory::where($filters)->first();

        if ($category) {
            return FaqCategory::where($filters)->first()->delete();
        }

        return null;
    }

    # FAQ
    public function createFaq(array $data)
    {
        return Faq::create($data);
    }

    public function getAllFaqs(array $select)
    {
        return Faq::select($select)->with('category')->get();
    }

    public function getFaq(array $filters, array $select)
    {
        // return Faq::where(['category_id' => 1])->select($select)->with('category')->get();
        return 
        Faq::where($filters)->select($select)
        ->whereHas('category', function ($query) {
            $query->whereNull('deleted_at');
        })
        ->with('category')
        ->get();
    }

  
    public function updateFaq($id, array $data)
    {
        $faq = Faq::find($id);
        if ($faq) {
            $faq->update($data);
            return $faq;
        }
        return null;
    }

    // Soft delete FAQ
    public function deleteFaq($id)
    {
        $faq = Faq::find($id);
        if ($faq) {
            $faq->delete();
            return true;
        }
        return false;
    }

}