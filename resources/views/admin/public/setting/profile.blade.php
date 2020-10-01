@extends('admin.layout')
@section('title') {{ __('school profile') }} @endsection
@section('content')
<div class="row">
    <div class="col s4 m5">
        <h5 class="teal-text w3-padding left"><b class="black-text">School Name:</b> {{ $setting->school_name }}. <b> @if($setting->school_id != null) ({{ $setting->school_id }})@endif</b></h5>
    </div>
    <div class="col s4 m2">
        <img src="{{ URL::asset('image/logo/'.$setting->logo.' ') }}"  class="image center" alt="logo" style="margin-top:-10px; height:100px; width:100px">
    </div>
    <div class="col s4 m4">
        <h5 class="teal-text w3-padding right"><b class="black-text">School Motto:</b> {{ $setting->motto }}</h5>
    </div>

    <div class="col s11 m10 w3-border-t offset-m1 w3-padding white w3-margin-bottom radius w3-margin-left" style="margin-top: 10px">
        <h4 class="w3-center teal-text">Fill all the form bellow to Update user information </h4>

        <div class="row">
            <form action="{{ route('setting.school.profile') }}" method="POST" enctype="multipart/form-data">
                <div class="row">
                        @csrf
                        <h6 class="w3-center bold"><u>Change School Profile</u></h6>
                        <div class="input-field col s12 m4">
                            <input type="text" name="school_name" class="validate" id="sname" value="{{ $setting->school_name }}">
                            <label for="sname">School Name</label>
                        </div>
                        <div class="input-field col s12 m4">
                            <input type="text" name="school_motto" class="validate" id="motto" value="{{ $setting->motto }}">
                            <label for="motto">School Motto</label>
                        </div>
                        <div class="file-field input-field col s12 m4">
                            <div class="btn">
                              <input type="file" name="profile_image" id="imgInp">
                            </div>
                            <div class="file-path-wrapper">
                              <img id="blah" src="#" alt="Upload profile" height="60" width="70"/>
                              <input class="file-path validate" name="profile_image" type="text" placeholder="select profile Logo">
                              <label for="logo">School Logo</label>
                            </div>
                        </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        @if ($setting->school_id == null)
                        <input type="text" name="school_id" class="validate" id="schoolid" placeholder="{{ $setting->school_id ?? 'eg. BG or GH, or SJ etc' }}"/>
                        @else
                        <input type="text" class="validate" id="schoolid" placeholder="{{ $setting->school_id}}" readonly/>
                        @endif
                        <label for="schoolid">School Distinct ID (Maximum of two(2) character)</label><br><br>
                        <a class="blue-text bold modal-trigger" href="#modal"><u>Learn More about school Id</u></a><br><br>
                    </div>
                    <div class="w3-center"><br><br><br>
                        <button class="btn teal waves-effect waves-light w3-small" type="submit" style="width: 40%">Save School profile profile</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modal" class="modal modal-fixed-footer" style="width: 40% !important">
    <div class="modal-content">
      <h4 class="w3-center teal-text">Learn More about School Distinct Identification</h4>
      <hr style="border-top: 1px solid teal">
        <div class="row">
            <div class="col s12 m12">
                <div class="w3-padding w3-center-bottom" style="text-align: justify;text-justify: inter-word;">
                    <b class="blue-text">1.</b> The school unique Id is use to generate student matricule number.<br>
                    This number will sustain the student stay in the School from his enrollement day till the day he graduate.<br>
                    <b class="blue-text"><br>2.</b> All student must have a unique number that will be used to identify them, especially when writing exams or
                    when enrolling them to another class.<br>
                    <b class="blue-text"><br> 3.</b>All these matricule number should start with a unique character and should not be greater than Six(6)
                    digit.<br>
                    <b class="blue-text"><br> 4.</b>The <b>Unique character</b> is what is required for you as the admin to set. once set for you school,
                    it will remain unchanged till the at leat an academic year finished before it can be changed. <br>
                    <b class="blue-text"><br> 5.</b> It can't be changed while registration is currently going on, because the system will use it to auto generate a unique matricule number for the student.<br>
                    <b class="blue-text"><br> 6.</b> These unique Character should be a maximum of two letters, so that student will not need to memorize something beyond their ability.<br>
                    <b class="blue-text"><br> 7.</b> Example of generating these character: If the School Name is <em class="teal-text bold">Government Technical High School</em>,
                    you can generate a Unique identifier <b class="teal-text">GT, or GH</b>, so much such that it matches the the name in one way or the other.<br>
                    <b class="blue-text"><br> 8.</b> Sample of School Id are <b>GS0A01, GS0A02, GS0B03, GS1A01 etc.</b> where the <em class="green-text">GS</em> is the unique identifier, the <em class="green-text">0 or 1</em> that follows
                    is the last character of the year of enrollement, that is 2020. the <em class="green-text">A</em> is for continuation if the number reaches it maximun, it will auto switch to <em class="green-text">B01</em>.
                    <br><br>
                    <h6 class="w3-center"><u>Common Examples</u></h6>
                    <ul class="w3-ul">
                        <li>Saint Joseph's college <i class="fa fa-arrow-right w3-small teal-text"></i> SJ or SC</li>
                        <li>Bilingual Grammar School <i class="fa fa-arrow-right w3-small teal-text"></i> BG or BS</li>
                        <li>Government High School <i class="fa fa-arrow-right w3-small teal-text"></i> GH or GS</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="modal-close teal waves-effect waves-green btn-flat right white-text">closed</button>
    </div>
</div>

@endsection
