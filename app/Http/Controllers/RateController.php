<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\RatingRequest;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       // $ratings = Rating::where('teacher_id',Auth()->user()->userable->id)->get();

        $query = Rating::query();
        $query->where('teacher_id',Auth()->user()->userable->id);

        if ($request->get('rating')) {
            $query->where('rating', $request->get('rating'));
        }

        $rating = $query->get();
        return view('teacher.view_rates',compact('ratings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RatingRequest $request)
    {
        $rating = new Rating();
        $rating->rating = $request->get('rating');
        $rating->description = $request->get('question_3');
        $rating->answer = $request->get('question_2');
        $rating->teacher_id = $request->get('teacher_id');
        $rating->user_id = Auth()->user()->id;
        $rating->save();

        Toastr::success('Rating is added successfully :)', 'Success');

        return array(
            'success'=>true
        );

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
