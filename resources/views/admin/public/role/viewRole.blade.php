@extends('admin.layout')

@section('content')
<p class="w3-center">All permission for users with role <b>{{ $roles->name }}</b></p>

<div class="row w3-margin-top">
    <div class="col s11 m10 w3-border-t offset-m1 w3-padding white w3-margin-bottom radius w3-margin-left">
        <div class="row">
            @if ($roles->permissions->where('parent', 'fees_expenses')->count() > 0)
            <div class="col s6 m3">
                    <h5><u>Fees and Expenses</u></h5>
                @foreach ($roles->permissions->where('parent', 'fees_expenses') as $permit)
                <i class="fa fa-arrow-right w3-tiny teal-text"></i> {{ $permit->name }}<br>
                @endforeach
            </div>
            @endif

            @if ($roles->permissions->where('parent', 'classes')->count() > 0)
            <div class="col s6 m3">
                    <h5><u>Manage Classes</u></h5>
                @foreach ($roles->permissions->where('parent', 'classes') as $permit)
                <i class="fa fa-arrow-right w3-tiny teal-text"></i> {{ $permit->name }}<br>
                @endforeach
            </div>
            @endif

            @if ($roles->permissions->where('parent', 'sector_background')->count() > 0)
            <div class="col s6 m3">
                    <h5><u>Sector and Background</u></h5>

                @foreach ($roles->permissions->where('parent', 'sector_background') as $permit)
                <i class="fa fa-arrow-right w3-tiny teal-text"></i> {{ $permit->name }}<br>
                @endforeach
            </div>
            @endif

            @if ($roles->permissions->where('parent', 'roles')->count() > 0)
            <div class="col s6 m3">
                    <h5><u>Manage Roles</u></h5>
                @foreach ($roles->permissions->where('parent', 'roles') as $permit)
                <i class="fa fa-arrow-right w3-tiny teal-text"></i> {{ $permit->name }}<br>
                @endforeach
            </div>
            @endif
        </div>

        <div class="row">
            @if ($roles->permissions->where('parent', 'students')->count() > 0)
                <div class="col s6 m3">
                        <h5><u>Manage Student</u></h5>
                    @foreach ($roles->permissions->where('parent', 'students') as $permit)
                    <i class="fa fa-arrow-right w3-tiny teal-text"></i> {{ $permit->name }}<br>
                    @endforeach
                </div>
            @endif

            @if ($roles->permissions->where('parent', 'teachers')->count() > 0)
                <div class="col s6 m3">
                        <h5><u>Manage Teachers</u></h5>
                    @foreach ($roles->permissions->where('parent', 'teachers') as $permit)
                    <i class="fa fa-arrow-right w3-tiny teal-text"></i> {{ $permit->name }}<br>
                    @endforeach
                </div>
            @endif

            @if ($roles->permissions->where('parent', 'subjects')->count() > 0)
                <div class="col s6 m3">
                        <h5><u>Manage Subjects</u></h5>
                    @foreach ($roles->permissions->where('parent', 'subjects') as $permit)
                    <i class="fa fa-arrow-right w3-tiny teal-text"></i> {{ $permit->name }}<br>
                    @endforeach
                </div>
            @endif

            @if ($roles->permissions->where('parent', 'discipline')->count() > 0)
                <div class="col s6 m3">
                        <h5><u>Manage discipline</u></h5>
                    @foreach ($roles->permissions->where('parent', 'discipline') as $permit)
                    <i class="fa fa-arrow-right w3-tiny teal-text"></i> {{ $permit->name }}<br>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="row">
            @if ($roles->permissions->where('parent', 'result')->count() > 0)
                <div class="col s6 m3">
                        <h5><u>Manage Results</u></h5>
                    @foreach ($roles->permissions->where('parent', 'result') as $permit)
                    <i class="fa fa-arrow-right w3-tiny teal-text"></i> {{ $permit->name }}<br>
                    @endforeach
                </div>
            @endif

            @if ($roles->permissions->where('parent', 'setting')->count() > 0)
                <div class="col s6 m3">
                        <h5><u>Manage Settings</u></h5>
                    @foreach ($roles->permissions->where('parent', 'setting') as $permit)
                   <i class="fa fa-arrow-right w3-tiny teal-text"></i> {{ $permit->name }}<br>
                    @endforeach
                </div>
            @endif

            @if ($roles->permissions->where('parent', 'tranfer_result')->count() > 0)
                <div class="col s6 m3">
                        <h5><u>Transfer Result Online</u></h5>
                    @foreach ($roles->permissions->where('parent', 'tranfer_result') as $permit)
                    <i class="fa fa-arrow-right w3-tiny teal-text"></i> {{ $permit->name }}<br>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
<a href="{{ route('admin.manage.role') }}" class="btn teal waves-light waves-effect backbtn-viewrole"><i class="fa fa-reply"></i> Go Back</a>

@endsection
