<?php



namespace App\Http\Controllers;



use App\Models\Subject;

use Brian2694\Toastr\Facades\Toastr;

use Illuminate\Http\Request;

use Illuminate\Support\Str;



class SubjectController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        $subjects = Subject::paginate(20);

        // return dd($subjects);

        return view('admin.subject_list', compact('subjects'));

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        return view('admin.add_subject');

    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required',
        ]);

        $subject_list = Subject::all();

        $flag = true;

        foreach ($subject_list as $subjects) {

            if (Str::lower($request->get('name')) == Str::lower($subjects->name)) {

                $flag = false;

            }

        }

        if ($flag) {

            $subject = new Subject();

            $subject->name = $request->get('name');

            $subject->status = 1;

            $subject->save();

            Toastr::success('Subject Added successfully :)', 'Success');

        } else {

            Toastr::error('Duplicate Subject Name :(', 'Error');

            //return redirect()->route('admin.create_subject');

        }

        return redirect()->route('admin.subjects');

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

        $subject =  Subject::findOrFail($id);

        return view('admin.edit_subject', compact('id', 'subject'));

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

        $validated = $request->validate([
            'name' => 'required',
        ]);

        $subject = Subject::findOrFail($id);

        $subject->name = $request->get('name');

        if ($request->get('status') == 'on') {

            $subject->status = '1';

        } else {

            $subject->status = '0';

        }

        $subject->save();

        Toastr::success('Subject Updated successfully :)', 'Success');

        return redirect()->route('admin.edit_subject', $id);

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();
        Toastr::success('Subject Deleted successfully :)', 'Deleted');
        return redirect()->route('admin.subjects');
    }

}

