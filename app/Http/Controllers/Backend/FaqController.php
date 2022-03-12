<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StoreFaqsRequest;
use App\Http\Requests\Backend\UpdateFaqsRequest;
use App\Models\Backend\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = 'Faq Management';

        $params = $request->all();

        $faqs = Faq::latest()->filter($params)->paginate(3);

        return view('backend.faqs.index', compact('page', 'faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = 'Add New Faqs';

        return view('backend.faqs.add', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFaqsRequest $request)
    {
        // Insert services into the database
        $returned_faq = Faq::create($request->all());

        // Check Result
        return alertInsert($returned_faq, 'faqs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = 'Edit Faq';

        $faq_edit = Faq::find($id);

        return view('backend.faqs.edit', compact('page', 'faq_edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFaqsRequest $request, $id)
    {
        $faq_update = Faq::find($id);

        // Update record in database
        $returned_faq = $faq_update->update($request->all());

        // Check Result
        return alertUpdate($returned_faq, 'faqs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faq_delete = Faq::destroy($id);

        return alertDelete($faq_delete, 'faqs.index');
    }
}
