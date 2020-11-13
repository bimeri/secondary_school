@extends('teacher.layout')
@section('title') {{ __('teacher_subjects') }} @endsection
@section('style')
<script src="{{ URL::asset('tinymice.js') }}" referrerpolicy="origin"></script>
  <script>tinymce.init({selector:'textarea'});</script>
@endsection
@section('content')
<div class="row w3-margin-top">
    <div class="col s11 m10 w3-border-teacher offset-m1 radius white">
        <div class="col s12 m12 w3-padding" style="overflow-x:auto !important;">
            <div class="teacher center w3-margin-bottom" style="border-radius: 10px">
                Set Assigment for the year: <b>{{ $year }}</b>, subject: <b>{{ $subject->name }}</b>
            </div>
            <button type="button" href="#modal" class="w3-btn right w3-padding w3-blue waves-effect waves-light  modal-trigger">Add Assignment <i class="fa fa-plus-square"></i></button>
            <hr>
        <table class="w3-table w3-striped w3-border-teacher w3-margin-bottom" style="font-size: 15px !important;">
            <tr class="teacher">
                <th>S/N</th>
                <th>Year</th>
                <th>Subject</th>
                <th>Asssignment</th>
                <th>Date created</th>
                <th colspan="3">Action</th>
            </tr>
            <tbody id="clear">
                @if ($assignments->count() > 0)
                @foreach ($assignments as $key => $file)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $file->year->name}}</td>
                    <td>{{ $file->subject->name }}</td>
                    <td>{{ $file->name}}</td>
                    <td>{{ $file->create_date }}</td>
                    <td><a href="{{ route('teacher.view.assignment', ['subjectId' => Crypt::encrypt($file->subject_id), 'yearId' => Crypt::encrypt($file->year_id), 'assignmentId' => Crypt::encrypt($file->id)]) }}" class="w3-btn blue blue-text lighten-4 waves-effect waves-light w3-medium">Preview <i class="fa fa-eye"></i></a></td>
                    <td>
                        @if($file->status == 1)
                        <button class="w3-btn orange orange-text lighten-4 waves-effect waves-light w3-medium" >Published <i class="fa fa-share-square-o"></i></button>
                        @else
                        <a href="" class="w3-btn green green-text lighten-4 waves-effect waves-light w3-medium">Publish <i class="fa fa-share-alt-square"></i></a>
                        @endif
                    </td>
                    <td><a class="w3-btn red red-text lighten-4 waves-effect waves-light w3-medium">remove <i class="fa fa-trash"></i></a></td>
                </tr>
                @endforeach
                @else
                <tr class="red red-text lighten-4 center bold">
                    <td colspan="8">
                        No available assigment for this Subject.
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
        </div>
    </div>
</div>

{{-- modal --}}
<div id="modal" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4 class="w3-center teal-text">Fill the text area with well formatted text.</h4>
      <hr style="border-top: 1px solid orange">
        <form action="{{ route('teacher.add_assignment') }}" method="POST">
            <div class="row">
                <div class="input-field col s12 m4">
                    <label for="name">Enter assigment title</label>
                    <input type="text" name="name" id="name" required/>
                </div>
            </div>
            <input type="hidden" value="{{ $yearid }}" name="yearId" />
            <input type="hidden" value="{{ $subject->id }}" name="subjectId" />
            @csrf
            <div class="row">
                <textarea required name="text">
                    write your well formated <b>assigments here</b>!
                </textarea>
            </div>
            <div class="col s6 m5 offset-m2 offset-s3 w3-center" style="margin-top: 4px !important">
                <button class="btn w3-teacher waves-effect waves-light w3-small" type="submit" style="width: 30%">Saved</button>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="modal-close red waves-effect waves-green btn-flat right white-text">Cancel</button>
    </div>
</div>
@endsection
