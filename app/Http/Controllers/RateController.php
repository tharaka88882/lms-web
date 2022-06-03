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

       // dd($request->get('search_rating'));
       // $ratings = Rating::where('teacher_id',Auth()->user()->userable->id)->get();

       $ratings = Rating::where('teacher_id',Auth()->user()->userable_id)->get();
       $rator_count = count(json_decode( $ratings,true));
       $rating_count = 0;
       $q2_true_count = 0;
       $mediation = 0;
       $relevance = 0;
           foreach($ratings as $rating){
               $rating_count+=$rating->rating;
               if($rating->answer==1){
                $q2_true_count +=1;
               }
           }
      if($rator_count!=0){
       $mediation = $rating_count/$rator_count;
      }
      if($rator_count!=0){
       $relevance = ($q2_true_count/$rator_count)*100;
      }

        $query = Rating::query();
        $query->where('teacher_id',Auth()->user()->userable->id);

        if($request->get('search_rating')!=null){

        if (($request->get('search_rating')!='Any')) {
            $query->where('rating', $request->get('search_rating'));
        }
        }

        if($request->get('q2')!=null){
            $query->where('answer', $request->get('q2'));
        }

        $ratings = $query->get();
        $avg_time = rand(1,5);
        return view('teacher.view_rating',compact('ratings','mediation','relevance','avg_time','request'));

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
