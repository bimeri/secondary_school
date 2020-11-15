@extends('student.layout')
@section('title') {{ __('student_viewNote') }} @endsection
@section('style')
<style>
td, th, tr{
    border-collapse: collapse;
    border: 1px solid black !important;
    font-size: 14px !important;
    text-align: center !important;
}
</style>
@endsection
@section('content')
<div class="row">
    <div class="col s12 m10 w3-border-s offset-m1 radius white">
        <div class="col s12 m12 w3-padding" style="overflow-x:auto !important;">
            <table class="w3-table w3-striped w3-border-blue" style="font-size: 15px !important;">
                <tr class="teacher w3-blue">
                    <th>S/N</th>
                    <th>Teacher's Name</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th colspan="2">Action</th>
                </tr>
                <tbody>
                    @if (count($files) > 0)
                    @foreach ($files as $key => $file)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                           <?php $name = explode('_'.$file->teacher_id.'', trim($file->file_name)); echo $name[0]; ?>
                        </td>
                        <td>{{ $file->teacher->full_name }}</td>
                        <td>{{ $file->file_type }}
                            @if($file->file_type == 'PDF')
                            <b><i class="fa fa-file-pdf w3-xlarge red-text"></i></b>
                            @elseif($file->file_type == 'WORD')
                            <b><i class="fa fa-file-word w3-xlarge blue-text"></i></b>
                            @elseif($file->file_type == 'VIDEO')
                            {{--    --}}
                            @elseif($file->file_type == 'AUDIO')
                            {{--    --}}
                            @endif
                        </td>

                        <td>
                        @if($file->share == 1)
                        <a href="{{ route('student.view.file', ['fileId' => Crypt::encrypt($file->id), 'subjectId' => Crypt::encrypt($file->subject_id)]) }}" class="w3-btn w3-green w3-text-white w3-small lighten-1 waves-effect waves-light">View Note <i class="fa fa-eye w3-small"></i></a>
                        @else
                        <button class="w3-btn red red-text lighten-4 waves-effect waves-light w3-medium">Not Published <i class="fa fa-share-alt-square"></i></button>
                        @endif
                        </td>

                        <td><a class="w3-btn w3-blue w3-text-white w3-small lighten-1 waves-effect waves-light">Download <i class="fa fa-download w3-small"></i></a></td>
                    </tr>
                    @endforeach
                    @else
                        <tr class="red red-text lighten-4 center">
                            <td colspan="8">
                                No Lecture note given by the teacher for the current academic year.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
