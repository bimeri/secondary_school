@extends('admin.layout')
@section('title') All Teacher @endsection
@section('content')
<p class="w3-center">@lang('messages.welcome')</p>

<div class="row w3-margin-top">
    <div class="col s11 m10 w3-border-t offset-m1 w3-padding white w3-margin-bottom radius w3-margin-left" style="margin-top: -13px">
        @if ($teachers->count() == 0)
        <div class="red lighten-4 red-text w3-padding w3-border w3-center bold">Not yet Registered any teacher</div>
        @endif
        <div class="col s12 m12" style="overflow-x:scroll !important;">
            <table id="myTable" class="w3-table w3-striped w3-border-t" style="font-size: 13px !important;">
                <tr class="teal">
                    <th>S/N</th>
                    <th>profile</th>
                    <th>Full Name</th>
                    <th>email</th>
                    <th>gender</th>
                    <th>Subjects</th>
                    <th>Action</th>
                </tr>
                @foreach ($teachers as $key => $user)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            <img src="{{ URL::asset('image/teacher/'.$user->profile.'') }}" width="50" height="50" class="w3-circle w3-border-t">
                        </td>
                        <td>{{ $user->full_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->gender }}</td>
                        <td>
                            @if (DB::table('subject_teacher')->where('teacher_id', $user->id)->exists())
                                <button class="btn orange waves-effect waves-green w3-small modal-trigger" href="#modall{{ $key + 1 }}">view Subjects
                                    <i class="fa fa-eye w3-small"></i>
                                </button>
                            @else
                                <b class="w3-center red-text">No Subject assign</b>
                            @endif
                        </td>
                        <td>
                            <a class="btn green waves-light waves-effect"  href="{{ route('teacher.subject.select', ['userId' => Crypt::encrypt($user->id)]) }}">
                                Select Subjects <i class="fa fa-pen w3-small"></i>
                            </a>
                        </td>
                    </tr>
                    {{--  all teacher subjects  --}}
                    <div id="modall{{ $key + 1 }}" class="modal modal-fixed-footer" >
                        <div class="modal-content">
                        <h4 class="w3-center orange-text">All subjects assigned for <b class="upper">{{ $user->full_name }}.</b> </h4>
                        <hr style="border-top: 1px solid teal">
                            <div class="row">
                                <ul class="w3-ul">
                                    <li class="w3-center blue-text">Subject Name <i class="fa fa-arrow-right teal-text"></i>
                                        Subject Class <i class="fa fa-arrow-right teal-text"></i>
                                        Class Background <i class="fa fa-arrow-right teal-text"></i>
                                        Class Sector
                                    </li>
                                    <?php $user_subject =DB::table('subject_teacher')->where('teacher_id', $user->id)->get(); ?>
                                    @foreach ($user_subject as $k => $sub)
                                        <?php $subjects = App\Subject::where('id', $sub->subject_id)->get(); ?>
                                        @foreach ($subjects as $subject)
                                            <li>{{ $k + 1 }}).
                                                {{ $subject->name }} <i class="fa fa-arrow-right teal-text w3-tiny"></i>
                                                {{ $subject->form->name }} <i class="fa fa-arrow-right teal-text w3-tiny"></i>
                                                {{ $subject->form->background->name }} <i class="fa fa-arrow-right teal-text w3-tiny"></i>
                                                {{ $subject->form->background->sector->name }}
                                            </li>
                                        @endforeach
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="modal-close red lighten-2 waves-effect waves-green btn-flat right white-text">Cancel</button>
                        </div>
                    </div>
                    {{--  end teacher subjects  --}}
                @endforeach
            </table>
        </div>
            {{ $teachers->onEachSide(5)->links() }}
    </div>
</div>

<script>

</script>
@endsection
