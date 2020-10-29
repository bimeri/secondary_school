<form method="get" action="{{ route('student.get') }}" id="forms">
    @csrf
    <div class="row container" style="font-size: 16px !important">
        <div class="col m3 s12">
            <select name="year" class="browser-default">
                <option value="{{ $current_year->id }}">{{ $current_year->name }}</option>
                @foreach (App\Year::all() as $year)
                    <option value="{{ $year->id }}">{{ $year->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col m3 s12">
            <select name="sector" class="browser-default" id="sector" onchange="getBackground(event)">
                <option value="" disabled selected>select the Sector</option>
              @foreach (App\Sector::all() as $sector)
                <option value="{{ $sector->id }}">{{ $sector->name }}</option>
              @endforeach
            </select>
        </div>
        <div class="col s12 m3" id="backgrounds">
            <select class="browser-default" name="background" id="background" required onchange="getclasses(event)">
                <option value="">select the Background</option>
            </select>
        </div>

        <div class="col s12 m3" id="classes">
            <select class="browser-default" name="class" id="form" required>
                <option value="">select the Class</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col m2 m3 right offset-m7" id="submit">
            <button class="btn btn-primary waves-effect waves-light">Get Students</button>
        </div>
    </div>
</form>
