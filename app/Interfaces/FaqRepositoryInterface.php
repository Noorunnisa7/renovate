<?php

namespace App\Interfaces;


use Illuminate\Http\Request;

interface FaqRepositoryInterface
{
    # Category
    public function createCategory(array $data);
    public function getAllCategory(array $select);
    public function getCategory(array $filters, array $select);
    public function updateCategory(array $where, array $data);
    public function deleteCategory(array $filters);

    # FAQ
    public function createFaq(array $data);
    public function getAllFaqs(array $select);
    public function getFaq(array $filters, array $select);
    public function updateFaq($id, array $data);
    public function deleteFaq($id);

}