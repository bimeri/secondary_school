<tr class="orange orange-text lighten-4 center">
    <td colspan="8" style="font-size: 16px !important">
        Result for Class E students
    </td>
</tr>
@foreach ($resultD as $key => $e)
    <tr>
        <td>{{ $key+1 }}</td>
        <td>
            <b class="left">{{ $e->student->full_name }}</b>
            <b class="right">{{ $e->student->school_id }}</b>
        </td>
        <td>{{ $e->average_point }}</td>
        <td>{{ $e->stud_ave }}</td>
        <td>{{ $e->position }}</td>
        <td>{{ $e->class_position }}</td>
        <td>{{ $e->remark }}</td>
        <td>
            <a href="{{ route('student.report_card', [
                              'studentId' => Crypt::encrypt($e->student_id),
                              'formId' => Crypt::encrypt( $e->form_id),
                              'form_type' => Crypt::encrypt($e->form_type),
                              'yearId' => Crypt::encrypt( $e->year_id),
                              'termId' => Crypt::encrypt($e->term_id)]
                              ) }}" class="w3-btn blue blue-text lighten-4">view result <i class="fa fa-eye"></i></a>
        </td>
    </tr>
@endforeach
