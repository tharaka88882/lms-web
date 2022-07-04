@extends('layouts.app')



@section('title')
    Find a Mentor
@endsection



@push('styles')
    {{-- <style>h1 {background-color: red !important}</style> --}}
    <style>
        .eletest {
            height: 37px !important;
        }


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
            top: 41%;
            left: 9px;
            right: 9px;
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
    <section class="content-header">

        <div class="container-fluid">

            <div class="row">

                <div class="col-md-12">

                    <!-- USERS LIST -->

                    <div class="card">

                        <div class="card-header">

                            <h3 class="card-title">Find a Mentor</h3>



                            <div class="card-tools">

                                <button type="button" class="btn btn-tool" data-card-widget="collapse">

                                    <i class="fas fa-minus"></i>

                                </button>

                                <button type="button" class="btn btn-tool" data-card-widget="remove">

                                    <i class="fas fa-times"></i>

                                </button>

                            </div>

                        </div>

                        <!-- /.card-header -->

                        <div class="card-body p-10">

                            <div class="col-md-12">

                                <form autocomplete="off" action="{{ route('teacher.mentors') }}">

                                    <div class="row">


                                        <div class="col-lg-3">

                                            <div class="form-group" id="currentModal">

                                                <label> Mentoring Topics:</label>


                                                <select name="search_subject"
                                                    class="form-control select22 @if ($errors->has('search_subject')) {{ 'is-invalid' }} @endif"
                                                    id="select2-echannel-doctor">

                                                    {{-- <option>Any</option> --}}

                                                </select>

                                            </div>

                                            <div class="form-group">

                                                <label>Sort Order:</label>

                                                <select class="select2 form-control" style="width: 100%;">

                                                    <option selected>Rating High to Low</option>

                                                    <option>Rating Low to High</option>

                                                </select>

                                            </div>

                                        </div>

                                        <div class="col-lg-3">

                                            <div class="form-group">

                                                <label> Name:</label>

                                                <input placeholder="Enter Mentor name" class="select2 form-control"
                                                    data-placeholder="Any" name="m_name" />

                                            </div>
                                            <div class="form-group">

                                                <label> Company:</label>

                                                <input placeholder="Enter Company" class="select2 form-control"  name="company" id="company"/>

                                            </div>


                                        </div>

                                        <div class="col-lg-3">

                                            <div class="form-group">

                                                <label>City:</label>

                                                <input placeholder="Enter City" class="select2 form-control autocomplete"
                                                    name="city" id="city" />

                                            </div>

                                            <div class="form-group" id="">
                                                <label>Industry:</label>
                                                <input type="text" class="form-control" style="width: 100%;"
                                                    name="search_industry" id="search_industry"/>
                                            </div>

                                        </div>

                                        <div class="col-lg-3">

                                            <div class="form-group">

                                                <label> Country:</label>

                                                <input autocomplete="off" id="country" placeholder="Enter Country" class="select2 form-control autocomplete"
                                                    name="country"/>

                                            </div>


                                        </div>
                                        <button class="btn btn-success" style="margin-top: 30px;">Search</button>


                                        @csrf
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- /.card-body -->

                    </div>

                    <!--/.card -->

                </div>

            </div>

            <div class="row">

                <div class="col-md-12">

                    <!-- USERS LIST -->
                    <div class="card">
                        <div class="card-header">

                            <h3 class="card-title">Mentors List</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>

                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <!-- /.card-header -->

                        <div class="card-body p-0">
                            <div class="row">

                                @foreach ($tutors as $tutor)
                                    @php
                                    ($from_leave = \Carbon\Carbon::parse($tutor->user->from_leave));
                                    ($to_leave = \Carbon\Carbon::parse($tutor->user->to_leave));

                                    $period = \Carbon\CarbonPeriod::create($from_leave,$to_leave);
                                    $flag = true;
                                    @endphp

                                    @foreach ($period as $date)
                                        @if ($date->isToday())
                                            @php
                                                $flag = false;
                                            @endphp

                                            @if ($tutor->user->leave_status == 0)
                                            @php
                                                $flag = true;
                                            @endphp
                                            @endif
                                        @endif
                                    @endforeach

                                    <div class="col-md-6">
                                        <div class="card p-3">
                                            <div class="d-flex align-items-center">
                                                <a href="{{ route('teacher.view_mentor', $tutor->id) }}">
                                                    <img @if ($tutor->user->image != null) src="{{ url('public') }}/images/profile/{{ $tutor->user->image }}" @else src="" @endif
                                                        alt="User Image"
                                                        style="width: 120px; height: 120px; border-radius: 50%;"
                                                        onerror=" this.src='{{ url('public') }}/theme/admin/dist/img/default-avatar.jpg'">
                                                </a>
                                                <div class="ml-3 w-100">
                                                    <h4 class="mb-0 mt-0"><a style="text-transform: capitalize"
                                                            href="{{ route('teacher.view_mentor', $tutor->id) }}">{{ $tutor->user->name }}</a>
                                                    </h4>

                                                    @php
                                                        $mediation = 0;
                                                        $rator_count = count(json_decode($tutor->rate, true));
                                                        $rating_count = 0;
                                                        $mediation = 0;
                                                    @endphp
                                                    @foreach ($tutor->rate as $rating1)
                                                        @php
                                                            $rating_count += $rating1->rating;
                                                        @endphp



                                                        @if ($rator_count != 0)
                                                            @php
                                                                $mediation = $rating_count / $rator_count;
                                                            @endphp
                                                        @endif

                                                        @php
                                                            $round_mediation = (int) $mediation;
                                                        @endphp
                                                    @endforeach

                                                    @php
                                                        $i = 0;
                                                        //$r = intval(Auth()->user()->userable->level);
                                                        $r = (int) $mediation;
                                                    @endphp
                                                    @while ($i < 5)
                                                        @if ($r > 0)
                                                            <span class="fa fa-star checked"
                                                                style="color:rgb(255, 153, 0);"></span>
                                                        @else
                                                            <span class="fa fa-star"></span>
                                                        @endif
                                                        @php
                                                            $i += 1;
                                                            $r -= 1;
                                                        @endphp
                                                    @endwhile



                                                    @if ($tutor->user->industry != null)
                                                        <span class="users-list-date">Industry -
                                                            {{ $tutor->user->industry }}</span>
                                                    @endif
                                                    {{-- @if ($tutor->user->job != null)
                                                        <span class="users-list-date">Job Title -
                                                            {{ $tutor->user->job }}</span>
                                                    @endif --}}

                                                    @if (sizeof($tutor->experiences) > 0)
                                                        @php
                                                            $sizeArr = sizeof($tutor->experiences);
                                                            $i = 0;
                                                        @endphp
                                                        @foreach ($tutor->experiences as $experience)
                                                            @php
                                                                $i++;
                                                            @endphp
                                                            @if ($i == $sizeArr)
                                                                <span
                                                                    class="users-list-date">{{ $experience->position->text }}</span>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    {{-- <span class="users-list-date">Timely Responce - {{ $tutor->avg_time }} hour</span> --}}

                                                    @if (count($tutor->subjects) > 0)
                                                        <div class="p-2 mt-2 bg-light d-flex justify-content-between rounded text-white stats"
                                                            style="font-size: 14px;">
                                                            <span>Skills -
                                                                @foreach ($tutor->subjects as $subject)
                                                                    <span class="badge"
                                                                        style="color: #564b4b; background-color: #868f976b; !important">{{ $subject['name'] }}</span>
                                                                @endforeach
                                                            </span>
                                                        </div>
                                                    @endif
                                                    @if ($tutor->user->country != null)
                                                        <span
                                                            class="users-list-date">{{ $tutor->user->country }}/{{ $tutor->user->city }}</span>
                                                    @endif

                                                    <div class="button mt-2 d-flex flex-row align-items-center">
                                                        <a href="{{ route('teacher.view_mentor', $tutor->id) }}">
                                                            <button class="btn btn-sm btn-outline-primary w-100">View
                                                                Profile</button>
                                                        </a>
                                                        @if ($tutor->conversation != null)
                                                            @if ($flag == false)
                                                                <button class="btn btn-sm btn-primary ml-2"
                                                                    disabled>Message</button>
                                                            @else
                                                                <a
                                                                    href="{{ route('teacher.view_mentor_conversation', $tutor->conversation['id']) }}">
                                                                    <button
                                                                        class="btn btn-sm btn-primary w-100 ml-2">Message</button>
                                                                </a>
                                                            @endif
                                                        @else
                                                            <form
                                                                action="{{ route('teacher.store_mentor_conversation') }}"
                                                                method="POST">
                                                                @csrf
                                                                <input type="hidden" name="student_id"
                                                                    value="{{ Auth()->user()->userable->id }}">
                                                                <input type="hidden" name="teacher_id"
                                                                    value="{{ $tutor->id }}">
                                                                <button {{ $flag == false ? 'disabled' : '' }}
                                                                    class="btn btn-sm btn-primary w-100 ml-2"
                                                                    type="submit">Message</button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="card-footer text-right"> --}}
                                            <span class="users-list-date text-right">Average Responce Time -
                                                {{-- {{ $tutor->avg_time }} hour(s) --}}
                                            @if ($tutor->avg_time=='1')
                                                {{ $tutor->avg_time }} hour
                                            @else
                                                {{ $tutor->avg_time }} hours
                                            @endif
                                            </span>
                                            {{-- </div> --}}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!--/.card -->
                </div>

            </div>

        </div>

    </section>
