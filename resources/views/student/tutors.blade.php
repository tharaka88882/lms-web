@extends('layouts.app')



@section('title')

    Find a Mentor

@endsection



@push('styles')

    {{-- <style>h1 {background-color: red !important}</style> --}}
    <style>
        .eletest{
            height: 37px !important;
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

                                <form action="{{ route('student.tutors') }}">
                                    @csrf
                                    <div class="row">

                                        <div class="col-lg-3">

                                            <div class="form-group">

                                                <label>Name:</label>

                                                <input placeholder="Enter Mentor Name" class="select2 form-control" data-placeholder="Any" name="m_name"/>

                                            </div>


                                        </div>


                                        <div class="col-lg-3">

                                            <div class="form-group" id="currentModal">

                                                <label> Mentoring Topics:</label>



                                                 <select  name="search_subject" class="form-control select22 select2 @if($errors->has('search_subject')) {{'is-invalid'}} @endif" id="select2-echannel-doctor"  size="30">

                                                    {{-- <option>Any</option> --}}

                                                </select>

                                            </div>


                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">

                                                <label>Sort Order:</label>

                                                <select class="form-control" style="width: 100%;">

                                                    <option selected>Rating ASC</option>

                                                    <option>Rating DESC</option>

                                                </select>

                                            </div>
                                        </div>

                                     <div class="col-lg-3">

                                            <div class="form-group">

                                                <label>City:</label>

                                                <input placeholder="Enter City" class="select2 form-control" data-placeholder="Any" name="city"/>

                                            </div>


                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group" id="currentModal">
                                                <label>Industry :</label>
                                                <select class="select22 form-control"  style="width: 100%;" name="search_industry" id="search_industry">

                                                </select>
                                            </div>
                                        </div>
                                          <div class="col-lg-3">

                                            <div class="form-group">

                                                <label> Country:</label>

                                                <select placeholder="Enter Country" class="select2 form-control"
                                                name="country">
                                                <option>AF|Afghanistan</option>
                                                <option>AL|Albania</option>
                                                <option>DZ|Algeria</option>
                                                <option>AS|American Samoa</option>
                                                <option>AD|Andorra</option>
                                                <option>AO|Angola</option>
                                                <option>AI|Anguilla</option>
                                                <option>AQ|Antarctica</option>
                                                <option>AG|Antigua And Barbuda</option>
                                                <option>AR|Argentina</option>
                                                <option>AM|Armenia</option>
                                                <option>AW|Aruba</option>
                                                <option>AU|Australia</option>
                                                <option>AT|Austria</option>
                                                <option>AZ|Azerbaijan</option>
                                                <option>BS|Bahamas</option>
                                                <option>BH|Bahrain</option>
                                                <option>BD|Bangladesh</option>
                                                <option>BB|Barbados</option>
                                                <option>BY|Belarus</option>
                                                <option>BE|Belgium</option>
                                                <option>BZ|Belize</option>
                                                <option>BJ|Benin</option>
                                                <option>BM|Bermuda</option>
                                                <option>BT|Bhutan</option>
                                                <option>BO|Bolivia</option>
                                                <option>BA|Bosnia And Herzegovina</option>
                                                <option>BW|Botswana</option>
                                                <option>BV|Bouvet Island</option>
                                                <option>BR|Brazil</option>
                                                <option>IO|British Indian Ocean Territory</option>
                                                <option>BN|Brunei Darussalam</option>
                                                <option>BG|Bulgaria</option>
                                                <option>BF|Burkina Faso</option>
                                                <option>BI|Burundi</option>
                                                <option>KH|Cambodia</option>
                                                <option>CM|Cameroon</option>
                                                <option>CA|Canada</option>
                                                <option>CV|Cape Verde</option>
                                                <option>KY|Cayman Islands</option>
                                                <option>CF|Central African Republic</option>
                                                <option>TD|Chad</option>
                                                <option>CL|Chile</option>
                                                <option>CN|China</option>
                                                <option>CX|Christmas Island</option>
                                                <option>CC|Cocos (keeling) Islands</option>
                                                <option>CO|Colombia</option>
                                                <option>KM|Comoros</option>
                                                <option>CG|Congo</option>
                                                <option>CD|Congo, The Democratic Republic Of The</option>
                                                <option>CK|Cook Islands</option>
                                                <option>CR|Costa Rica</option>
                                                <option>CI|Cote D'ivoire</option>
                                                <option>HR|Croatia</option>
                                                <option>CU|Cuba</option>
                                                <option>CY|Cyprus</option>
                                                <option>CZ|Czech Republic</option>
                                                <option>DK|Denmark</option>
                                                <option>DJ|Djibouti</option>
                                                <option>DM|Dominica</option>
                                                <option>DO|Dominican Republic</option>
                                                <option>TP|East Timor</option>
                                                <option>EC|Ecuador</option>
                                                <option>EG|Egypt</option>
                                                <option>SV|El Salvador</option>
                                                <option>GQ|Equatorial Guinea</option>
                                                <option>ER|Eritrea</option>
                                                <option>EE|Estonia</option>
                                                <option>ET|Ethiopia</option>
                                                <option>FK|Falkland Islands (malvinas)</option>
                                                <option>FO|Faroe Islands</option>
                                                <option>FJ|Fiji</option>
                                                <option>FI|Finland</option>
                                                <option>FR|France</option>
                                                <option>GF|French Guiana</option>
                                                <option>PF|French Polynesia</option>
                                                <option>TF|French Southern Territories</option>
                                                <option>GA|Gabon</option>
                                                <option>GM|Gambia</option>
                                                <option>GE|Georgia</option>
                                                <option>DE|Germany</option>
                                                <option>GH|Ghana</option>
                                                <option>GI|Gibraltar</option>
                                                <option>GR|Greece</option>
                                                <option>GL|Greenland</option>
                                                <option>GD|Grenada</option>
                                                <option>GP|Guadeloupe</option>
                                                <option>GU|Guam</option>
                                                <option>GT|Guatemala</option>
                                                <option>GN|Guinea</option>
                                                <option>GW|Guinea-bissau</option>
                                                <option>GY|Guyana</option>
                                                <option>HT|Haiti</option>
                                                <option>HM|Heard Island And Mcdonald Islands</option>
                                                <option>VA|Holy See (vatican City State)</option>
                                                <option>HN|Honduras</option>
                                                <option>HK|Hong Kong</option>
                                                <option>HU|Hungary</option>
                                                <option>IS|Iceland</option>
                                                <option>IN|India</option>
                                                <option>ID|Indonesia</option>
                                                <option>IR|Iran, Islamic Republic Of</option>
                                                <option>IQ|Iraq</option>
                                                <option>IE|Ireland</option>
                                                <option>IL|Israel</option>
                                                <option>IT|Italy</option>
                                                <option>JM|Jamaica</option>
                                                <option>JP|Japan</option>
                                                <option>JO|Jordan</option>
                                                <option>KZ|Kazakstan</option>
                                                <option>KE|Kenya</option>
                                                <option>KI|Kiribati</option>
                                                <option>KP|Korea, Democratic People's Republic Of</option>
                                                <option>KR|Korea, Republic Of</option>
                                                <option>KV|Kosovo</option>
                                                <option>KW|Kuwait</option>
                                                <option>KG|Kyrgyzstan</option>
                                                <option>LA|Lao People's Democratic Republic</option>
                                                <option>LV|Latvia</option>
                                                <option>LB|Lebanon</option>
                                                <option>LS|Lesotho</option>
                                                <option>LR|Liberia</option>
                                                <option>LY|Libyan Arab Jamahiriya</option>
                                                <option>LI|Liechtenstein</option>
                                                <option>LT|Lithuania</option>
                                                <option>LU|Luxembourg</option>
                                                <option>MO|Macau</option>
                                                <option>MK|Macedonia, The Former Yugoslav Republic Of</option>
                                                <option>MG|Madagascar</option>
                                                <option>MW|Malawi</option>
                                                <option>MY|Malaysia</option>
                                                <option>MV|Maldives</option>
                                                <option>ML|Mali</option>
                                                <option>MT|Malta</option>
                                                <option>MH|Marshall Islands</option>
                                                <option>MQ|Martinique</option>
                                                <option>MR|Mauritania</option>
                                                <option>MU|Mauritius</option>
                                                <option>YT|Mayotte</option>
                                                <option>MX|Mexico</option>
                                                <option>FM|Micronesia, Federated States Of</option>
                                                <option>MD|Moldova, Republic Of</option>
                                                <option>MC|Monaco</option>
                                                <option>MN|Mongolia</option>
                                                <option>MS|Montserrat</option>
                                                <option>ME|Montenegro</option>
                                                <option>MA|Morocco</option>
                                                <option>MZ|Mozambique</option>
                                                <option>MM|Myanmar</option>
                                                <option>NA|Namibia</option>
                                                <option>NR|Nauru</option>
                                                <option>NP|Nepal</option>
                                                <option>NL|Netherlands</option>
                                                <option>AN|Netherlands Antilles</option>
                                                <option>NC|New Caledonia</option>
                                                <option>NZ|New Zealand</option>
                                                <option>NI|Nicaragua</option>
                                                <option>NE|Niger</option>
                                                <option>NG|Nigeria</option>
                                                <option>NU|Niue</option>
                                                <option>NF|Norfolk Island</option>
                                                <option>MP|Northern Mariana Islands</option>
                                                <option>NO|Norway</option>
                                                <option>OM|Oman</option>
                                                <option>PK|Pakistan</option>
                                                <option>PW|Palau</option>
                                                <option>PS|Palestinian Territory, Occupied</option>
                                                <option>PA|Panama</option>
                                                <option>PG|Papua New Guinea</option>
                                                <option>PY|Paraguay</option>
                                                <option>PE|Peru</option>
                                                <option>PH|Philippines</option>
                                                <option>PN|Pitcairn</option>
                                                <option>PL|Poland</option>
                                                <option>PT|Portugal</option>
                                                <option>PR|Puerto Rico</option>
                                                <option>QA|Qatar</option>
                                                <option>RE|Reunion</option>
                                                <option>RO|Romania</option>
                                                <option>RU|Russian Federation</option>
                                                <option>RW|Rwanda</option>
                                                <option>SH|Saint Helena</option>
                                                <option>KN|Saint Kitts And Nevis</option>
                                                <option>LC|Saint Lucia</option>
                                                <option>PM|Saint Pierre And Miquelon</option>
                                                <option>VC|Saint Vincent And The Grenadines</option>
                                                <option>WS|Samoa</option>
                                                <option>SM|San Marino</option>
                                                <option>ST|Sao Tome And Principe</option>
                                                <option>SA|Saudi Arabia</option>
                                                <option>SN|Senegal</option>
                                                <option>RS|Serbia</option>
                                                <option>SC|Seychelles</option>
                                                <option>SL|Sierra Leone</option>
                                                <option>SG|Singapore</option>
                                                <option>SK|Slovakia</option>
                                                <option>SI|Slovenia</option>
                                                <option>SB|Solomon Islands</option>
                                                <option>SO|Somalia</option>
                                                <option>ZA|South Africa</option>
                                                <option>GS|South Georgia And The South Sandwich Islands</option>
                                                <option>ES|Spain</option>
                                                <option>LK|Sri Lanka</option>
                                                <option>SD|Sudan</option>
                                                <option>SR|Suriname</option>
                                                <option>SJ|Svalbard And Jan Mayen</option>
                                                <option>SZ|Swaziland</option>
                                                <option>SE|Sweden</option>
                                                <option>CH|Switzerland</option>
                                                <option>SY|Syrian Arab Republic</option>
                                                <option>TW|Taiwan, Province Of China</option>
                                                <option>TJ|Tajikistan</option>
                                                <option>TZ|Tanzania, United Republic Of</option>
                                                <option>TH|Thailand</option>
                                                <option>TG|Togo</option>
                                                <option>TK|Tokelau</option>
                                                <option>TO|Tonga</option>
                                                <option>TT|Trinidad And Tobago</option>
                                                <option>TN|Tunisia</option>
                                                <option>TR|Turkey</option>
                                                <option>TM|Turkmenistan</option>
                                                <option>TC|Turks And Caicos Islands</option>
                                                <option>TV|Tuvalu</option>
                                                <option>UG|Uganda</option>
                                                <option>UA|Ukraine</option>
                                                <option>AE|United Arab Emirates</option>
                                                <option>GB|United Kingdom</option>
                                                <option>US|United States</option>
                                                <option>UM|United States Minor Outlying Islands</option>
                                                <option>UY|Uruguay</option>
                                                <option>UZ|Uzbekistan</option>
                                                <option>VU|Vanuatu</option>
                                                <option>VE|Venezuela</option>
                                                <option>VN|Viet Nam</option>
                                                <option>VG|Virgin Islands, British</option>
                                                <option>VI|Virgin Islands, U.s.</option>
                                                <option>WF|Wallis And Futuna</option>
                                                <option>EH|Western Sahara</option>
                                                <option>YE|Yemen</option>
                                                <option>ZM|Zambia</option>
                                                <option>ZW|Zimbabwe</option>

                                            </select>
                                            </div>


                                        </div>
                                          <div class="col-lg-3">

                                            <div class="form-group">

                                                <label> Company:</label>

                                                <input placeholder="Enter Company" class="select2 form-control" data-placeholder="Any" name="company"/>

                                            </div>


                                        </div>


                                        <div class="col-lg-3">
                                            <div class="form-group">
                                            <button class="btn btn-success" style="margin-top: 30px;">Search</button>
                                        </div>
                                        </div>





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

                               @foreach ( $period as $date)
                               @if ($date->isToday())
                               @php
                                    $flag = false;
                               @endphp
                               @endif
                               @endforeach

                                    <div class="col-md-6">
                                        <div class="card p-3">
                                            <div class="d-flex align-items-center">
                                                <a href="{{ route('student.view_tutor',$tutor->id)}}">
                                                    <img @if ($tutor->user->image != null) src="{{ url('public') }}/images/profile/{{ $tutor->user->image}}" @else src="" @endif alt="User Image" style="width: 120px; height: 120px; border-radius: 50%;" onerror=" this.src='{{ url('public') }}/theme/admin/dist/img/default-avatar.jpg'">
                                                </a>
                                                <div class="ml-3 w-100">
                                                    <h4 class="mb-0 mt-0"><a style="text-transform: capitalize" href="{{ route('student.view_tutor', $tutor->id) }}">{{ $tutor->user->name }}</a></h4>
                                                    <?php
                                                    $rator_count = count(json_decode($tutor->rate,true));
                                                    $rating_count = 0;
                                                    $mediation = 0;

                                                    ?>

                                                    @foreach ($tutor->rate as $rate)
                                                    <?php
                                                    $rating_count ++;
                                                    ?>
                                                    @endforeach

                                                 <?php

                                                    if($rator_count!=0){

                                                            $mediation = $rating_count/$rator_count;

                                                    }


                                                            $round_mediation =(int)$mediation;
                                                 ?>

                                                    @php
                                                        $i = 0;
                                                        //$r = intval(Auth()->user()->userable->level);
                                                        $r = (int)$mediation;
                                                    @endphp
                                                    @while ($i<5)
                                                        @if ($r>0)
                                                        <span class="fa fa-star checked" style="color:rgb(255, 153, 0);"></span>
                                                        @else
                                                        <span class="fa fa-star"></span>

                                                        @endif
                                                        @php
                                                        $i += 1;
                                                        $r -=1;
                                                        @endphp
                                                    @endwhile

                                                    @if ($tutor->user->industry !=null)
                                                        <span class="users-list-date">Industry - {{ $tutor->user->industry }}</span>
                                                    @endif
                                                    {{-- @if ($tutor->user->job !=null)
                                                        <span class="users-list-date">Job Title - {{ $tutor->user->job }}</span>
                                                    @endif --}}
                                                    @if (sizeof($tutor->experiences)>0)
                                                    @php
                                                       $sizeArr = sizeof($tutor->experiences);
                                                       $i = 0;
                                                    @endphp
                                                    @foreach ($tutor->experiences as $experience)
                                                   @php
                                                        $i++;
                                                   @endphp
                                                   @if ($i == $sizeArr)
                                                   <span class="users-list-date">{{ $experience->position->text }}</span>
                                                   @endif
                                                    @endforeach

                                                    @endif
                                                    {{-- <span class="users-list-date">Timely Responce - {{ $tutor->avg_time }} hour</span> --}}

                                                    @if (count($tutor->subjects)>0)
                                                        <div class="p-2 mt-2 bg-light d-flex justify-content-between rounded text-white stats" style="font-size: 14px;">
                                                            <span>Skills -
                                                            @foreach ($tutor->subjects as $subject)
                                                                <span class="badge" style="color: #564b4b; background-color: #868f976b; !important">{{$subject['name']}}</span>
                                                            @endforeach
                                                            </span>
                                                        </div>
                                                    @endif
                                                    @if ($tutor->user->country !=null)
                                                        <span class="users-list-date">{{ $tutor->user->country }}/{{ $tutor->user->city}}</span>
                                                    @endif
                                                    <div class="button mt-2 d-flex flex-row align-items-center">
                                                        <a href="{{ route('student.view_tutor',$tutor->id)}}">
                                                            <button class="btn btn-sm btn-outline-primary w-100">View Profile</button>
                                                        </a>
                                                        @if ($tutor->conversation != null)
                                                        @if ($flag == false)
                                                        <button disabled class="btn btn-sm btn-primary ml-2">Message</button>
                                                        @else
                                                        <a href="{{ route('student.view_conversation', $tutor->conversation['id']) }}">
                                                            <button class="btn btn-sm btn-primary w-100 ml-2">Message</button>
                                                        </a>
                                                        @endif

                                                        @else
                                                            <form action="{{ route('user.store_conversation') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="student_id" value="{{Auth()->user()->userable->id}}">
                                                                <input type="hidden" name="teacher_id" value="{{$tutor->id}}">
                                                                <button {{($flag == false)?'disabled':''}} class="btn btn-sm btn-primary w-100 ml-2" type="submit">Message</button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="users-list-date text-right">Average Responce Time - {{ $tutor->avg_time }} hour(s)</span>
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

       $(function () {

    //  var ele =    document.getElementsByClassName('select2-selection');
    //  for(var i = 0;i<ele.leanth;i++){
    //     ele[i].style.height = '50px';
    //  }


   //Initialize Select2 Elements

        $('.select22').select2({
            dropdownParent: $('#currentModal')
        });



        $('#select2-echannel-doctor').select2({
            ajax: {
                method: 'GET',
                url: '{{route('student.get_topics')}}',
                contentType: "application/json; charset=utf-8",
                dataType: 'json',
                data: function (params) {
                    var query = {
                        search: params.term,
                        _method: "GET",
                       // _token: "{{csrf_token()}}",
                        type: 'public'
                    };
                    // Query parameters will be ?search=[term]&type=public
                    return query;
                },

                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data.results
                    };
                }
            },
            dropdownParent: $('#currentModal')
        });

     $('#search_industry').select2({

        ajax: {

            method: 'GET',

            url: '{{ route('student.get_industry') }}',

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

        // dropdownParent: $('#currentModal')

        });

    });


    $( document ).ready(function() {
        document.querySelectorAll('[role="combobox"]').forEach(function (el){
        el.classList.add("eletest");
        });
        console.log( "ready!" );
    });
  </script>

@endpush

