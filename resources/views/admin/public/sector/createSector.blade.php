@extends('admin.layout')
@section('title') create sector @endsection
@section('content')
<div class="row">
    <div class="col s12 m10 offset-m1 blue blue-text lighten-4">
    <span onclick="this.parentElement.style.display='none'" class="w3-close right blue-text w3-hover w3-medium w3-padding-16" style="cursor: pointer">&times;</span>
        <h5 class="w3-center w3-medium"><b>{{ __('messages.create_sector_header') }}</b><br>{{ __('messages.create_sector_header_two') }}</h5>
    </div>
</div>
<div class="row">
    <div class="col s11 m10 w3-border-t offset-m1 w3-padding white w3-margin-bottom radius w3-margin-left" style="margin-top: 5px">
        <form action="{{ route('sector.create') }}" method="post">
            @csrf
            <div class="row">
                <div class="input-field col s12 offset-m1 m4">
                    <input name="name" id="sector" type="text" class="validate" value="{{ old('name') }}">
                    <label for="sector">Sector Name</label>
                </div>
                <div class="input-field col s12 m6">
                    <input id="describe" name="description" type="text" value="{{ old('describe') }}" placeholder="describe the sector type you are about to register" class="validate">
                    <label for="describe">description of sector type</label>
                </div>
            </div>
            <button class="w3-center waves-light waves-effect col offset-m3 offset-s3 btn btn-primary" style="width: 50%" type="submit">Save Sector</button>
        </form><br><hr><br>

        @if(App\Sector::count() > 0)
            <div class="col s12 m12" style="overflow-x:scroll !important; margin-top: -5px !important">
                <table id="myTable" class="w3-table w3-striped w3-border-t w3-padding" style="font-size: 13px !important;">
                    <tr class="teal">
                        <th>S/N</th>
                        <th>sector Name</th>
                        <th>Description</th>
                        <th colspan="2">Action</th>
                    </tr>
                    @foreach (App\Sector::all() as $key => $sector)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $sector->name }}</td>
                        <td><div class="teal-text">{{ $sector->description }}</div></td>

                        <td style="width: 10% !important">
                            <button class="col btn orange lighten-4 orange-text waves-effect waves-teal modal-trigger" href="#modal{{ $sector->id }}">Edit <i class="fa fa-pen w3-tiny"></i></button>
                        </td>
                        <td style="width: 12% !important">
                            <form action="{{ route('sector.delete') }}" method="post" id="form{{ $sector->id }}">
                                @csrf
                                <input type="hidden" name="sectorid" value="{{ $sector->id }}">
                                <button class="col red red-text lighten-4 btn waves-effect waves-teal" onclick="save{{ $sector->id }}()" id="btn-submit{{ $sector->id }}">Delete <span class="fa fa-trash w3-tiny"></span></button>
                            </form>
                        </td>
                    </tr>
                    <div id="modal{{ $sector->id }}" class="modal modal-fixed-footer" style="overflow-x: hidden !important">
                        <div class="modal-content">
                          <h4 class="w3-center teal-text">Update Sector information</h4>
                          <hr style="border-top: 1px solid teal">
                            <form action="{{ route('sector.update') }}" method="POST">
                                <div class="row">
                                        @csrf
                                    <input type="hidden" name="sectorId" value="{{ $sector->id }}">
                                    <div class="input-field col s12 m6 offset-m3">
                                        <input type="text" name="sector" value="{{ $sector->name }}" class="validate" id="sector">
                                        <label for="sector">Sector Name</label>
                                    </div>
                                    <div class="input-field col s12 m12">
                                        <input type="text" name="describe" value="{{ $sector->description }}" class="validate" id="describe">
                                        <label for="describe">Sector Description</label>
                                    </div>
                                </div>
                                <div class="w3-center" style="margin-top: 4px !important">
                                    <button class="btn orange-text orange lighten-4 waves-effect waves-light w3-small" type="submit" style="width: 40%">Saved update</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="modal-close red waves-effect waves-green btn-flat right white-text">Cancel</button>
                        </div>
                    </div>

                    <script>
                        function save{{ $sector->id }}(){
                      $(document).on('click', '#btn-submit{{ $sector->id }}', function(e) {
                          e.preventDefault();
                         swal({
                                title: "Are you sure you want to delete?",
                                text: "be careful because students may have registered to this sector already!",
                                icon: "warning",
                                buttons: true,
                                dangerMode: true,
                      }).then(function (willUpdate) {
                        if (willUpdate) {
                          swal("Poof! Your sector has been deleted successfully", {
                            icon: "success",
                          });
                          $('#form{{ $sector->id }}').submit();
                        } else {
                          swal("the sector remain unchanged!");
                        }

                          });
                      });

                      }
                      </script>
                    @endforeach
                </table>
            </div>
        @else
        <div class="col s12 m6 offset-m3 orange w3-center white-text w3-padding">No Sector Created yet</div>
        @endif
    </div>
</div>
@endsection
