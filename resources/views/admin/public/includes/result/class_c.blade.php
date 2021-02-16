<tr class="orange orange-text lighten-5 center">
    <td colspan="8" style="font-size: 16px !important">
        Result for Class C students
    </td>
</tr>
@foreach ($resultC as $key => $c)
    <tr>
        <td>{{ $key+1 }}</td>
        <td>
            <b class="left">{{ $c->student->full_name }}</b>
            <b class="right">{{ $c->student->school_id }}</b>
        </td>
        <td>{{ $c->average_point }}</td>
        <td>{{ $c->stud_ave }}</td>
        <td>{{ $c->position }}</td>
        <td>{{ $c->class_position }}</td>
        <td>{{ $c->remark }}</td>
        <td>
            <a href="{{ route('student.report_card', [
                              'studentId' => Crypt::encrypt($c->student_id),
                              'formId' => Crypt::encrypt( $c->form_id),
                              'form_type' => Crypt::encrypt($c->form_type),
                              'yearId' => Crypt::encrypt( $c->year_id),
                              'termId' => Crypt::encrypt($c->term_id)]
                              ) }}" class="w3-btn blue blue-text lighten-4">view result <i class="fa fa-eye"></i></a>
        </td>
    </tr>
@endforeach