@endsection



@push('scripts')
    <script>
        $(function() {

            //Initialize Select2 Elements

            $('.select22').select2({
                dropdownParent: $('#currentModal')
            });
            // $('.select2').select2({
            //     dropdownParent: $('#currentModal1')
            // });



            $('#select2-echannel-doctor').select2({
                ajax: {
                    method: 'GET',
                    url: '{{ route('student.get_topics') }}',
                    contentType: "application/json; charset=utf-8",
                    dataType: 'json',
                    data: function(params) {
                        var query = {
                            search: params.term,
                            _method: "GET",
                            // _token: "{{ csrf_token() }}",
                            type: 'public'
                        };
                        // Query parameters will be ?search=[term]&type=public
                        return query;
                    },

                    processResults: function(data) {
                        // Transforms the top-level key of the response object from 'items' to 'results'
                        return {
                            results: data.results
                        };
                    }
                },
                dropdownParent: $('#currentModal')
            });


            // $('#search_industry').select2({

            //     ajax: {

            //         method: 'GET',

            //         url: '{{ route('teacher.get_industry') }}',

            //         contentType: "application/json; charset=utf-8",

            //         dataType: 'json',

            //         data: function(params) {

            //             var query = {

            //                 search: params.term,

            //                 _method: "GET",

            //                 // _token: "{{ csrf_token() }}",

            //                 type: 'public'

            //             };

            //             // Query parameters will be ?search=[term]&type=public

            //             return query;

            //         },

            //         processResults: function(data) {

            //             // Transforms the top-level key of the response object from 'items' to 'results'

            //             return {

            //                 results: data.results

            //             };

            //         }

            //     },

            //     // dropdownParent: $('#currentModal')

            // });
        });

        $(document).ready(function() {
            document.querySelectorAll('[role="combobox"]').forEach(function(el) {
                el.classList.add("eletest");
            });
            console.log("ready!");
        });


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



        /*An array containing all the country names in the world:*/
        var countries = ["Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Anguilla", "Antigua & Barbuda",
            "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh",
            "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia & Herzegovina",
            "Botswana", "Brazil", "British Virgin Islands", "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia",
            "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central Arfrican Republic", "Chad", "Chile", "China",
            "Colombia", "Congo", "Cook Islands", "Costa Rica", "Cote D Ivoire", "Croatia", "Cuba", "Curacao", "Cyprus",
            "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt",
            "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands", "Faroe Islands",
            "Fiji", "Finland", "France", "French Polynesia", "French West Indies", "Gabon", "Gambia", "Georgia",
            "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guam", "Guatemala", "Guernsey",
            "Guinea", "Guinea Bissau", "Guyana", "Haiti", "Honduras", "Hong Kong", "Hungary", "Iceland", "India",
            "Indonesia", "Iran", "Iraq", "Ireland", "Isle of Man", "Israel", "Italy", "Jamaica", "Japan", "Jersey",
            "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Kosovo", "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon",
            "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia",
            "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania",
            "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro", "Montserrat", "Morocco",
            "Mozambique", "Myanmar", "Namibia", "Nauro", "Nepal", "Netherlands", "Netherlands Antilles",
            "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "North Korea", "Norway", "Oman",
            "Pakistan", "Palau", "Palestine", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland",
            "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russia", "Rwanda", "Saint Pierre & Miquelon",
            "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles",
            "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa",
            "South Korea", "South Sudan", "Spain", "Sri Lanka", "St Kitts & Nevis", "St Lucia", "St Vincent", "Sudan",
            "Suriname", "Swaziland", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand",
            "Timor L'Este", "Togo", "Tonga", "Trinidad & Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks & Caicos",
            "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States of America",
            "Uruguay", "Uzbekistan", "Vanuatu", "Vatican City", "Venezuela", "Vietnam", "Virgin Islands (US)", "Yemen",
            "Zambia", "Zimbabwe"
        ];

        var ins = [];
        @foreach ($institutes as $in)
            ins.push('{{ $in->text }}');
        @endforeach
        var indu = [];
        @foreach ($industries as $ind)
            indu.push('{{ $ind->name }}');
        @endforeach
        /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
        autocomplete(document.getElementById("country"), countries);
        autocomplete(document.getElementById("city"), countries);
        autocomplete(document.getElementById("company"), ins);
        autocomplete(document.getElementById("search_industry"), indu);
    </script>
@endpush
