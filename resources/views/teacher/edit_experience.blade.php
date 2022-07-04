@extends('layouts.app')

@section('title')
    Edit My Experience
@endsection

@push('script')
    <script type="text/javascript">
        $(function() {
            $("#dpic").datepicker({
                dateFormat: 'yy'
            });
        });
    </script>
@endpush

@push('styles')
    {{-- <style>h1 {background-color: red !important}</style> --}}

    <style>
        /* * {
                                                                                                                                                                                                                                                                                                                            box-sizing: border-box;
                                                                                                                                                                                                                                                                                                                        }

                                                                                                                                                                                                                                                                                                                        body {
                                                                                                                                                                                                                                                                                                                            font: 16px Arial;
                                                                                                                                                                                                                                                                                                                        } */

        /*the container must be positioned relative:*/
        .autocomplete {
            position: relative;
            display: inline-block;
        }

        input {
            border: 1px solid transparent;
            background-color: #f1f1f1;
            padding: 10px;
            font-size: 16px;
        }

        input[type=text] {
            background-color: #f1f1f1;
            width: 100%;
        }

        input[type=submit] {
            background-color: DodgerBlue;
            color: #fff;
            cursor: pointer;
        }

        .autocomplete-items {
            position: absolute;
            border: 1px solid #d4d4d4;
            border-bottom: none;
            border-top: none;
            z-index: 99;
            /*position the autocomplete items to be the same width as the container:*/
            top: 100%;
            left: 0;
            right: 0;
        }

        .autocomplete-items div {
            padding: 10px;
            cursor: pointer;
            background-color: #fff;
            border-bottom: 1px solid #d4d4d4;
        }

        /*when hovering an item:*/
        .autocomplete-items div:hover {
            background-color: #e9e9e9;
        }

        /*when navigating through the items using the arrow keys:*/
        .autocomplete-active {
            background-color: DodgerBlue !important;
            color: #ffffff;
        }
    </style>
@endpush

