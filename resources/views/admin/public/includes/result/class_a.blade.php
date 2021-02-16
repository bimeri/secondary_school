<tr class="orange orange-text lighten-5 center">
    <td colspan="8" style="font-size: 16px !important">
        Result for Class A students
    </td>
</tr>
@foreach ($resultA as $key => $a)
    <tr>
        <td>{{ $key+1 }}</td>
        <td><b class="left">{{ $a->student->full_name }}</b><b class="right">{{ $a->student->school_id }}</b></td>
        <td>{{ $a->average_point }}</td>
        <td>{{ $a->stud_ave }}</td>
        <td>{{ $a->position }}</td>
        <td>{{ $a->class_position }}</td>
        <td>{{ $a->remark }}</td>
        <td>
            <a href="{{ route('student.report_card', [
                              'studentId' => Crypt::encrypt($a->student_id),
                              'formId' => Crypt::encrypt( $a->form_id),
                              'form_type' => Crypt::encrypt($a->form_type),
                              'yearId' => Crypt::encrypt( $a->year_id),
                              'termId' => Crypt::encrypt($a->term_id)])
                    }}" class="w3-btn blue blue-text lighten-4">view result <i class="fa fa-eye"></i></a>
        </td>
    </tr>
@endforeach
