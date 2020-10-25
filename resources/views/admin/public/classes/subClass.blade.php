@extends('admin.layout')
@section('title') Sub-Class @endsection
@section('content')
<div class="row">
    <div class="col s12 m10 offset-m1 orange lighten-5 orange-text">
    <span onclick="this.parentElement.style.display='none'" class="w3-close right orange-text w3-hover w3-medium w3-padding-16" style="cursor: pointer">&times;</span>
        <h5 class="w3-center w3-medium w3-padding bold">{{ __('messages.create_subclass') }}
        </h5>
    </div>
</div>
<div class="row">
    <div class="col s11 w3-margin-left m10 w3-border-t offset-m1 w3-padding white w3-margin-bottom radius" style="margin-top: 5px">
        <form action="{{ route('subclass.form.submit') }}" method="post" id="form">
            @csrf
            <div class="row">
                <div class="input-field col s12 m4">
                   <select class="" name="classId" onchange="getValue(event)">
                       <option value="" disabled selected>select the class you are extending</option>
                       @foreach (App\Form::all() as $class)
                           <option value="{{ $class->id }}">{{ $class->name }} {{ $class->code }}/{{ $class->background->name }}/{{ $class->background->sector->name }}</option>
                       @endforeach
                   </select>
                </div>
                <div class="input-field col s12 m4">
                    <input id="max" name="maximum_number" type="number" value="{{ old('maximum_number') }}" class="validate">
                    <label for="max">Maximum extended capacity</label>
                </div>
                 <div class="input-field col s12 m4">
                    <input id="type" name="type" type="text" value="{{ old('type') }}" class="validate" readonly placeholder="example B,C,D, etc">
                    <label for="type">Class Type </label>
                </div>
            </div>
            <div class="row">
                <button type="submit" class="btn btn-primary waves-effect waves-light col offset-m3 offset-s3" style="width: 50%">Create Sub Class</button>
            </div>
        </form>
    </div>
</div>
@if (App\Subclass::count() > 0)
<div class="row">
    <div class="col s12 m10 offset-m1" style="overflow-x:scroll !important;">
        <table id="myTable" class="w3-table w3-striped w3-border-t" style="font-size: 13px !important;">
            <tr class="teal">
                <th>S/N</th>
                <th>Class Name</th>
                <th>Class Type / Maximum capacity</th>
                <th>Sub-class Type</th>
                <th>Maximum Capacity</th>
                @can('sub_class', App\Permission::class) <th colspan="2">Action</th> @endcan
            </tr>
            @foreach (App\Subclass::orderBy('form_id')->get(); as $key => $class)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $class->form->name }}/{{ $class->form->background->name }}/{{ $class->form->background->sector->name }}</td>
                <td>{{ $class->form->type }} / {{ $class->form->max_number }}</td>
                <td>{{ $class->type }}</td>
                <td>{{ $class->max_number }}</td>
                @can('edit_delete_class', App\Permission::class)
                    <td><button class="btn my-orange waves-light waves-effect capitalize modal-trigger"  href="#modal{{  $key + 1 }}">Edit <i class="fa fa-pencil-alt w3-small"></i></button></td>
                    <td>
                        <form action="{{ route('admin.delete.subclass') }}" method="post" id="form{{ $class->id }}">
                            @csrf
                            <input type="hidden" name="subclassid" value="{{ $class->id }}">
                            <button class="btn my-red waves-light waves-effect capitalize" onclick="save{{ $class->id }}()" id="btn-submit{{ $class->id }}">Delete <i class="fa fa-trash w3-small"></i></button>
                        </form>
                    </td>
                @endcan
            </tr>

            <div id="modal{{  $key + 1 }}" class="modal modal-fixed-footer">
                <div class="modal-content">
                  <h4 class="w3-center teal-text">Update Sub-Class Information</h4>
                  <hr style="border-top: 1px solid orange">
                    <div class="row">
                        <form action="{{ route('admin.edit.subclass') }}" method="post" id="form">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="id" value="{{ $class->id }}" />
                                <div class="input-field col s12 m6">
                                   <select class="browser-default" name="classId" onchange="getValue(event)">
                                       <option value="{{ $class->form_id }}" selected> {{ $class->form->name }}/{{ $class->form->background->name }}/{{ $class->form->background->sector->name }}</option>
                                       @foreach (App\Form::all() as $form)
                                           <option value="{{ $form->id }}"> {{ $form->name }}/{{ $form->background->name }}/{{ $form->background->sector->name }}</option>
                                       @endforeach
                                   </select>
                                </div>
                                <div class="input-field col s12 m4">
                                    <input id="max" name="maximum_number" type="number" value="{{ $class->max_number }}" class="validate">
                                    <label for="max">Update the Maximum extended capacity</label>
                                </div>
                                 <div class="input-field col s12 m2">
                                    <input id="type" name="type" type="text" value="{{ $class->type }}" class="validate" readonly placeholder="example A,B,C,D, etc">
                                    <label for="type">Update Sub-Class Type </label>
                                </div>
                            </div>
                            <div class="row">
                                <button type="submit" class="btn orange white-text waves-effect waves-light col offset-m3 offset-s3" style="width: 50%">Updating Sub Class</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-close red waves-effect waves-green btn-flat right white-text">Cancel</button>
                </div>
            </div>

            <script>
                function save{{ $class->id }}(){
              $(document).on('click', '#btn-submit{{ $class->id }}', function(e) {
                  e.preventDefault();
                 swal({
                        title: "Are you sure you want to delete?",
                        text: "You are allow to delete class for now but as soon as student registered to this class, you won't be able!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
              }).then(function (willUpdate) {
                if (willUpdate) {
                  swal("Poof! The sub-class from {{ $class->form->name }} has been deleted successfully", {
                    icon: "success",
                  });
                  $('#form{{ $class->id }}').submit();
                } else {
                  swal("the sub-class form {{ $class->form->name }} remain unchanged!");
                }

                  });
              });

              }

              function getValue(e){
                //console.log('the value', e.target.value);
                $.ajax({
           type:"POST",
           url:"{{route('class.getType')}}",
           data:  $('#form').serialize(),
           success:function(res){
               console.log('response is:', res);
               document.getElementById('type').value = res;
           },
           error:function(error){
               console.log('an error occured', error);
           }
              });
              }
              </script>
            @endforeach
        </table>
    </div>
</div>
@else
<div class="row">
    <div class="col s12 m10 offset-m1" style="color: #d19b07 !important; background-color: rgb(248, 221, 171) !important;">
        <h5 class="w3-center w3-medium w3-padding bold">{{ __('messages.create_no_subclass') }}</h5>
    </div>
</div>
@endif
@endsection
