@extends('layouts.app')



@section('title')
    Mentor Profile
@endsection



@push('styles')
    {{-- <style>h1 {background-color: red !important}</style> --}}
@endpush



@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row p-2">
                <div class="col">
                  <h1>My Profile</h1>
                </div>
                <div class="col">
                  <a href="{{ url()->previous() }}" type="button" class="btn btn-warning pull-right">
                    <i class="fa fa-arrow-left"></i> Go Back
                  </a>
                </div>
            </div>
        </div>
        <div class="container-fluid border border-primary rounded">
            <div class="row p-2 mb-2">
                    <div class="row col-sm-12">
                        <div class="col-sm-7">
                            <!-- Widget: user widget style 1 -->
                            <div class="card card-widget widget-user">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header bg-olive"
                                    @if (Auth()->user()->cover_image != null) style="background-image: url('{{ url('public') }}/images/profile/{{ Auth()->user()->cover_image }}'); background-repeat: round; !important;" @endif>
                                    <h3 class="widget-user-username"
                                        style="margin-top: -10px; margin-bottom: -5px; !important">
                                        {{ ucwords(Auth()->user()->name) }}
                                    </h3>
                                    @if (sizeof(Auth()->user()->userable->experiences) > 0)
                                        @php
                                            $sizeArr = sizeof(Auth()->user()->userable->experiences);
                                            $i = 0;

                                            $st_date_diff = 0;
                                            $ff = false;
                                            $position_now  = '';
                                        @endphp
                                        @foreach (Auth()->user()->userable->experiences as $experience)
                                        @if ($experience->end_date == null)
                                        @php
                                        $i++;
                                        $date = \Carbon\Carbon::parse($experience->start_date);
                                         $now = \Carbon\Carbon::now();

                                         if( $st_date_diff > $date->diffInDays($now) || $st_date_diff==0){
                                             $st_date_diff =$date->diffInDays($now);
                                         $position_now = $experience->position->text;
                                         $ff = true;
                                         }

                                         @endphp
                                        {{-- <span><small>{{ $experience->position->text }}</small></span><br> --}}
                                        @endif
                                        @endforeach
                                        @if ($ff)
                                        <span><small>{{ $position_now }}</small></span><br>
                                        {{-- <span><small>{{ $experience->position->text }}</small></span><br> --}}
                                        @endif
                                    @endif
                                    @php
                                        $i = 0;
                                        //$r = intval(Auth()->user()->userable->level);
                                        $r = (int) Auth()->user()->userable->rating;
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
                                    <img class="img-circle elevation-2" style="width: 100px; height: 100px;"
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

                                        <div class="row text-center">
                                            {{-- <div class="col-sm-2">
                            <a class="btn btn-success" href="{{ route('student.view_conversation', $query->id) }}">Complaint</a>
                        </div> --}}
                                            {{-- <div class="col-xs-2">
                                            <a class="btn btn-warning" href="{{route('student.complaint',$teacher->id)}}">Complaint Mentor</a>
                                        </div> --}}
                                            <div class="col-xm-12 col-md-4 mb-1">
                                                <a class="btn btn-success">Connect</a>
                                            </div>
                                            <div class="col-xm-12 col-md-4 mb-1">
                                                <button class="btn btn-warning"><i class="fa fa-star"></i> Rate
                                                    Now</button>

                                            </div>
                                            <div class="col-xm-12 col-md-4 mb-1">
                                                <a class="btn btn-warning"><i class="fa fa-flag"
                                                        style="color: red;"></i> Flag</a>
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
                        <div class="col-sm-5">
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
                                        <b>Average Responce time: </b>
                                        @if (Auth()->user()->avg == '1')
                                            {{ Auth()->user()->avg }}hr
                                        @else
                                            {{ Auth()->user()->avg }}hrs
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>

                    <div class="row col-sm-12">
                        <div class="col-md-7">
                            {{-- Qualifications Card --}}
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-bookmark"></i>
                                         Education
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
                                                    {{ explode('-', $qualification->start_date)[0] }}
                                                    -
                                                    {{ explode('-', $qualification->end_date)[0] }}
                                                @else
                                                    {{ explode('-', $qualification->start_date)[0]}}
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
                                                {{-- <small>Currently employed </small> --}}
                                            @endif
                                            <small>{{ explode('-', $experience->start_date)[0] }}
                                                @if ($experience->end_date != null)
                                                    -
                                                    {{ explode('-', $experience->end_date)[0] }}
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
                        <div class="col-sm-5">
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
                    </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <!-- /.modal -->
    <div class="modal fade" id="modal-md">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add new Rating</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @csrf
                <input type="hidden" name="milestone_id" value="" />
                <div class="modal-body">
                    <div class="form-group">
                        <label>How would you rate your overall experience with the mentor</label>
                        <!-- <input type="text" name="text" class="form-control" placeholder="Type Here"> -->
                        <div>
                            <span class="fa fa-star" style="cursor: pointer" aria-hidden="true" id="st1"></span>
                            <span class="fa fa-star" style="cursor: pointer" aria-hidden="true" id="st2"></span>
                            <span class="fa fa-star" style="cursor: pointer" aria-hidden="true" id="st3"></span>
                            <span class="fa fa-star" style="cursor: pointer" aria-hidden="true" id="st4"></span>
                            <span class="fa fa-star" style="cursor: pointer" aria-hidden="true" id="st5"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Was your Question answered?</label>
                        <div class="form-check">
                            <input id="radio1" class="form-check-input" type="radio" name="radio1" value="1"
                                checked="">
                            <label class="form-check-label">Yes</label><br>
                            <input id="radio2" class="form-check-input" type="radio" value="0"
                                name="radio1">
                            <label class="form-check-label">No</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Any Comments</label>
                        <textarea id="question3" name="question3" class="form-control" column="3" rows="2" required></textarea>
                        <!-- <input type="test" name="due_date" class="form-control" placeholder="Enter ..."> -->
                    </div>
                    <div class="modal-footer justify-content-between btn-group">
                        <button onclick="" type="submit"
                            class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
    <!-- /.modal -->
@endsection





