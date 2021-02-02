<div id="modal{{ $key + 1 }}" class="modal modal-fixed-footer">
    <div class="modal-content" style="overflow-x: hidden">
      <h4 class="w3-center teal-text">Update Teacher information</h4>
      <hr style="border-top: 1px solid orange">
        <div class="row">
            <form action="{{ route('teacher.update') }}" method="post">
                @csrf
                <div class="row">
                    <input type="hidden" name="teacherId" value="{{ $user->id }}">
                    <div class="input-field col s12 m3 offset-m2">
                        <input name="fname" id="name" type="text" class="validate" value="{{ $user->full_name }}">
                        <label for="name">update Name</label>
                    </div>
                    <div class="input-field col s12 m3">
                        <input id="email" name="email" type="email" value="{{ $user->email }}" class="validate">
                        <label for="email">Update email</label>
                    </div>
                    <div class="input-field col s12 m3">
                        <input id="coff" name="uname" type="text" value="{{ $user->user_name }}" class="validate">
                        <label for="coff">update user Name</label>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m3 offset-m2">
                            <select name="gender" class="icons browser-default" required>
                              <option value="{{ $user->gender }}" selected>{{ $user->gender }}</option>
                              <option value="Male" data-icon="{{ URL::asset('image/man.png') }}">Male</option>
                              <option value="Female" data-icon="{{ URL::asset('image/female.png') }}">Female</option>
                            </select>
                            <label>Select Gender</label>
                        </div>
                        <div class="input-field col s12 m3">
                            <input type="date" name="date_of_birth" value="{{ $user->date_of_birth }}" class="validate" id="dates">
                            <label for="dates"> enter Date of birth</label>
                        </div>
                    </div>
                </div>
                <center>
                    <button type="submit" class="btn orange waves-effect waves-light" style="width: 40%">Register Teacher</button>
                </center><br>
            </form>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="modal-close red waves-effect waves-green btn-flat right white-text">Cancel</button>
    </div>
</div>
