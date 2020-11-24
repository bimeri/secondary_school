<tr class="orange orange-text lighten-4 center">
    <td colspan="8" style="font-size: 16px !important">
        Result for Class I students
    </td>
</tr>
@foreach ($resultI as $key => $i)
    <tr>
        <td>{{ $key+1 }}</td>
        <td>
            <b class="left">{{ $i->student->full_name }}</b>
            <b class="right">{{ $i->student->school_id }}</b>
        </td>
        <td>{{ $i->average_point }}</td>
        <td>{{ $i->stud_ave }}</td>
        <td>{{ $i->position }}</td>
        <td>{{ $i->class_position }}</td>
        <td>{{ $i->remark }}</td>
        <td>
            <a href="{{ route('student.report_card', [
                              'studentId' => Crypt::encrypt($i->student_id),
                              'formId' => Crypt::encrypt( $i->form_id),
                              'form_type' => Crypt::encrypt($i->form_type),
                              'yearId' => Crypt::encrypt( $i->year_id),
                              'termId' => Crypt::encrypt($i->term_id)]
                              ) }}" class="w3-btn blue blue-text lighten-4">view result <i class="fa fa-eye"></i></a>
        </td>
    </tr>
@endforeach
