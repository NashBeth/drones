<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Contracts\IndustryContract;
use App\Models\Industry;
use Illuminate\Http\Request;

class IndustryController extends BaseController
{
    /**
     * @var IndustryContract
     */
    protected $industryRepository;

    /**
     * CategoryController constructor.
     * @param IndustryContract $industryRepository
     */
    public function __construct(IndustryContract $industryRepository)
    {
        $this->industryRepository = $industryRepository;
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $industries = $this->industryRepository->listIndustries();


        $this->setPageTitle('Industries', 'List of all industries');
        return view('admin.industries.index', compact('industries'));
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Industries', 'Create Industry');
        return view('admin.industries.create');
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:191',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $params = $request->except('_token');

        $industry = $this->industryRepository->createIndustry($params);

        if (!$industry) {
            return $this->responseRedirectBack('Error occurred while creating industry.', 'error', true, true);
        }
        return $this->responseRedirect('admin.industries.index', 'Industry added successfully', 'success', false, false);
    }
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $industry = $this->industryRepository->findIndustryById($id);

        $this->setPageTitle('Industries', 'Edit Industry : ' . $industry->name);
        return view('admin.industries.edit', compact('industry'));
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:191',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $params = $request->except('_token');

        $industry = $this->industryRepository->updateIndustry($params);

        if (!$industry) {
            return $this->responseRedirectBack('Error occurred while updating industry.', 'error', true, true);
        }
        return $this->responseRedirectBack('Industry updated successfully', 'success', false, false);
    }
    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $industry = $this->industryRepository->deleteIndustry($id);

        if (!$industry) {
            return $this->responseRedirectBack('Error occurred while deleting industry.', 'error', true, true);
        }
        return $this->responseRedirect('admin.industries.index', 'Industry deleted successfully', 'success', false, false);
    }
}
