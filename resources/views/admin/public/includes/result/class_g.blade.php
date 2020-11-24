<tr class="orange orange-text lighten-4 center">
    <td colspan="8" style="font-size: 16px !important">
        Result for Class G students
    </td>
</tr>
@foreach ($resultF as $key => $g)
    <tr>
        <td>{{ $key+1 }}</td>
        <td>
            <b class="left">{{ $g->student->full_name }}</b>
            <b class="right">{{ $g->student->school_id }}</b>
        </td>
        <td>{{ $g->average_point }}</td>
        <td>{{ $g->stud_ave }}</td>
        <td>{{ $g->position }}</td>
        <td>{{ $g->class_position }}</td>
        <td>{{ $g->remark }}</td>
        <td>
            <a href="{{ route('student.report_card', [
                              'studentId' => Crypt::encrypt($g->student_id),
                              'formId' => Crypt::encrypt( $g->form_id),
                              'form_type' => Crypt::encrypt($g->form_type),
                              'yearId' => Crypt::encrypt( $g->year_id),
                              'termId' => Crypt::encrypt($g->term_id)]
                              ) }}" class="w3-btn blue blue-text lighten-4">view result <i class="fa fa-eye"></i></a>
        </td>
    </tr>
@endforeach
