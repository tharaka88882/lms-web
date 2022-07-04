@extends('layouts.app')



@section('title')
    Update Mentor Profile
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

    <section class="content">
        <div class="container-fluid">

            {{-- <div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"> --}}
            {{-- <h1>YOU2MENTOR</h1> --}}
            {{-- </div> --}}
            {{-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a>Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div> --}}
            {{-- </div>
    </div><!-- /.container-fluid -->
</div> --}}

            <div class="row">
                <div class="col-md-12 mt-2">
                    <!-- general form elements -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Profile</h3>
                            <button type="button" data-target="#modal-md" data-toggle="modal"
                                class="btn btn-warning pull-right">View Profile</button>
                        </div>
                        <!-- /.card-header -->

                        <!-- form start -->
                        <form action="{{ route('user.update_teacher_profile') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Full Name</label>
                                            <input type="text"
                                                class="form-control  @if ($errors->has('name')) {{ 'is-invalid' }} @endif"
                                                name="name" placeholder="Full Name" value="{{ $user->name }}">
                                            <input type="hidden" value="teacher" name="type">

                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        {{-- <div class="form-group">
                                <label for="exampleInputPassword1">NIC</label>
                                <input type="text" name="nic" class="form-control @if ($errors->has('nic')) {{ 'is-invalid' }} @endif"
                        placeholder="Enter NIC" value="{{ $user->userable->nic }}">
                        @if ($errors->has('nic'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nic') }}</strong>
                        </span>
                        @endif
                    </div> --}}

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Email Address</label>
                                            <input disabled="" type="email" name="email"
                                                class="form-control @if ($errors->has('email')) {{ 'is-invalid' }} @endif"
                                                placeholder="Enter Email" value="{{ $user->email }}">

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        {{-- <div class="form-group">
                                <label for="exampleInputEmail1">Address</label>
                                <textarea name="address" class="form-control @if ($errors->has('address')) {{ 'is-invalid' }} @endif"
                    rows="2">{{$user->address}}</textarea>

                    @if ($errors->has('address'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                    @endif
                </div> --}}

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Country</label>
                                        <select type="text" name="country" class="form-control">
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

                                        {{-- @if ($errors->has('country'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('country') }}</strong>
                                            </span>
                                        @endif --}}
                                    </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">City</label>
                                            <input type="text" name="city"
                                                class="form-control @if ($errors->has('city')) {{ 'is-invalid' }} @endif"
                                                value="{{ $user->city }}">

                                            @if ($errors->has('city'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('city') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">About Me</label>
                                            <textarea name="about" class="form-control" rows="3">{{ $user->about }}</textarea>

                                            @if ($errors->has('country'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('country') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        {{-- <div class="form-group">
                                            <label for="exampleInputEmail1">Qualifications</label>
                                            <textarea name="qualification" class="form-control @if ($errors->has('qualification')) {{ 'is-invalid' }} @endif"
                                                rows="3">{{ $user->userable->qualification }}</textarea>

                                            @if ($errors->has('qualification'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('qualification') }}</strong>
                                                </span>
                                            @endif
                                        </div> --}}

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Linkedin Profile Link <small> (Please copy &
                                                    past your link)</small></label>
                                            <input name="linkedin_link"
                                                class="form-control @if ($errors->has('linkedin_link')) {{ 'is-invalid' }} @endif"
                                                value="{{ $user->userable->linkedin_link }}" />

                                            @if ($errors->has('linkedin_link'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('linkedin_link') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">My Rating</label><br>
                                            {{-- <input disabled type="text" name="country" class="form-control" value="{{ $user->userable->level }}"> --}}

                                            @php
                                                $i = 0;
                                                //$r = intval(Auth()->user()->userable->level);
                                                $r = $round_mediation;
                                            @endphp
                                            @while ($i < 5)
                                                @if ($r > 0)
                                                    <span class="fa fa-star checked"></span>
                                                @else
                                                    <span class="fa fa-star"></span>
                                                @endif
                                                @php
                                                    $i += 1;
                                                    $r -= 1;
                                                @endphp
                                            @endwhile
                                        </div>

                                        <div class="form-group">
                                            <label for="profileImageInput">Cover Image <small>(120PX *
                                                    480PX)</small></label>
                                            <div style="padding: 10px;">
                                                <img id="cover-image-output"
                                                    style="max-width: 100%; max-height:120px; border: 1px solid rgb(187, 187, 187)"
                                                    class="img-fluid"
                                                    onerror="this.src='{{ url('public') }}/images/download.jpg'"
                                                    @if ($user->cover_image != null) src="{{ url('public') }}/images/profile/{{ $user->cover_image }}" @else src="" @endif />
                                            </div>
                                            <input type="file" name="cover_image"
                                                class="form-control @if ($errors->has('image')) {{ 'is-invalid' }} @endif"
                                                id="coverImageInput" onchange="loadCoverImage(event)">

                                            @if ($errors->has('image'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('image') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        {{-- <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password" name="password" class="form-control @if ($errors->has('password')) {{ 'is-invalid' }} @endif"
                placeholder="Password">

                @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Password Confirmation</label>
                <input type="password" name="confirm_password" class="form-control @if ($errors->has('confirm_password')) {{ 'is-invalid' }} @endif" placeholder="Password Confirmation">

                @if ($errors->has('confirm_password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('confirm_password') }}</strong>
                </span>
                @endif
            </div> --}}
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="profileImageInput">Profile Image</label>
                                            <div style="padding: 10px;">
                                                <img id="image-output"
                                                    style="max-width: 120px; max-height:120px; border: 1px solid rgb(187, 187, 187)"
                                                    class="img-fluid"
                                                    onerror="this.src='{{ url('public') }}/theme/admin/dist/img/default-avatar.jpg'"
                                                    @if ($user->image != null) src="{{ url('public') }}/images/profile/{{ $user->image }}" @else src="" @endif />
                                            </div>
                                            <input type="file" name="image"
                                                class="form-control @if ($errors->has('image')) {{ 'is-invalid' }} @endif"
                                                id="profileImageInput" onchange="loadImage(event)">

                                            @if ($errors->has('image'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('image') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Job Title</label>
                                            <input type="text" name="job"
                                                class="form-control @if ($errors->has('job')) {{ 'is-invalid' }} @endif"
                                                rows="3" value="{{ $user->userable->job }}">

                                            @if ($errors->has('job'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('job') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Working Industry</label>
                                            <select class="select2 form-control" style="width: 100%;" name="industry"
                                                id="industry">

                                            </select>


                                        </div>

                                        <div class="form-group">
                                            <div class="card border border-primary">
                                                {{-- <div class="card-header">
                                    <h3 class="card-title">Add My  Mentoring Topics</h3>
                                    </div> --}}
                                                <!-- /.card-header -->
                                                <!-- form start -->
                                                {{-- <form action="{{route('teacher.stor_subject')}}" method="POST"> --}}
                                                @csrf
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Skills</label>
                                                        <textarea disabled name="skills"
                                                            class="form-control @if ($errors->has('skills')) {{ 'is-invalid' }} @endif" rows="3">{{ $user->userable->skills }}</textarea>

                                                        @if ($errors->has('skills'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('skills') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Add to Skills</label>

                                                        {{-- <select class="form-control" name="subject_id">
                                                                @foreach ($subjects as $subject)
                                                                <option value="{{$subject->id}}">{{$subject->name}}</option>
                                        @endforeach
                                        </select> --}}

                                                        <select id="select2-echannel-doctor"
                                                            style="width: 100% !important;padding: 12px 20px !important;margin: 8px 0 !important;display: inline-block !important;border: 1px solid #ccc !important;box-sizing: border-box !important;"
                                                            name="subject"
                                                            class="select2 @if ($errors->has('subject')) {{ 'is-invalid' }} @endif">

                                                        </select>

                                                        @if ($errors->has('subject'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('subject') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->

                                                <div class="card-footer">
                                                    <button id="add_btn" type="button"
                                                        class="btn btn-success pull-right">Add</button>
                                                </div>
                                                {{-- </form> --}}
                                            </div>
                                            <!-- /.card -->
                                        </div>

                                        {{-- <div class="form-group">
                                            <label for="exampleInputEmail1">Experience</label>
                                            <textarea name="experience" class="form-control @if ($errors->has('experience')) {{ 'is-invalid' }} @endif"
                                                rows="3">{{ $user->userable->experience }}</textarea>

                                            @if ($errors->has('experience'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('experience') }}</strong>
                                                </span>
                                            @endif
                                        </div> --}}


                                        <div class="card border border-danger">
                                            <div class="card-header">
                                                <h6><strong>My Leave</strong> <br> <small>(Add the dates you won't available)</small></h6>

                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">From Date</label>
                                                    <input class="form-control" type="date" name="from_leave"
                                                        value="{{ $user->from_leave }}" />

                                                    @if ($errors->has('from_leave'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('from_leave') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">To Date</label>
                                                    <input class="form-control" type="date" name="to_leave"
                                                        value="{{ $user->to_leave }}" />

                                                    @if ($errors->has('to_leave'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('to_leave') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <input  type="checkbox" name="leave_status" {{ $user->leave_status == 0 ? '' : 'checked' }}/>
                                                    <label for="exampleInputEmail1"> Active</label>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success pull-right">Save</button>
                                {{-- <button type="button" data-target="#modal-md" data-toggle="modal"
                                    class="btn btn-warning pull-right  mr-2">View Profile</button> --}}
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card -->
            </div>

            <div class="row">
                {{-- Qualifications Card --}}
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Qualifications</h3>
                        </div>
                        <!--Make sure the form has the autocomplete function switched off:-->
                        <form autocomplete="off" action="{{ route('user.add_qualification') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="autocomplete" style="width:100%;">
                                                <label for="exampleInputEmail1">Institute</label>
                                                <input id="myInput" type="text" name="company" placeholder="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Degree/Certificate</label>
                                            <input name="qualification"
                                                class="form-control @if ($errors->has('qualification')) {{ 'is-invalid' }} @endif"
                                                type="text" />

                                            @if ($errors->has('qualification'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('qualification') }}</strong>
                                                </span>
                                            @endif
                                        </div>


                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Field of study</label>
                                            <input name="field"
                                                class="form-control @if ($errors->has('field')) {{ 'is-invalid' }} @endif"
                                                type="text" />

                                            @if ($errors->has('field'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('field') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <div class="form-check">
                                                <input id="undergrad" class="form-check-input" type="checkbox">
                                                <label class="form-check-label">Ongoing</label>
                                            </div>
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="exampleInputEmail1">Sr</label>
                                            <input id="dpic" name="date"
                                                class="form-control @if ($errors->has('date')) {{ 'is-invalid' }} @endif"
                                                type="date" />

                                            @if ($errors->has('date'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('date') }}</strong>
                                                </span>
                                            @endif
                                        </div> --}}

                                        <div class="row">
                                            {{-- <label for="exampleInputEmail1">Time of work</label> --}}
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Start</label>
                                                    <input name="start_date" placeholder="Start Year"
                                                        class="form-control @if ($errors->has('start_date')) {{ 'is-invalid' }} @endif"
                                                        type="date" />

                                                    @if ($errors->has('start_date'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('start_date') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">End</label>
                                                    <input id="dpic" name="end_date" placeholder="End Year"
                                                        class="form-control @if ($errors->has('end_date')) {{ 'is-invalid' }} @endif"
                                                        type="date" />

                                                    @if ($errors->has('end_date'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('end_date') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Grade (Optional)</label>
                                            <input name="grade"
                                                class="form-control @if ($errors->has('grade')) {{ 'is-invalid' }} @endif"
                                                type="text" />

                                            @if ($errors->has('grade'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('grade') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        {{-- <div class="form-group">
                                            <label for="exampleInputEmail1">Your Qualifications</label>
                                            <textarea disabled name="skills" class="form-control @if ($errors->has('skills')) {{ 'is-invalid' }} @endif"
                                                rows="3">{{ $user->userable->skills }}</textarea>

                                            @if ($errors->has('skills'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('skills') }}</strong>
                                                </span>
                                            @endif
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success pull-right">Add</button>
                            </div>
                        </form>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">My Qualifications</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Institute</th>
                                            <th>Degree/Certificate</th>
                                            <th>Field of study</th>
                                            <th style="width: 40px">Study Period</th>
                                            <th>Grade</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach (Auth()->user()->userable->qualifications as $qualification)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $qualification->institute->text }}</td>
                                                <td>{{ $qualification->text }}</td>
                                                <td>{{ $qualification->field }}</td>
                                                <td><span
                                                        class="badge">{{ explode('-', $qualification->start_date)[0] }}/{{ explode('-', $qualification->start_date)[1] }}
                                                        @if ($qualification->end_date != null)
                                                            -
                                                            {{ explode('-', $qualification->end_date)[0] }}/{{ explode('-', $qualification->end_date)[1] }}
                                                        @else
                                                            - Present
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>{{ $qualification->grade }}</td>

                                                <td>
                                                    <a type="button"
                                                        class="btn btn-block btn-outline-primary btn-xs"
                                                        href="{{route('user.view_qualification', $qualification->id)}}">View</a>
                                                    {{-- <button type="button"
                                                        class="btn btn-block btn-outline-warning btn-xs"
                                                        data-target="#modal-mdq{{ $qualification->id }}"
                                                        data-toggle="modal">Update</button> --}}
                                                    <button type="button" class="btn btn-block btn-outline-danger btn-xs"
                                                        onclick="removeQua('{{ $qualification->id }}');">Remove</button>
                                                </td>
                                            </tr>
                                            @php
                                                $i++;
                                            @endphp

                                            <div class="modal fade" id="modal-mdq{{ $qualification->id }}">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" style="text-transform: capitalize">
                                                                Update qualification</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <!--Make sure the form has the autocomplete function switched off:-->
                                                            <form autocomplete="off"
                                                                action="{{ route('user.edit_qualification', $qualification->id) }}"
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
                                                                                        for="exampleInputEmail1">Institute</label>
                                                                                    <input id="myInput1" type="text"
                                                                                        name="company"
                                                                                        value="{{ $qualification->institute->text }}"
                                                                                        placeholder="">
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="exampleInputEmail1">Degree/Certificate</label>
                                                                                <input name="qualification"
                                                                                    class="form-control @if ($errors->has('qualification')) {{ 'is-invalid' }} @endif"
                                                                                    type="text"
                                                                                    value="{{ $qualification->text }}" />

                                                                                @if ($errors->has('qualification'))
                                                                                    <span class="invalid-feedback"
                                                                                        role="alert">
                                                                                        <strong>{{ $errors->first('qualification') }}</strong>
                                                                                    </span>
                                                                                @endif
                                                                            </div>


                                                                            <div class="form-group">
                                                                                <label for="exampleInputEmail1">Field of
                                                                                    study</label>
                                                                                <input name="field"
                                                                                    class="form-control @if ($errors->has('field')) {{ 'is-invalid' }} @endif"
                                                                                    type="text"
                                                                                    value="{{ $qualification->field }}" />

                                                                                @if ($errors->has('field'))
                                                                                    <span class="invalid-feedback"
                                                                                        role="alert">
                                                                                        <strong>{{ $errors->first('field') }}</strong>
                                                                                    </span>
                                                                                @endif
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <div class="form-check">
                                                                                    <input
                                                                                        id="undergrad{{ $qualification->id }}"
                                                                                        {{ $qualification->end_date != null ? '' : 'checked' }}
                                                                                        class="form-check-input"
                                                                                        type="checkbox">
                                                                                    <label class="form-check-label">Still
                                                                                        studying</label>
                                                                                </div>
                                                                            </div>
                                                                            {{-- <div class="form-group">
                                        <label for="exampleInputEmail1">Sr</label>
                                        <input id="dpic" name="date"
                                            class="form-control @if ($errors->has('date')) {{ 'is-invalid' }} @endif"
                                            type="date" />

                                        @if ($errors->has('date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('date') }}</strong>
                                            </span>
                                        @endif
                                    </div> --}}

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
                                                                                            value="{{ $qualification->start_date }}" />

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
                                                                                            id="dpic{{ $qualification->id }}"
                                                                                            name="end_date"
                                                                                            placeholder="End Year"
                                                                                            class="form-control @if ($errors->has('end_date')) {{ 'is-invalid' }} @endif"
                                                                                            type="date"
                                                                                            value="{{ $qualification->end_date }}" />

                                                                                        @if ($errors->has('end_date'))
                                                                                            <span class="invalid-feedback"
                                                                                                role="alert">
                                                                                                <strong>{{ $errors->first('end_date') }}</strong>
                                                                                            </span>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="exampleInputEmail1">Grade
                                                                                    (Optional)
                                                                                </label>
                                                                                <input name="grade"
                                                                                    class="form-control @if ($errors->has('grade')) {{ 'is-invalid' }} @endif"
                                                                                    type="text"
                                                                                    value="{{ $qualification->grade }}" />

                                                                                @if ($errors->has('grade'))
                                                                                    <span class="invalid-feedback"
                                                                                        role="alert">
                                                                                        <strong>{{ $errors->first('grade') }}</strong>
                                                                                    </span>
                                                                                @endif
                                                                            </div>

                                                                            {{-- <div class="form-group">
                                        <label for="exampleInputEmail1">Your Qualifications</label>
                                        <textarea disabled name="skills" class="form-control @if ($errors->has('skills')) {{ 'is-invalid' }} @endif"
                                            rows="3">{{ $user->userable->skills }}</textarea>

                                        @if ($errors->has('skills'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('skills') }}</strong>
                                            </span>
                                        @endif
                                    </div> --}}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-footer">
                                                                    <button type="submit"
                                                                        class="btn btn-warning pull-right">Update</button>
                                                                </div>
                                                            </form>



                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->
                                            @push('scripts')
                                                <script>
                                                    if ($('#undergrad{{ $qualification->id }}').is(':checked')) {
                                                        // alert("t");
                                                        $('#dpic{{ $qualification->id }}').prop('disabled', true);
                                                    } else {
                                                        //alert("tjio");
                                                        $('#dpic{{ $qualification->id }}').prop('disabled', false);
                                                    }
                                                    $('#undergrad{{ $qualification->id }}').click(function() {
                                                        if ($('#undergrad{{ $qualification->id }}').is(':checked')) {
                                                            // alert("t");
                                                            $('#dpic{{ $qualification->id }}').prop('disabled', true);
                                                        } else {
                                                            //alert("tjio");
                                                            $('#dpic{{ $qualification->id }}').prop('disabled', false);
                                                        }
                                                    });
                                                </script>
                                            @endpush
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>



                </div>
                {{-- End of Qualifications Card --}}

                {{-- Qualifications Card --}}
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Experience</h3>
                        </div>
                        <!--Make sure the form has the autocomplete function switched off:-->
                        <form autocomplete="off" action="{{ route('user.add_experience') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="autocomplete" style="width:100%;">
                                                <label for="exampleInputEmail1">Position</label>
                                                <input id="position" type="text" name="position" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="autocomplete @if ($errors->has('company')) {{ 'is-invalid' }} @endif"
                                                style="width:100%;">
                                                <label for="exampleInputEmail1">Company</label>
                                                <input id="ins" type="text" name="company" placeholder="">
                                            </div>

                                            @if ($errors->has('company'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('company') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <div class="autocomplete" style="width:100%;">
                                                <label for="exampleInputEmail1">Location</label>
                                                <input type="text" name="location"
                                                    class="@if ($errors->has('location')) {{ 'is-invalid' }} @endif">
                                            </div>

                                            @if ($errors->has('location'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('location') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <div class="form-check">
                                                <input id="present" class="form-check-input" type="checkbox">
                                                <label class="form-check-label">I am currently working in this role</label>
                                            </div>
                                        </div>



                                        <div class="row">
                                            {{-- <label for="exampleInputEmail1">Time of work</label> --}}
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Start</label>
                                                    <input name="start_date" placeholder="Start Year"
                                                        class="form-control @if ($errors->has('start_date')) {{ 'is-invalid' }} @endif"
                                                        type="date" />

                                                    @if ($errors->has('start_date'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('start_date') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">End</label>
                                                    <input id="end_y" name="end_date" placeholder="End Year"
                                                        class="form-control @if ($errors->has('end_date')) {{ 'is-invalid' }} @endif"
                                                        type="date" />

                                                    @if ($errors->has('end_date'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('end_date') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="exampleInputEmail1">Your Experiences</label>
                                            <textarea disabled name="skills" class="form-control @if ($errors->has('skills')) {{ 'is-invalid' }} @endif"
                                                rows="3">{{ $user->userable->skills }}</textarea>

                                            @if ($errors->has('skills'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('skills') }}</strong>
                                                </span>
                                            @endif
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success pull-right">Add</button>
                            </div>
                        </form>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">My Experience</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Position</th>
                                            <th>Company</th>
                                            <th>Location</th>
                                            <th style="width: 80px">Work Period</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach (Auth()->user()->userable->experiences as $experiences)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $experiences->position->text }}</td>
                                                <td>{{ $experiences->institute->text }}</td>
                                                <td>{{ $experiences->location }}</td>
                                                <td><span
                                                        class="badge">{{ explode('-', $experiences->start_date)[0] }}/{{ explode('-', $experiences->start_date)[1] }}
                                                        @if ($experiences->end_date != null)
                                                            -
                                                            {{ explode('-', $experiences->end_date)[0] }}/{{ explode('-', $experiences->end_date)[1] }}
                                                        @else
                                                            - Present
                                                        @endif
                                                    </span>
                                                </td>
                                                <td style="width: 80px">
                                                    <a type="button"
                                                        class="btn btn-block btn-outline-primary btn-xs"
                                                        href="{{route('user.view_experience', $experiences->id)}}">View</a>
                                                    {{-- <button type="button"
                                                        class="btn btn-block btn-outline-warning btn-xs"
                                                        data-target="#modal-mdx{{ $experiences->id }}"
                                                        data-toggle="modal">Update</button> --}}
                                                    <button type="button" class="btn btn-block btn-outline-danger btn-xs"
                                                        onclick="removeEx({{ $experiences->id }});">Remove</button>

                                                </td>
                                            </tr>
                                            @php
                                                $i++;
                                            @endphp


                                            <!-- /.view profile modal -->
                                            <div class="modal fade" id="modal-mdx{{ $experiences->id }}">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" style="text-transform: capitalize">
                                                                Update experience</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

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
                                                        </div>


                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
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
                            @endpush
                            @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End of Qualifications Card --}}
        </div>
    </section>





    <!-- /.view profile modal -->
    <div class="modal fade" id="modal-md">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="text-transform: capitalize">My Profile</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-sm-7">
                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- Widget: user widget style 1 -->
                                    <div class="card card-widget widget-user">
                                        <!-- Add the bg color to the header using any of the bg-* classes -->
                                        <div class="widget-user-header bg-olive"
                                            @if ($user->cover_image != null) style="background-image: url('{{ url('public') }}/images/profile/{{ $user->cover_image }}') !important;" @endif>
                                            <h3 class="widget-user-username"
                                                style="margin-top: -10px; margin-bottom:0px; !important">
                                                {{ ucwords($user->name) }}
                                            </h3>
                                            @if (sizeof(Auth()->user()->userable->experiences) > 0)
                                                @php
                                                    $sizeArr = sizeof(Auth()->user()->userable->experiences);
                                                    $i = 0;
                                                @endphp
                                                @foreach (Auth()->user()->userable->experiences as $experience)
                                                    @php
                                                        $i++;
                                                    @endphp
                                                    @if ($i == $sizeArr)
                                                        <span><small>{{ $experience->position->text }}</small></span><br>
                                                    @endif
                                                @endforeach
                                            @endif
                                            @php
                                                $i = 0;
                                                //$r = intval(Auth()->user()->userable->level);
                                                $r = (int) $round_mediation;
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
                                            {{-- </a> --}}
                                        </div>

                                        <div class="widget-user-image">
                                            <img class="img-circle elevation-2"
                                                onerror="this.src='{{ url('public') }}/theme/admin/dist/img/default-avatar.jpg'"
                                                @if (Auth()->user()->image != null) src="{{ url('public') }}/images/profile/{{ Auth()->user()->image }}" @else src="" @endif
                                                alt="User Avatar">
                                        </div>

                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col-sm-4 border-right">
                                                    <div class="description-block">
                                                        {{-- <h5 class="description-header">3,200</h5>
                                        <span class="description-text">SALES</span> --}}
                                                    </div>
                                                    <!-- /.description-block -->
                                                </div>
                                                <!-- /.col -->

                                                <div class="col-sm-4 border-right">
                                                    <div class="description-block">
                                                        <h5 class="description-header"></h5>
                                                        <span class="description-text"></span>
                                                    </div>
                                                    <!-- /.description-block -->
                                                </div>

                                                <!-- /.col -->

                                                <div class="col-sm-4">
                                                    <div class="description-block">
                                                        {{-- <h5 class="description-header">35</h5>
                                        <span class="description-text">PRODUCTS</span> --}}
                                                    </div>
                                                    <!-- /.description-block -->
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.row -->

                                            <div class="col-md-12">
                                                <div class="row text-center">
                                                    {{-- <div class="col-sm-2">
                                    <a class="btn btn-success" href="{{ route('student.view_conversation', $query->id) }}">Complaint</a>
                                </div> --}}
                                                    {{-- <div class="col-xs-2">
                                                    <a class="btn btn-warning" href="{{route('student.complaint',$teacher->id)}}">Complaint Mentor</a>
                                                </div> --}}
                                                    <div class="col-sm-12 col-md-4 mb-1">
                                                        <a class="btn btn-success">Connect</a>
                                                    </div>
                                                    <div class="col-sm-12 col-md-4 mb-1">
                                                        <button class="btn btn-warning"><i class="fa fa-star"></i> Rate
                                                            Now</button>

                                                    </div>

                                                    <div class="col-sm-12 col-md-4 mb-1">
                                                        <a class="btn btn-warning"><i class="fa fa-flag"
                                                                style="color: red;"></i> Flag</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.widget-user -->
                                    {{-- <div class="card">
                          <div class="card-header">
                              <h3 class="card-title">
                                <i class="fas fa-tasks"></i>
                                Schedule
                              </h3>
                            </div>
                          <div class="card-body p-2">
                            <!-- THE CALENDAR -->
                            <div id="calendar"></div>
                          </div>
                          <!-- /.card-body -->
                      </div> --}}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                <i class="fas fa-angle-double-down"></i>
                                                About me
                                            </h3>
                                            <br>

                                            @if (Auth()->user()->userable->linkedin_link != null)
                                                {{-- <a href="{{ Auth()->user()->userable->linkedin_link }}" target="_blank">View
                                            Linkedin Profile
                                            <i class="fas fa-angle-double-right"></i></a> --}}
                                            @endif
                                            {{-- @if (Auth()->user()->about != null)
                                                <span>{{ Auth()->user()->about }}
                                                    <i class="fas fa-angle-double-right"></i></span>
                                            @endif --}}
                                        </div>
                                        <!-- /.card-header -->

                                        <div class="card-body">
                                            <dl>
                                                @if (Auth()->user()->about != null)
                                                    <dd>{{ Auth()->user()->about }}
                                                    </dd>
                                                @endif
                                                {{-- <dt>Qualifications</dt>
                                                <dd>
                                                    <ul>

                                                        @foreach (Auth()->user()->userable->qualifications as $qualification)
                                                            <li><strong>{{ $qualification->text }}</strong><br>
                                                                <span>{{ $qualification->institute->text }}
                                                                    <br>
                                                                    {{ $qualification->field }}<br>
                                                                    <small>
                                                                        @if ($qualification->end_date != null)
                                                                            Completed
                                                                            {{ explode('-', $qualification->start_date)[1] }}/{{ explode('-', $qualification->start_date)[0] }}
                                                                            -
                                                                            {{ explode('-', $qualification->end_date)[1] }}/{{ explode('-', $qualification->end_date)[0] }}
                                                                        @else
                                                                            {{ explode('-', $qualification->start_date)[1] }}/{{ explode('-', $qualification->start_date)[0] }}
                                                                            - Present
                                                                            <br> Grade-{{ $qualification->grade }}
                                                                        @endif

                                                                    </small>
                                                                </span>
                                                            </li>
                                                        @endforeach
                                                    </ul>

                                                </dd>
                                                <dt>Experience</dt>
                                                <dd>
                                                    <ul>

                                                        @foreach (Auth()->user()->userable->experiences as $experience)
                                                            <li><strong>{{ $experience->position->text }}</strong><br>
                                                                <span>{{ $experience->institute->text }}
                                                                    <br>
                                                                    <small>{{ explode('-', $experience->start_date)[1] }}/{{ explode('-', $experience->start_date)[0] }}
                                                                        @if ($experience->end_date != null)
                                                                            -
                                                                            {{ explode('-', $experience->end_date)[1] }}/{{ explode('-', $experience->end_date)[0] }}
                                                                        @else
                                                                            - Present
                                                                        @endif
                                                                        <br>
                                                                        Location : {{ $experience->location }}
                                                                    </small>
                                                                </span>
                                                            </li>
                                                        @endforeach
                                                    </ul>

                                                </dd>
                                                <dt>Skills</dt>
                                        <dd>
                                            {{ Auth()->user()->userable->skills }}
                                        </dd> --}}
                                                @if (Auth()->user()->userable->industry != null)
                                                    <dt>Industry</dt>
                                                    <dd>
                                                        {{ Auth()->user()->userable->industry }}
                                                    </dd>
                                                @endif
                                                {{-- <dt>Job Title</dt>
                                                <dd>
                                                    {{ Auth()->user()->userable->job }}
                                                </dd> --}}
                                            </dl>
                                        </div>
                                        <!-- /.card-body -->

                                        <div class="card-footer">
                                            <div class="float-right">
                                                <b>Average Responce time: </b> {{ round(1, 5) }}hrs
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card -->
                                    {{-- Qualifications Card --}}
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                <i class="fas fa-bookmark"></i>
                                                Qualifications
                                            </h3>
                                        </div>
                                        <!-- /.card-header -->

                                        <div class="card-body">
                                            @foreach (Auth()->user()->userable->qualifications as $qualification)
                                                <strong>{{ $qualification->text }}</strong><br>
                                                <span>{{ $qualification->institute->text }}
                                                    <br>
                                                    {{ $qualification->field }}<br>
                                                    <small>
                                                        @if ($qualification->end_date != null)
                                                            Completed
                                                            {{ explode('-', $qualification->start_date)[1] }}/{{ explode('-', $qualification->start_date)[0] }}
                                                            -
                                                            {{ explode('-', $qualification->end_date)[1] }}/{{ explode('-', $qualification->end_date)[0] }}
                                                        @else
                                                            Ongoing
                                                            {{ explode('-', $qualification->start_date)[1] }}/{{ explode('-', $qualification->start_date)[0] }}
                                                            - Present
                                                            <br>
                                                            @if ($qualification->grade != null)
                                                                Grade-{{ $qualification->grade }}
                                                            @endif
                                                        @endif

                                                    </small>
                                                </span>
                                                <hr>
                                            @endforeach
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    {{-- End of Qualifications Card --}}

                                    {{-- Experience Card --}}
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                <i class="fas fa-briefcase"></i>
                                                Experience
                                            </h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            @foreach (Auth()->user()->userable->experiences as $experience)
                                                <strong>{{ $experience->position->text }}</strong><br>
                                                <span>{{ $experience->institute->text }}
                                                    <br>
                                                    @if ($experience->end_date == null)
                                                        <small>Currently employed </small>
                                                    @endif
                                                    <small>{{ explode('-', $experience->start_date)[1] }}/{{ explode('-', $experience->start_date)[0] }}
                                                        @if ($experience->end_date != null)
                                                            -
                                                            {{ explode('-', $experience->end_date)[1] }}/{{ explode('-', $experience->end_date)[0] }}
                                                        @else
                                                            - Present
                                                        @endif
                                                        <br>
                                                        @if ($experience->location != null)
                                                            Location : {{ $experience->location }}
                                                        @endif
                                                    </small>
                                                </span>
                                                <hr>
                                            @endforeach
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    {{-- Experience Card --}}

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-7">
                            {{-- <div class="card">
                          <div class="card-header">
                              <h3 class="card-title">
                                <i class="fas fa-tasks"></i>
                                Schedule
                              </h3>
                            </div>
                          <div class="card-body p-2">
                            <!-- THE CALENDAR -->
                            <div id="calendar"></div>
                          </div>
                          <!-- /.card-body -->
                      </div> --}}
                        </div>

                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-book-open"></i>
                                        Skils
                                    </h3>
                                </div>
                                <!-- /.card-header -->

                                <div class="card-body">
                                    <ul>
                                        @foreach (Auth()->user()->userable->teachersubject as $subject)
                                            <li>{{ $subject->subject->name }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->


                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->




    <!-- /.view profile modal -->
@endsection





@push('scripts')
    <script>
        var loadImage = function(event) {

            var reader = new FileReader();

            reader.onload = function() {

                var output = document.getElementById('image-output');

                output.src = reader.result;

                output.style.display = "block";

            }

            reader.readAsDataURL(event.target.files[0]);



        }
        var loadCoverImage = function(event) {

            var reader = new FileReader();

            reader.onload = function() {

                var output = document.getElementById('cover-image-output');

                output.src = reader.result;

                output.style.display = "block";

            }

            reader.readAsDataURL(event.target.files[0]);



        }



        $(function() {

            // if ($('#present1').is(':checked')) {
            //     // alert("t");
            //     $('#end_y1').prop('disabled', true);
            // } else {
            //     //alert("tjio");
            //     $('#end_y1').prop('disabled', false);
            // }

            // if ($('#undergrad1').is(':checked')) {
            //     // alert("t");
            //     $('#dpic1').prop('disabled', true);
            // } else {
            //     //alert("tjio");
            //     $('#dpic1').prop('disabled', false);
            // }
            //Initialize Select2 Elements

            // $('.select2').select2({

            //     dropdownParent: $('#currentModal')

            // });



            $('#select2-echannel-doctor').select2({

                ajax: {

                    method: 'GET',

                    url: '{{ route('teacher.get_topics') }}',

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

            $('#industry').select2({

                ajax: {

                    method: 'GET',

                    url: '{{ route('teacher.get_industry') }}',

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





        $('#add_btn').click(function() {

            addTopics();

        });



        function addTopics() {

            //alert("Update Chat");



            $.post('{{ route('teacher.stor_subject1') }}', {

                    _method: "POST",

                    _token: "{{ csrf_token() }}",

                    subject: $('#select2-echannel-doctor option:selected').val()

                },
                function(data, status) {

                    // var jo = JSON.parse(data);


                    if (data.error == false) {

                        window.location = "{{ route('user.profile') }}";

                        //  alert(data.flag);

                    } else {

                        window.location = "{{ route('user.profile') }}";

                    }

                });







        }


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
        // var countries = ["Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Anguilla", "Antigua & Barbuda",
        //     "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh",
        //     "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia & Herzegovina",
        //     "Botswana", "Brazil", "British Virgin Islands", "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia",
        //     "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central Arfrican Republic", "Chad", "Chile", "China",
        //     "Colombia", "Congo", "Cook Islands", "Costa Rica", "Cote D Ivoire", "Croatia", "Cuba", "Curacao", "Cyprus",
        //     "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt",
        //     "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands", "Faroe Islands",
        //     "Fiji", "Finland", "France", "French Polynesia", "French West Indies", "Gabon", "Gambia", "Georgia",
        //     "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guam", "Guatemala", "Guernsey",
        //     "Guinea", "Guinea Bissau", "Guyana", "Haiti", "Honduras", "Hong Kong", "Hungary", "Iceland", "India",
        //     "Indonesia", "Iran", "Iraq", "Ireland", "Isle of Man", "Israel", "Italy", "Jamaica", "Japan", "Jersey",
        //     "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Kosovo", "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon",
        //     "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia",
        //     "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania",
        //     "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro", "Montserrat", "Morocco",
        //     "Mozambique", "Myanmar", "Namibia", "Nauro", "Nepal", "Netherlands", "Netherlands Antilles",
        //     "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "North Korea", "Norway", "Oman",
        //     "Pakistan", "Palau", "Palestine", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland",
        //     "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russia", "Rwanda", "Saint Pierre & Miquelon",
        //     "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles",
        //     "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa",
        //     "South Korea", "South Sudan", "Spain", "Sri Lanka", "St Kitts & Nevis", "St Lucia", "St Vincent", "Sudan",
        //     "Suriname", "Swaziland", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand",
        //     "Timor L'Este", "Togo", "Tonga", "Trinidad & Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks & Caicos",
        //     "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States of America",
        //     "Uruguay", "Uzbekistan", "Vanuatu", "Vatican City", "Venezuela", "Vietnam", "Virgin Islands (US)", "Yemen",
        //     "Zambia", "Zimbabwe"
        // ];
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


        function removeEx(id) {
            if (confirm("Are you sure?") == true) {
                $.post("{{ route('user.delete_experience') }}", {
                        id: id,
                        _method: "delete",
                        _token: "{{ csrf_token() }}"
                    },
                    function(data, status) {
                        if (data.success == true) {
                            console.log('success');
                            window.location = "{{ route('user.profile') }}";
                        }
                    });
            }

        }

        function removeQua(id) {
            if (confirm("Are you sure?") == true) {
                $.post("{{ route('user.delete_qualification') }}", {
                        id: id,
                        _method: "delete",
                        _token: "{{ csrf_token() }}"
                    },
                    function(data, status) {
                        if (data.success == true) {
                            console.log('success');
                            window.location = "{{ route('user.profile') }}";
                        }
                    });
            }

        }

        $('#present').click(function() {
            if ($('#present').is(':checked')) {
                // alert("t");
                $('#end_y').prop('disabled', true);
            } else {
                //alert("tjio");
                $('#end_y').prop('disabled', false);
            }
        });


        $('#undergrad').click(function() {
            if ($('#undergrad').is(':checked')) {
                // alert("t");
                $('#dpic').prop('disabled', true);
            } else {
                //alert("tjio");
                $('#dpic').prop('disabled', false);
            }
        });
    </script>
@endpush
