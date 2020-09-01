@extends('admin.layout')
@section('title') rank student @endsection
@section('style')
<style>
    table{
        border: 1px solid black !important;
        box-shadow: 0 0 25px rgb(130, 243, 130), inset 0 0 25px rgb(138, 224, 138);
    }
    td, th, tr{
        border: 1px solid black !important;
        font-size: 11px !important
    }
    th>div#stud{
        margin-top: 10px !important;
        transform: rotate(-23deg) !important;
    }
    input[type='number'].sp{
        position: absolute !important;
        outline: none !important;
        border: 1px solid transparent !important;
        border-bottom: 1px solid white !important;
        width: 60px !important;
        height: 30px !important;
        margin-top: -8px !important;
        margin-left: -31px !important;
    }
    input[type='number'].ss{
        position: absolute !important;
        outline: none !important;
        border: 1px solid transparent !important;
        border-bottom: 1px solid white !important;
        width: 60px !important;
        height: 30px !important;
        margin-top: -8px !important;
        margin-left: -31px !important;
    }
    input[type = 'number'].sp{
        color:#2196F3 !important;
        text-align: center;
        font-weight: bold;
        font-size: 11px !important;
        font-family: 'Comic sans MS';
    }
    input[type = 'number'].ss{
        color:#F44336 !important;
        text-align: center;
        font-weight: bold;
        font-size: 12px !important;
        font-family: 'Comic sans MS';
    }
    th#subjects{
        max-width: 5px !important;
        max-height: 5px !important;
        text-rendering: inherit;
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }
    input[type=number]{
        -moz-appearance: textfield !important;
    }
    .row .col.m7 {
    width: 59.3333333333% !important;
    margin-left: auto;
    left: auto;
    right: auto;
  }
  .row .col.m12 {
    width: 98% !important;
    margin-left: auto;
    left: auto;
    right: auto;
  }
  .hover{
      cursor: pointer;
  }
  .st{
    -webkit-box-reflect: right 10px linear-gradient(transparent, #cc00ff, #0002);
    box-shadow: 0 0 25px rgb(130, 243, 130), inset 0 0 25px rgb(138, 224, 138);
    animation: rot 3s linear infinite;
  }
  @keyframes rot{
    0%{
        box-shadow: 0 0 10px rgb(130, 243, 130), inset 0 0 10px rgb(138, 224, 138);
      }
    20%{
        box-shadow: 0 0 20px rgb(130, 243, 130), inset 0 0 20px rgb(138, 224, 138);
      }
    40%{
        box-shadow: 0 0 10px rgb(207, 50, 44), inset 0 0 10px rgb(207, 50, 44);
      }
    60%{
        box-shadow: 0 0 20px rgb(207, 50, 44), inset 0 0 20px rgb(207, 50, 44);
      }
    80%{
        box-shadow: 0 0 10px rgb(204, 193, 36), inset 0 0 10px rgb(204, 193, 36);
      }
    100%{
        box-shadow: 0 0 20px rgb(204, 193, 36), inset 0 0 20px rgb(204, 193, 36);
      }
  }

</style>
@endsection
@section('content')
<div class="row">
    <h5 class="right w3-padding w3-center" style="position: absolute; float: right !important"><b>{{ $current_year->name }}</b> Academic year<br>{{ $current_term->name }}</h5>
    <div class="col s12 m6 offset-m3 teal teal-text lighten-5 waves-effect waves-orange w3-center">
        @lang('messages.rank_student')
    </div>
</div>
{{-- <ul class="tooltip-wrapper">
    <li><a href="#" class="tooltip tooltip-top" data-tooltip="Hey, I'm at the top!">Tooltip top</a></li>
    <li><a href="#" class="tooltip tooltip-bottom" data-tooltip="And I'm at the bottom">Tooltip bottom</a></li>
    <li><a href="#" class="tooltip tooltip-left" data-tooltip="I'm left all alone">Tooltip left</a></li>
    <li><a href="#" class="tooltip tooltip-right" data-tooltip="You're wrong and I'm right">Tooltip right</a></li>
</ul> --}}
<div class="row">
    <div class="col s12 m8 offset-m4">
        <form method="get" action="{{ route('rank.result') }}">
            @csrf
            <div class="row">
                <div class="input-field col m5 s12">
                    <select name="class" id="class">
                        <option value="{{\Crypt::encrypt( $form->id) }}" selected>{{ $form->name }}  / {{ $form->background->name }} / {{ $form->background->sector->name }}</option>
                      @foreach (App\Form::where('id', '!=', $form->id)->get() as $fm)
                        <option value="{{\Crypt::encrypt($fm->id) }}">{{ $fm->name }}  / {{ $fm->background->name }} / {{ $fm->background->sector->name }}</option>
                      @endforeach
                    </select>
                    <label for="class">Select the class</label>
                </div>
                <div class="col m2 offset-s3 m3 input-field">
                    <button class="w3-btn w3-teal waves-effect waves-light" onclick="load()">Generate {{ $current_term->name }} Result</button>
                </div>
            </div>
        </form>
    </div>
    @if(Session::has('message'))
    <div class="row">
        <div class="col s12 m6 offset-m3 w3-center alert alert-danger w3-padding" role="alert" style="height: 70px">
        <div class="col s12 m6 offset-m3 w3-center alert alert-info w3-padding" role="alert" style="height: 70px">
            {{ Session::get('message') }}
        </div>
    </div>

    @else
    <div class="col s11 m11 w3-border-t radius white w3-margin-left">
        <div class="row">
            <div class="col m10 offset-m2 s12 w3-margin-top">
                @if($check->count() == 0)
                <div class="alert alert-warning center w3-padding w3-small" role="alert">
                    <b>Class Result available. Student Rank Sheet have not yet been generated, please click the button on your right to generate student rank</b>
                <i onclick="this.parentElement.style.display='none'" class="close right hover" style="color: green">&times;</i>
                </div>

                @else
                <div class="alert green-text waves-effect waves-green green lighten-4 center w3-padding w3-small" role="alert">
                    <b>Student Result and Ranking has been Successfully Generated for {{ $term_name }} and the academic year {{ $year_name }}</b>
                <i onclick="this.parentElement.style.display='none'" class="close right hover" style="color: green;">&times;</i>
                </div>
                @endif
            </div>

            @if($check->count() == 0)
            <form method="post" action="{{ route('sutdent.result.generate') }}">
                @csrf
                <input type="hidden" name="year_id" value="{{ $year->id }}"/>
                <input type="hidden" name="term_id" value="{{ $seq_term->id }}"/>
                <input type="hidden" name="class_id" value="{{ $class }}"/>
                <button type="submit"
                        class="btn blue waves-effect waves-light right st"
                        style="position: fixed; right:10px;top:180px; border-radius:10px"
                        onclick="load()">Generate</button>
            </form>
             @endif

            <div class="row">
                <div class="col s12 m10 offset-m1">
                    <table id="myTable" class="w3-table" style="font-size: 13px !important; margin:5px">
                        <tr class="teal">
                            <th>subjects</th>
                            <th>coefficient</th>
                            <th>average points</th>
                            <th>Number of Students</th>

                        </tr>
                        @foreach ($subjects as $key => $subject)
                            <tr>
                                <td>{{ $subjects[$key]['subject_name'] }}</td>
                                <td>{{ $subjects[$key]['subject_coff'] }}</td>
                                <td>{{ $subjects[$key]['point'] }}</td>
                                <td>{{ $subjects[$key]['number_student'] }}</td>
                            </tr>
                        @endforeach
                        <tr class="teal-text center" style="background-color: rgb(169, 238, 238)">
                            <td>Total</td>
                            <td class="bold">{{ $sum_coff }}</td>
                            <td class="bold">{{ $total_point }}</td>
                            <td class="bold">{{ $total_student}}</td>
                        </tr>
                        </tr>
                        @foreach ($subjects as $key => $subject)
                            <tr>
                                <td>{{ $subjects[$key]['subject_name'] }}</td>
                                <td>{{ $subjects[$key]['subject_coff'] }}</td>
                                <td>{{ $subjects[$key]['point'] }}</td>
                                <td>{{ $subjects[$key]['number_student'] }}</td>
                            </tr>
                        @endforeach
                        <tr class="teal-text center" style="background-color: rgb(169, 238, 238)">
                            <td>Total</td>
                            <td class="bold">{{ $sum_coff }}</td>
                            <td class="bold">{{ $total_point }}</td>
                            <td class="bold">{{ $total_student}}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col s12 m12" style="overflow-x: auto">
                    <table id="myTable" class="w3-table" style="font-size: 13px !important; margin:5px">
                        <tr class="teal">
                            <th rowspan="2">subjects</th>
                            <th colspan="6">{{ $seq_name1 }}</th>
                            <th colspan="6">{{ $seq_name2 }}</th>
                        </tr>

                        <tr>
                            <td>Students</td>
                            <td>took test</td>
                            <td>passed</td>
                            <td>highest Mark</td>
                            <td>Percetage /100</td>
                            <td>Average /20</td>

                            <td>Students</td>
                            <td>toke test</td>
                            <td>passed</td>
                            <td>highest Mark</td>
                            <td>Percetage /100</td>
                            <td>Average /20</td>
                        </tr>

                        @foreach ($term as $key => $item)
                        <tr>
                            <td>{{ $term[$key]['sub_name'] }}</td>
                            <td>{!! $term[$key]['sub_name'] !!}</td>

                            <td>{{ $term[$key]['first_test_student'] }}</td>
                            <td>{{ $term[$key]['total_wrote'] }}</td>
                            <td>{{ $term[$key]['total_pass'] }}</td>
                            <td>{{ $term[$key]['highest_mark'] }}</td>
                            <td @if($term[$key]['percentage']  < 50) style="color:#F44336" @else  style="color:#2196F3"  @endif>{{ $term[$key]['percentage'] }} %</td>
                            <td @if($term[$key]['average']  < 10) style="color:#F44336" @else  style="color:#2196F3"  @endif>{{ $term[$key]['average'] }}</td>


                            <td>{{ $terms[$key]['second_test_student'] }}</td>
                            <td>{{ $terms[$key]['total_wrote_two'] }}</td>
                            <td>{{ $terms[$key]['total_pass_two'] }}</td>
                            <td>{{ $terms[$key]['highest_mark_two'] }}</td>
                            <td @if($terms[$key]['percentage_two']  < 50) style="color:#F44336" @else  style="color:#2196F3"  @endif>{{ $terms[$key]['percentage_two'] }}</td>
                            <td @if($terms[$key]['average_two']  < 50) style="color:#F44336" @else  style="color:#2196F3"  @endif>{{ $terms[$key]['average_two'] }}</td>
                        </tr>
                        @endforeach

                        <tr class="teal-text center" style="background-color: rgb(169, 238, 238)">
                            <td>Total</td>

                            <td class="bold">{{ $term[$key]['total_student'] }}</td>
                            <td class="bold"></td>
                            <td class="bold"></td>
                            <td class="bold"></td>
                            <td class="bold" @if($term[$key]['total_percent']  < 50) style="color:red" @else  style="color:blue"  @endif>{{ $term[$key]['total_percent'] }}</td>
                            <td class="bold" @if($term[$key]['total_average']  < 10) style="color:red" @else  style="color:blue"  @endif>{{ $term[$key]['total_average'] }}</td>

                            <td class="bold">{{ $terms[$key]['total_student_two'] }}</td>
                            <td class="bold"></td>
                            <td class="bold"></td>
                            <td class="bold"></td>
                            <td class="bold" @if($terms[$key]['total_percent_two']  < 50) style="color:red" @else  style="color:blue"  @endif>{{ $terms[$key]['total_percent_two'] }}</td>
                            <td class="bold" @if($terms[$key]['total_average_two']  < 10) style="color:red" @else  style="color:blue"  @endif>{{ $terms[$key]['total_average_two'] }}</td>
                        </tr>
                    </table>
                </div>
                            <td @if($terms[$key]['average_two']  < 10) style="color:#F44336" @else  style="color:#2196F3"  @endif>{{ $terms[$key]['average_two'] }}</td>
                        </tr>
                        @endforeach

                        <tr class="teal-text center" style="background-color: rgb(169, 238, 238)">
                            <td>Total</td>

                            <td class="bold">{{ $term[$key]['total_student'] }}</td>
                            <td class="bold"></td>
                            <td class="bold"></td>
                            <td class="bold"></td>
                            <td class="bold" @if($term[$key]['total_percent']  < 50) style="color:red" @else  style="color:blue"  @endif>{{ $term[$key]['total_percent'] }} &percnt;</td>
                            <td class="bold" @if($term[$key]['total_average']  < 10) style="color:red" @else  style="color:blue"  @endif>{{ $term[$key]['total_average'] }}</td>

                            <td class="bold">{{ $terms[$key]['total_student_two'] }}</td>
                            <td class="bold"></td>
                            <td class="bold"></td>
                            <td class="bold"></td>
                            <td class="bold" @if($terms[$key]['total_percent_two']  < 50) style="color:red" @else  style="color:blue"  @endif>{{ $terms[$key]['total_percent_two'] }} &percnt;</td>
                            <td class="bold" @if($terms[$key]['total_average_two']  < 10) style="color:red" @else  style="color:blue"  @endif>{{ $terms[$key]['total_average_two'] }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="alert alert-info center" role="alert">
             Subjects Passed Average: <b class="{{ $class_average < 10 ? 'red-text':'blue-text' }}">{{ $class_average }}, </b> Subjects Percentage passed: <b class="{{ $class_percentage < 50 ? 'red-text':'blue-text' }}">{{ $class_percentage }} %</b>

            </div>
        </div>
    </div>
    @endif
</div>

@endsection

