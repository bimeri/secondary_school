@extends('teacher.layout')
@section('title') {{ __('teacher_uplaodFile') }} @endsection
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
<div class="row w3-margin-top">
    <div class="col s12 m12 w3-padding" style="overflow-x:auto !important;">
        <div class="container w3-padding radius green lighten-4 green-text center alert-box w3-t-border">
           Welcome to this ection of e-learning whereby you education is carried on online.
           you will have yo uplaod lessons online for students to download and preview.
        </div>
    </div>
    <div class="col s11 m10 w3-border-teacher offset-m1 radius white">
        <h6 class="w3-padding lime text-darken-3 lighten-4 lime-text center">Select what you want to upload</h6>
        <div class="row"><hr>
            <div class="col s12 m3"><a href="#pdfModal" class="modal-trigger w3-btn w3-orange w3-text-white waves-effect waves-light w3-medium" onclick="setValue('PDF')"> PDF File &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;<i class="fa fa-file-pdf"></i></a></div>
            <div class="col s12 m3"><a href="#pdfModal" class="modal-trigger w3-btn w3-blue waves-light waves-effect w3-medium" onclick="setValue('WORD')"> Word Document &nbsp; &nbsp; &nbsp;<i class="fa fa-file-word"></i></a></div>
            <div class="col s12 m3"><a href="#" class="w3-btn w3-teacher waves-effect waves-light white-text w3-medium" onclick="setValue('AUDIO')">Audio Record &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;<i class="fa fa-play-circle"></i></a></div>
            <div class="col s12 m3"><a href="#" class="w3-btn w3-purple waves-light waves-effect white-text w3-medium" onclick="setValue('VIDEO')">Upload Video &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;<i class="fa fa-video"></i></a></div>
        </div>
        <hr>
        <table class="w3-table w3-striped w3-border-teacher w3-margin-bottom" style="font-size: 15px !important;">
            <tr class="teacher">
                <th>S/N</th>
                <th>Year</th>
                <th>Name</th>
                <th>File Type</th>
                <th>file icon</th>
                <th colspan="3">Action</th>
            </tr>
            <tbody id="clear">
                @if ($files->count() > 0)
                @foreach ($files as $key => $file)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $file->year->name}}</td>
                    <td>{{ $file->subject->name.'/'.$file->subject->code}}</td>
                    <td>{{ $file->file_type}}</td>
                    <td>
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
                    <td><a href="{{ route('preview.pdf', ['file_id' => Crypt::encrypt($file->id)]) }}" class="w3-btn blue blue-text lighten-4 waves-effect waves-light w3-medium">Preview <i class="fa fa-eye"></i></a></td>
                    <td><a class="w3-btn green green-text lighten-4 waves-effect waves-light w3-medium">Share <i class="fa fa-share-alt-square"></i></a></td>
                    <td><a class="w3-btn red red-text lighten-4 waves-effect waves-light w3-medium">Delete <i class="fa fa-trash"></i></a></td>
                </tr>
                @endforeach
                @else
                <tr class="red red-text lighten-4 center bold">
                    <td colspan="8">
                        No files uploaded yet for this Subject.
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
{{-- modal to add sequences --}}
<div id="pdfModal" class="modal modal-fixed-footer">
    <div class="modal-content">
    <h4 class="w3-center teal-text">Select the <b id="setter"></b> file you want to upload</h4>
    <hr style="border-top: 1px solid orange">
        <div class="row">
            <form action="{{ route('pdf.upload') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="subjectId" value="{{ $subject[0]['subject_id'] }}">
                <input type="hidden" name="yearId" value="{{ $subject[0]['yearId'] }}">
                <input type="hidden" name="type" value="" id="set">
                @csrf
                <div class="">
                    <input class="btn" type="file" name="pdf_file">
                    <br>
                </div>

                <div class="w3-center" style="margin-top: 20px !important;">
                    <button class="w3-btn w3-orange w3-text-white teal waves-effect waves-light w3-small w3-margin-top" type="submit" style="width:30% !important">Save</button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="modal-close red waves-effect waves-green btn-flat right white-text">Cancel</button>
    </div>
</div>
{{--  modal end  --}}
<script>
    function setValue(value){
        document.getElementById('setter').innerHTML = value;
        document.getElementById('set').value = value;
    }
</script>
@endsection
