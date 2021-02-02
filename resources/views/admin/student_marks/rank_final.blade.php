@extends('admin.layout')
@section('title') rank student @endsection
@section('style')
<style>
    table{
        border: 1px solid black !important;
        /* box-shadow: 0 0 25px rgb(130, 243, 130), inset 0 0 25px rgb(138, 224, 138); */
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
    -webkit-box-reflect: right 10px linear-gradient(transparent, #d17fe6, #0002);
    box-shadow: 0 0 10px rgb(130, 243, 130), inset 0 0 10px rgb(138, 224, 138);
    animation: rot 3s linear infinite;
  }
  @keyframes rot{
    0%{
        box-shadow: 0 0 5px rgb(130, 243, 130), inset 0 0 5px rgb(138, 224, 138);
      }
    20%{
        box-shadow: 0 0 10px rgb(130, 243, 130), inset 0 0 10px rgb(138, 224, 138);
      }
    40%{
        box-shadow: 0 0 5px rgb(228, 122, 119), inset 0 0 5px rgb(216, 102, 98);
      }
    60%{
        box-shadow: 0 0 10px rgb(209, 123, 120), inset 0 0 10px rgb(201, 106, 103);
      }
    80%{
        box-shadow: 0 0 5px rgb(228, 220, 112), inset 0 0 5px rgb(212, 205, 101);
      }
    100%{
        box-shadow: 0 0 20px rgb(207, 202, 126), inset 0 0 20px rgb(226, 221, 148);
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
<div class="row">
    @if(Session::has('message'))
    <div class="row">
        <div class="col s12 m6 offset-m3 w3-center alert alert-info w3-padding" role="alert" style="height: 70px">
            {{ Session::get('message') }}
        </div>
    </div>

    @else
    <div class="col s12 m6 offset-m3">
        @if($check->count() == 0)
            <form method="post" action="{{ route('student.result.generate') }}">
                @csrf
                <input type="hidden" name="year_id" value="{{ $year->id }}"/>
                <input type="hidden" name="term_id" value="{{ $seq_term->id }}"/>
                <input type="hidden" name="class_id" value="{{ $class }}"/>
                <button type="submit" class="btn blue waves-effect waves-light right"
                        onclick="load()">Generate General Result</button>
            </form>
            @else
            <button class="btn pink pink-text lighten-4 waves-effect waves-light right">general result generated</button>
        @endif

        @if($check->count() == 0)
        @else
            @if($class_ranked > 0)
                <form method="post" action="{{ route('generate.class.result') }}">
                    @csrf
                    <input type="hidden" name="year_id" value="{{ $year->id }}"/>
                    <input type="hidden" name="term_id" value="{{ $seq_term->id }}"/>
                    <input type="hidden" name="class_id" value="{{ $class }}"/>
                    <button type="submit" class="btn green waves-effect waves-light col offset-m1"
                            onclick="load()">Generate Result per class
                    </button>
                </form>
            @else
                <button class="btn pink pink-text lighten-4 waves-effect waves-light left">class result generated</button>
            @endif
        @endif
    </div>

    <div class="col s12 m10 offset-m1 w3-border-t radius white w3-margin-left">
        <div class="row">
            <div class="col m10 offset-m1 s12 w3-margin-top">
                @if($check->count() == 0)
                <div class="alert alert-warning center w3-padding w3-small" role="alert">
                    <b>Class Result available. Student Rank Sheet have not yet been generated, please click the button on your right to generate student rank</b>
                <i onclick="this.parentElement.style.display='none'" class="close right hover" style="color: green">&times;</i>
                </div>

                @else
                <div class="alert green-text waves-effect waves-green green lighten-4 center w3-padding w3-small" role="alert">
                    <b>Student Result and Ranking has been Successfully Generated for <b>{{ $term_name }}</b> and the academic year {{ $year_name }}</b>
                <i onclick="this.parentElement.style.display='none'" class="close right hover" style="color: green;">&times;</i>
                </div>
                @endif
            </div>

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
                            <td>took test</td>
                            <td>passed</td>
                            <td>highest Mark</td>
                            <td>Percetage /100</td>
                            <td>Average /20</td>
                        </tr>

                        @foreach ($term as $key => $item)
                        <tr>
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
                            <td @if($terms[$key]['average_two']  < 10) style="color:#F44336" @else  style="color:#2196F3"  @endif>{{ $terms[$key]['average_two'] }}</td>
                        </tr>
                        @endforeach

                        <tr class="teal-text center" style="background-color: #a9eeee">
                            <td>Total</td>

                            <td class="bold">{{ $term[$key]['total_student'] }}</td>
                            <td class="bold"></td>
                            <td class="bold"></td>
                            <td class="bold"></td>
                            <td class="bold" @if($term[$key]['total_percent']  < 50) style="color:#ff0000" @else  style="color:#0000ff"  @endif>{{ $term[$key]['total_percent'] }} &percnt;</td>
                            <td class="bold" @if($term[$key]['total_average']  < 10) style="color:#ff0000" @else  style="color:#0000ff"  @endif>{{ $term[$key]['total_average'] }}</td>

                            <td class="bold">{{ $terms[$key]['total_student_two'] }}</td>
                            <td class="bold"></td>
                            <td class="bold"></td>
                            <td class="bold"></td>
                            <td class="bold" @if($terms[$key]['total_percent_two']  < 50) style="color:#ff0000" @else  style="color:#0000ff"  @endif>{{ $terms[$key]['total_percent_two'] }} &percnt;</td>
                            <td class="bold" @if($terms[$key]['total_average_two']  < 10) style="color:#ff0000" @else  style="color:#0000ff"  @endif>{{ $terms[$key]['total_average_two'] }}</td>
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
<a href="{{ route('student.rank.result') }}" onclick="load()" class="btn black white-text lighten-4" style="position: fixed; bottom:10px; left: 10px; z-index:10"><i class="fa fa-arrow-alt-circle-left"></i> Go back</a>

@endsection
