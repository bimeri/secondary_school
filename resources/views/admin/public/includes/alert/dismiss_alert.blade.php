<script>
    function dismiss{{ $key + 1 }}(){
  $(document).on('click', '#btn-submits{{ $key + 1 }}', function(e) {
      e.preventDefault();
     swal({
            title: "Are you sure you want to dismiss the Student: {{ $value->student->full_name }}?",
            text: "If dismissed, this student won't be able to view his profile again",
            icon: "warning",
            buttons: true,
            dangerMode: true,
  }).then(function (willUpdate) {
    if (willUpdate) {
      swal("Poof! The Student {{ $value->student->full_name }} has been suspend successfully", {
        icon: "success",
      });
      $('#forms{{ $key + 1 }}').submit();
    } else {
      swal("The Student {{ $value->student->full_name }} remain unchanged!");
    }

      });
  });

  }
  </script>
