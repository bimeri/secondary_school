<div class="row">
    <div class="col s10 offset-s1 m6 offset-m3">
        @if(count($errors) > 0)
        <center>
            <div class="w3-container red-text w3-card-8 w3-margin-top materialize-red lighten-4" style="display: block; position: relative; z-index: 30">
                <span onclick="this.parentElement.style.display='none'" class="close right w3-padding-16 w3-margin-top" style="cursor: pointer">x</span>
                <ul id="error" class="w3-margin w3-padding">
                    @foreach($errors->all() as $error)
                        <li style="text-align: center;">{{ $error }} </li>
                    @endforeach  <center><i class="mdi-action-thumb-down" style="font-size: 25px;"></i></center>
                </ul>
            </div>
        </center>
        @endif
    </div>
</div>
