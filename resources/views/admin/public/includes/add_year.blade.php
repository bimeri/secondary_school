{{-- modal to add sequences --}}
<div id="modall2" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4 class="w3-center teal-text">Add More Academic Year.</h4>
      <hr style="border-top: 1px solid orange">
        <div class="row">
            <form action="{{ route('setting.year.create') }}" method="post">
                @csrf
                <div class="row">
                    <input type="text" class="col s6 m4 right" value="{{ $current_year->name }}" readonly><br><br><hr>
                   <div class="col input-field s12 m6 offset-m2">
                       @include('admin.public.includes.year')
                   </div>
                </div>
                <div class="col s6 m3 offset-m4 offset-s3 w3-center" style="margin-top: 4px !important">
                    <button class="btn teal waves-effect waves-light w3-small" type="submit">Saved</button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="modal-close red waves-effect waves-green btn-flat right white-text">Cancel</button>
    </div>
</div>
