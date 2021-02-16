<tr class="orange orange-text lighten-5 center">
    <td colspan="8" style="font-size: 16px !important">
        Result for Class B students
    </td>
</tr>
@foreach ($resultB as $key => $b)
    <tr>
        <td>{{ $key+1 }}</td>
        <td>
            <b class="left">{{ $b->student->full_name }}</b>
            <b class="right">{{ $b->student->school_id }}</b>
        </td>
        <td>{{ $b->average_point }}</td>
        <td>{{ $b->stud_ave }}</td>
        <td>{{ $b->position }}</td>
        <td>{{ $b->class_position }}</td>
        <td>{{ $b->remark }}</td>
        <td>
            <a href="{{ route('student.report_card', [
                              'studentId' => Crypt::encrypt($b->student_id),
                              'formId' => Crypt::encrypt( $b->form_id),
                              'form_type' => Crypt::encrypt($b->form_type),
                              'yearId' => Crypt::encrypt( $b->year_id),
                              'termId' => Crypt::encrypt($b->term_id)]
                              ) }}" class="w3-btn blue blue-text lighten-4">view result <i class="fa fa-eye"></i></a>
        </td>
    </tr>
@endforeach
