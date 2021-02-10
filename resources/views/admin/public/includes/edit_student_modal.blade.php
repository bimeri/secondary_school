<div id="modal{{ $key + 1 }}" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4 class="w3-center orange-text">Edit <b>{{ $value->student->full_name }}</b> bio information</h4>
      <hr style="border-top: 1px solid orange">
        <div class="row">
            <form action="{{ route('student_info.update') }}" method="post" enctype="multipart/form-data" id="fm">
                {{ csrf_field() }}
                <input type="hidden" name="studentId" value="{{ $value->student_id }}" >
                <div class="row">
                     <div class="input-field col s12 m4 offset-m2">
                        <input name="fullName" id="first_name" type="text" class="validate" value="{{ $value->student->full_name }}">
                        <label for="first_name">Full Name</label>
                    </div>
                    <div class="input-field col m4 s12 m2">
                        <input id="email" name="email" type="email" value="{{ $value->student->email }}" class="validate">
                        <label for="email">Email </label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m3 offset-m1">
                        <input type="number" name="parent_contact" value="{{ $value->parent_contact }}" class="validate" id="pcontact">
                        <label for="pcontact">Parent contact</label>
                    </div>
                    <div class="input-field col s12 m3">
                        <input type="text" name="paddress" value="{{ $value->address }}" class="validate" id="address">
                        <label for="address">Parent Address</label>
                    </div>
                    <div class="input-field col s12 m3">
                        <input type="email" name="parent_email" value="{{ $value->parent_email }}" class="validate" id="address">
                        <label for="address">Parent email</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m3 offset-m1">
                        <input type="text" name="pob" value="{{ $value->student->place_of_birth }}" class="validate" id="address" required/>
                        <label for="address">Enter place of birth</label>
                    </div>
                    <div class="input-field col s12 m3">
                        <select name="gender" class="browser-default" required>
                          <option value="{{ $value->gender }}" selected>{{ $value->gender }}</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="input-field col s12 m3">
                        <input type="date" name="date_of_birth" value="{{ $value->date_of_birth }}" id="dates" placeholder="dd/mm/yy">
                        <label for="dates">Enter Date of birth</label>
                    </div>
                </div>
                <center>
                    <div class="w3-padding" style="margin-top: -50px !important">
                        <button class="w3-btn orange waves-effect waves-light w3-medium white-text" type="submit" style="width: 42%">Update {{ $value->student->full_name }} Information</button>
                    </div>
                </center>
            </form>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="modal-close red waves-effect waves-green btn-flat right white-text">Cancel</button>
    </div>
</div>
