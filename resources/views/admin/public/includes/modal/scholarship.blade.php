<div id="modal{{ $key + 1 }}" class="modal modal-fixed-footer" style="width: 80% !important">
    <div class="modal-content">
      <h4 class="w3-center teal-text">Fill the form to Give Student Scholarship award.<br>
        @foreach (App\Student::where('school_id', $user->student_school_id)->get() as $info)
       <b class="blue-text"> ({{ $info->full_name }} -- {{ $user->student_school_id }})</b>
        @endforeach

    </h4>
      <hr style="border-top: 1px solid orange">
        <div class="row">
            <form action="{{ route('scholarship.student.create') }}" method="post">
                @csrf
                <div class="row">
                    <?php $uid = App\Student::where('school_id', $user->student_school_id)->first(); ?>
                    <input type="hidden" name="student_id" value="{{ $uid->id }}">
                    <div class="col s12 m2 offset-m1">
                        <select name="year" class="browser-default">
                            <option value="{{ $current_year->id }}" selected>{{ $current_year->name }}</option>
                            @foreach (App\Year::where('active', '!=', 1)->get() as $year)
                                <option value="{{ $year->id }}">{{ $year->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col s12 m2">
                        <select name="term" class="browser-default">
                            <option value="{{ $current_term->id }}" selected>{{ $current_term->name }}</option>
                            @foreach (App\Term::where('active', '!=', 1)->get() as $term)
                                <option value="{{ $term->id }}">{{ $term->name }}</option>
                            @endforeach
                        </select>
                    </div>
                     <div class="col s12 m4">
                        <select name="class" class="browser-default">
                            <option value="{{ $user->form_id }}">
                                @foreach (App\Form::where('id', $user->form_id)->get() as $form)
                                    <option value="{{ $form->id }}" selected>{{ $form->name }} / {{ $form->background->name }} / {{ $form->background->sector->name }}</option>
                                @endforeach
                            </option>
                                @foreach (App\Form::all() as $form)
                                    <option value="{{ $form->id }}">{{ $form->name }} / {{ $form->background->name }} / {{ $form->background->sector->name }}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="col s12 m2">
                        <input type="number" name="amount" placeholder="enter amount">
                    </div>
                </div>
                <div class="col s12 m6 offset-m3 input-field">
                    <textarea id="reason" name="reason" class="materialize-textarea" placeholder="spend money on this because of ..."></textarea>
                    <label for="reason">Reason</label>
                </div>
                <div class="col s6 m3 offset-m4 offset-s3 w3-center" style="margin-top: 4px !important">
                    <button class="btn teal waves-effect waves-light w3-small" type="submit">Give Scholarship</button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="modal-close red waves-effect waves-green btn-flat right white-text">Cancel</button>
    </div>
</div>
