<tr class="orange orange-text lighten-4 center">
    <td colspan="8" style="font-size: 16px !important">
        Result for Class H students
    </td>
</tr>
@foreach ($resultH as $key => $h)
    <tr>
        <td>{{ $key+1 }}</td>
        <td>
            <b class="left">{{ $h->student->full_name }}</b>
            <b class="right">{{ $h->student->school_id }}</b>
        </td>
        <td>{{ $h->average_point }}</td>
        <td>{{ $h->stud_ave }}</td>
        <td>{{ $h->position }}</td>
        <td>{{ $h->class_position }}</td>
        <td>{{ $h->remark }}</td>
        <td>
            <a href="{{ route('student.report_card', [
                              'studentId' => Crypt::encrypt($h->student_id),
                              'formId' => Crypt::encrypt( $h->form_id),
                              'form_type' => Crypt::encrypt($h->form_type),
                              'yearId' => Crypt::encrypt( $h->year_id),
                              'termId' => Crypt::encrypt($h->term_id)]
                              ) }}" class="w3-btn blue blue-text lighten-4">view result <i class="fa fa-eye"></i></a>
        </td>
    </tr>
@endforeach
