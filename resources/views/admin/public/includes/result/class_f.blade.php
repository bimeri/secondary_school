<tr class="orange orange-text lighten-4 center">
    <td colspan="8" style="font-size: 16px !important">
        Result for Class F students
    </td>
</tr>
@foreach ($resultF as $key => $f)
    <tr>
        <td>{{ $key+1 }}</td>
        <td>
            <b class="left">{{ $f->student->full_name }}</b>
            <b class="right">{{ $f->student->school_id }}</b>
        </td>
        <td>{{ $f->average_point }}</td>
        <td>{{ $f->stud_ave }}</td>
        <td>{{ $f->position }}</td>
        <td>{{ $f->class_position }}</td>
        <td>{{ $f->remark }}</td>
        <td>
            <a href="{{ route('student.report_card', [
                              'studentId' => Crypt::encrypt($f->student_id),
                              'formId' => Crypt::encrypt( $f->form_id),
                              'form_type' => Crypt::encrypt($f->form_type),
                              'yearId' => Crypt::encrypt( $f->year_id),
                              'termId' => Crypt::encrypt($f->term_id)]
                              ) }}" class="w3-btn blue blue-text lighten-4">view result <i class="fa fa-eye"></i></a>
        </td>
    </tr>
@endforeach