@section('content')

   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          {{-- <h1>YOU2MENTOR</h1> --}}
        </div>
        {{-- <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item active">Edit My  Mentoring Topics </li>
          </ol>
        </div> --}}
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">

    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Edit Experience</h3>
            </div>
            <!-- /.card-header -->
            <!--Make sure the form has the autocomplete function switched off:-->
            <form autocomplete="off"
            action="{{ route('user.edit_experience', $experiences->id) }}"
            method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="autocomplete"
                                style="width:100%;">
                                <label
                                    for="exampleInputEmail1">Position</label>
                                <input id="position1" type="text"
                                    name="position"
                                    value="{{ $experiences->position->text }}"
                                    placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="autocomplete @if ($errors->has('company')) {{ 'is-invalid' }} @endif"
                                style="width:100%;">
                                <label
                                    for="exampleInputEmail1">Company</label>
                                <input id="ins2" type="text"
                                    name="company"
                                    value="{{ $experiences->institute->text }}"
                                    placeholder="">
                            </div>

                            @if ($errors->has('company'))
                                <span class="invalid-feedback"
                                    role="alert">
                                    <strong>{{ $errors->first('company') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="autocomplete"
                                style="width:100%;">
                                <label
                                    for="exampleInputEmail1">Location</label>
                                <input type="text" name="location"
                                    value="{{ $experiences->location }}"
                                    class="@if ($errors->has('location')) {{ 'is-invalid' }} @endif">
                            </div>

                            @if ($errors->has('location'))
                                <span class="invalid-feedback"
                                    role="alert">
                                    <strong>{{ $errors->first('location') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input
                                    id="present{{ $experiences->id }}"
                                    class="form-check-input"
                                    {{ $experiences->end_date != null ? '' : 'checked' }}
                                    type="checkbox">
                                <label class="form-check-label">I am
                                    currently working in this
                                    role</label>
                            </div>
                        </div>



                        <div class="row">
                            {{-- <label for="exampleInputEmail1">Time of work</label> --}}
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label
                                        for="exampleInputEmail1">Start</label>
                                    <input name="start_date"
                                        placeholder="Start Year"
                                        class="form-control @if ($errors->has('start_date')) {{ 'is-invalid' }} @endif"
                                        type="date"
                                        value="{{ $experiences->start_date }}" />

                                    @if ($errors->has('start_date'))
                                        <span class="invalid-feedback"
                                            role="alert">
                                            <strong>{{ $errors->first('start_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label
                                        for="exampleInputEmail1">End</label>
                                    <input
                                        id="end_y{{ $experiences->id }}"
                                        name="end_date"
                                        placeholder="End Year"
                                        class="form-control @if ($errors->has('end_date')) {{ 'is-invalid' }} @endif"
                                        type="date"
                                        value="{{ $experiences->end_date }}" />

                                    @if ($errors->has('end_date'))
                                        <span class="invalid-feedback"
                                            role="alert">
                                            <strong>{{ $errors->first('end_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit"
                    class="btn btn-warning pull-right">Update</button>
            </div>
        </form>
            {{-- <form action="{{route('teacher.delete_schedule', $id)}}" id="deleteform" method="POST">
                @csrf
                @method('delete')
            </form> --}}
        </div>
      </div>

  </section>
  @push('scripts')
                                <script>
                                    if ($('#present{{ $experiences->id }}').is(':checked')) {
                                        // alert("t");
                                        $('#end_y{{ $experiences->id }}').prop('disabled', true);
                                    } else {
                                        //alert("tjio");
                                        $('#end_y{{ $experiences->id }}').prop('disabled', false);
                                    }
                                    $('#present{{ $experiences->id }}').click(function() {
                                        if ($('#present{{ $experiences->id }}').is(':checked')) {
                                            // alert("t");
                                            $('#end_y{{ $experiences->id }}').prop('disabled', true);
                                        } else {
                                            //alert("tjio");
                                            $('#end_y{{ $experiences->id }}').prop('disabled', false);
                                        }
                                    });
                                </script>

                                <script>

                                    // Qualifications Auto Complete
        function autocomplete(inp, arr) {
            /*the autocomplete function takes two arguments,
            the text field element and an array of possible autocompleted values:*/
            var currentFocus;
            /*execute a function when someone writes in the text field:*/
            inp.addEventListener("input", function(e) {
                var a, b, i, val = this.value;
                /*close any already open lists of autocompleted values*/
                closeAllLists();
                if (!val) {
                    return false;
                }
                currentFocus = -1;
                /*create a DIV element that will contain the items (values):*/
                a = document.createElement("DIV");
                a.setAttribute("id", this.id + "autocomplete-list");
                a.setAttribute("class", "autocomplete-items");
                /*append the DIV element as a child of the autocomplete container:*/
                this.parentNode.appendChild(a);
                /*for each item in the array...*/
                for (i = 0; i < arr.length; i++) {
                    /*check if the item starts with the same letters as the text field value:*/
                    if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                        /*create a DIV element for each matching element:*/
                        b = document.createElement("DIV");
                        /*make the matching letters bold:*/
                        b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                        b.innerHTML += arr[i].substr(val.length);
                        /*insert a input field that will hold the current array item's value:*/
                        b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                        /*execute a function when someone clicks on the item value (DIV element):*/
                        b.addEventListener("click", function(e) {
                            /*insert the value for the autocomplete text field:*/
                            inp.value = this.getElementsByTagName("input")[0].value;
                            /*close the list of autocompleted values,
                            (or any other open lists of autocompleted values:*/
                            closeAllLists();
                        });
                        a.appendChild(b);
                    }
                }
            });
            /*execute a function presses a key on the keyboard:*/
            inp.addEventListener("keydown", function(e) {
                var x = document.getElementById(this.id + "autocomplete-list");
                if (x) x = x.getElementsByTagName("div");
                if (e.keyCode == 40) {
                    /*If the arrow DOWN key is pressed,
                    increase the currentFocus variable:*/
                    currentFocus++;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 38) { //up
                    /*If the arrow UP key is pressed,
                    decrease the currentFocus variable:*/
                    currentFocus--;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 13) {
                    /*If the ENTER key is pressed, prevent the form from being submitted,*/
                    e.preventDefault();
                    if (currentFocus > -1) {
                        /*and simulate a click on the "active" item:*/
                        if (x) x[currentFocus].click();
                    }
                }
            });

            function addActive(x) {
                /*a function to classify an item as "active":*/
                if (!x) return false;
                /*start by removing the "active" class on all items:*/
                removeActive(x);
                if (currentFocus >= x.length) currentFocus = 0;
                if (currentFocus < 0) currentFocus = (x.length - 1);
                /*add class "autocomplete-active":*/
                x[currentFocus].classList.add("autocomplete-active");
            }

            function removeActive(x) {
                /*a function to remove the "active" class from all autocomplete items:*/
                for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("autocomplete-active");
                }
            }

            function closeAllLists(elmnt) {
                /*close all autocomplete lists in the document,
                except the one passed as an argument:*/
                var x = document.getElementsByClassName("autocomplete-items");
                for (var i = 0; i < x.length; i++) {
                    if (elmnt != x[i] && elmnt != inp) {
                        x[i].parentNode.removeChild(x[i]);
                    }
                }
            }
            /*execute a function when someone clicks in the document:*/
            document.addEventListener("click", function(e) {
                closeAllLists(e.target);
            });
        }

        // End of Qualifications Auto Complete

         var ins = [];
        @foreach ($institutes as $in)
            ins.push('{{ $in->text }}');
        @endforeach
        var pos = [];
        @foreach ($position as $po)
            pos.push('{{ $po->text }}');
        @endforeach

        /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
        autocomplete(document.getElementById("myInput"), ins);
        autocomplete(document.getElementById("myInput1"), ins);
        autocomplete(document.getElementById("ins"), ins);
        autocomplete(document.getElementById("ins2"), ins);
        autocomplete(document.getElementById("position"), pos);
        autocomplete(document.getElementById("position1"), pos);
                                </script>

                            @endpush
@endsection
