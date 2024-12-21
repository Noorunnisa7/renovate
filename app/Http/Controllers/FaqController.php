<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Interfaces\FaqRepositoryInterface;
use App\Http\Requests\FaqCategoryRequest;
use App\Http\Requests\FaqRequest;

class FaqController extends Controller
{
    private FaqRepositoryInterface $faqRepository;

    public function __construct(FaqRepositoryInterface $faqRepository)
    {
        $this->faqRepository = $faqRepository;
    }

    #Category 
    public function indexCategory()
    {
        return ApiResponse::sendSuccess(
            [
                'data' =>
                $this->faqRepository->getAllCategory(['id', 'category', 'is_active'])
            ]
        );
    }

    public function  storeCategory(FaqCategoryRequest $request)
    {

        return ApiResponse::sendSuccess(
            [
                'data' => (bool) $this->faqRepository->createCategory($request->all())

            ]
        );
    }

    public function showCategory($id)
    {
        return ApiResponse::sendSuccess(
            [
                'data' =>
                $this->faqRepository->getCategory(['id' => $id], ['id', 'category', 'is_active'])
            ]
        );
    }

    public function updateCategorye(FaqCategoryRequest $request, $id)
    {

        $validatedData = $request->validated();

        $updatedCategory = $this->faqRepository->updateCategory(['id' => $id], $validatedData);

        if ($updatedCategory) {
            return ApiResponse::sendSuccess([
                'data' =>  (bool) $updatedCategory
            ]);
        }

        return ApiResponse::sendError('Category not found', 404);
    }

    public function deleteCategorye($id)
    {

        $updatedCategory = $this->faqRepository->deleteCategory(['id' => $id]);

        if ($updatedCategory) {
            return ApiResponse::sendSuccess([
                'data' =>  (bool) $updatedCategory
            ]);
        }

        return ApiResponse::sendError('Category not found', 404);
    }


    #FAQ 
    public function createFaq(FaqRequest $request)
    {
        return ApiResponse::sendSuccess([
            'data' => (bool) $this->faqRepository->createFaq($request->all())
        ]);
    }

    public function getAllFaqs()
    {

        return ApiResponse::sendSuccess([
            'data' => $this->faqRepository->getAllFaqs(['id', 'question', 'answer', 'sort_number', 'is_active', 'category_id'])
        ]);
    }

    // Get FAQ by ID
    public function getFaq($id)
    {
        return ApiResponse::sendSuccess([
            'data' => $this->faqRepository->getFaq(['id' => $id], ['id', 'question', 'answer', 'sort_number', 'is_active', 'category_id'])
        ]);
    }

    public function getFaqByCategory($categoryID)
    {
        return ApiResponse::sendSuccess([
            'data' => $this->faqRepository->getFaq(['category_id' => $categoryID], ['id', 'question', 'answer', 'sort_number', 'is_active', 'category_id'])
        ]);
    }

    public function updateFaq(FaqRequest $request, $id)
    {
        // $validatedData = $request->validated();
       
        $faq = $this->faqRepository->updateFaq($id, $request->all());

        if ($faq) {
            return ApiResponse::sendSuccess([
                'data' => (bool) $faq
            ]);
        }

        return ApiResponse::sendError('FAQ not found', 404);
        
    }

    public function deleteFaq($id)
    {
        $isDeleted = $this->faqRepository->deleteFaq($id);

        if ($isDeleted) {
            return ApiResponse::sendSuccess([
                'data' => (bool) $isDeleted
            ]);
        }

        return ApiResponse::sendError('FAQ not found', 404);
    }
}
