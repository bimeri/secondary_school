<div id="modal1" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4 class="w3-center teal-text">Add More Sequences. Sequences belong to term</h4>
      <hr style="border-top: 1px solid orange">
        <div class="row">
            <form action="{{ route('sequence.create') }}" method="post">
                @csrf
                <div class="row">
                    <input type="text" class="col s6 m4 right" value="{{ $current_term->name }}" readonly>
                    <input type="hidden" class="col s6 m4 right" value="{{ $current_term->id }}" name="termId">
                </div>
                <div class="col s6 m6 offset-m3 input-field">
                    <input type="text" name="sequence" class="validate" placeholder="Enter the sequnces name" id="sequence">
                    <label for="sequence" class="black-text">Sequences Name</label>
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
