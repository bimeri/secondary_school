<tr class="orange orange-text lighten-5 center">
    <td colspan="8" style="font-size: 16px !important">
        Result for Class D students
    </td>
</tr>
@foreach ($resultD as $key => $d)
    <tr>
        <td>{{ $key+1 }}</td>
        <td>
            <b class="left">{{ $d->student->full_name }}</b>
            <b class="right">{{ $d->student->school_id }}</b>
        </td>
        <td>{{ $d->average_point }}</td>
        <td>{{ $d->stud_ave }}</td>
        <td>{{ $d->position }}</td>
        <td>{{ $d->class_position }}</td>
        <td>{{ $d->remark }}</td>
        <td>
            <a href="{{ route('student.report_card', [
                              'studentId' => Crypt::encrypt($d->student_id),
                              'formId' => Crypt::encrypt( $d->form_id),
                              'form_type' => Crypt::encrypt($d->form_type),
                              'yearId' => Crypt::encrypt( $d->year_id),
                              'termId' => Crypt::encrypt($d->term_id)]
                              ) }}" class="w3-btn blue blue-text lighten-4">view result <i class="fa fa-eye"></i></a>
        </td>
    </tr>
@endforeach
