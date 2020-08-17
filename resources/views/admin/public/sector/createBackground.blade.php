@extends('admin.layout')
@section('title') background @endsection
@section('content')
<div class="row">
    <div class="col s12 m10 offset-m1 my-orange" style="color: #ff9800 !important; background-color: rgb(243, 213, 158) !important;">
    <span onclick="this.parentElement.style.display='none'" class="w3-close right red-text w3-hover w3-medium w3-padding-16" style="cursor: pointer">&times;</span>
        <h5 class="w3-center w3-medium w3-padding"><b>{{ __('messages.create_bachground_header') }}</b><br>
            {{ __('messages.create_background_header_two') }}
        </h5>
    </div>
</div>

<div class="row">
    <div class="col s11 m10 w3-border-t offset-m1 w3-padding white w3-margin-bottom radius w3-margin-left" style="margin-top: 5px">
        <form action="{{ route('background.create') }}" method="post">
            @csrf
            <div class="row">
                <div class="input-field col s12 m4">
                  <select name="sectorName" class="validate" id="sectorid">
                    <option value="" selected disabled><small>Select the Sector</small></option>
                    @foreach (App\Sector::all() as $sector)
                        <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                    @endforeach
                  </select>
                    <label for="sectorid">Sector Name</label>
                </div>
                <div class="input-field col s12 m6">
                    <label for="describe"></label>
                    <input name="background" type="text" id="autocomplete-input" class="autocompletes">
                    <i class="fa fa-photo-video teal-text w3-xlarge right" style="margin-top: -40px"></i>
                    <label for="autocomplete-input" class="teal-text">Background Name</label>
                </div>
            </div>
            <button class="w3-center waves-light waves-effect col offset-m4 btn btn-primary" style="width: 30%" type="submit">Save Background</button>
        </form><br><br><br>

        @if(App\Background::count() > 0)
            <div class="col s12 m12" style="overflow-x:scroll !important; margin-top: -5px !important">
                <table id="myTable" class="w3-table w3-striped w3-border-t w3-padding" style="font-size: 13px !important;">
                    <tr class="teal">
                        <th>S/N</th>
                        <th>sector Name</th>
                        <th>Background Name</th>
                        <th colspan="2">Action</th>
                    </tr>
                    @foreach (App\Background::all() as $key => $background)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $background->sector->name }}</td>
                        <td><div class="teal-text">{{ $background->name }}</div></td>

                        <td style="width: 10% !important">
                            <button class="col btn my-orange white-text waves-effect waves-teal modal-trigger" href="#modal{{ $background->id }}">Edit <i class="fa fa-pen w3-tiny"></i></button>
                        </td>
                        <td style="width: 12% !important">
                            <form action="{{ route('background.delete') }}" method="post" id="form{{ $background->id }}">
                                @csrf
                                <input type="hidden" name="backgroundName" value="{{ $background->id }}">
                                <button class="col my-red btn waves-effect waves-teal" onclick="save{{ $background->id }}()" id="btn-submit{{ $background->id }}">Delete <span class="fa fa-trash w3-tiny"></span></button>
                            </form>
                        </td>
                    </tr>
                    <div id="modal{{ $background->id }}" class="modal modal-fixed-footer" style="overflow-x: hidden !important">
                        <div class="modal-content">
                          <hr style="border-top: 1px solid teal">
                                    <h6 class="w3-center bold"><u>Update the Background Name</u></h6>
                            <form action="{{ route('background.update') }}" method="POST">
                                <div class="row">
                                        @csrf
                                    <input type="hidden" name="backgroundName" value="{{ $background->id }}">

                                    <div class="col s12 m6 offset-m3">
                                        <select name="sid" class="browser-default">
                                            <option value="{{ $background->sector->id }}" selected><small>{{ $background->sector->name }}</small></option>
                                            @foreach (App\Sector::all() as $sector)
                                                <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="input-field col s12 m12">
                                        <input name="background" type="text" id="autocomplete-input" class="autocompletes" value="{{ $background->name }}">
                                        <i class="fa fa-photo-video teal-text w3-xlarge right" style="margin-top: -40px"></i>
                                        <label for="autocomplete-input" class="teal-text">Update Background Name</label>
                                    </div>
                                </div>
                                <div class="w3-center" style="margin-top: 4px !important">
                                    <button class="btn my-orange waves-effect waves-light w3-small" type="submit" style="width: 40%">Saved update</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="modal-close red waves-effect waves-green btn-flat right white-text">Cancel</button>
                        </div>
                    </div>

                    <script>
                        function save{{ $background->id }}(){
                      $(document).on('click', '#btn-submit{{ $background->id }}', function(e) {
                          e.preventDefault();
                         swal({
                                title: "Are you sure you want to delete?",
                                text: "be careful because students may have registered of this background already!",
                                icon: "warning",
                                buttons: true,
                                dangerMode: true,
                      }).then(function (willUpdate) {
                        if (willUpdate) {
                          swal("Poof! Your background has been deleted successfully", {
                            icon: "success",
                          });
                          $('#form{{ $background->id }}').submit();
                        } else {
                          swal("the background remain unchanged!");
                        }
                          });
                      });
                      }
                      </script>
                    @endforeach
                </table>
            </div>
        @else
        <div class="col s12 m6 offset-m3 orange w3-center white-text w3-padding">No Background Created yet</div>
        @endif
    </div>
</div>
@endsection
