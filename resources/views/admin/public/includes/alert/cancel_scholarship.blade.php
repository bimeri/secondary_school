<script>
    function dismiss{{ $key + 1 }}(){
  $(document).on('click', '#btn-submit{{ $key + 1 }}', function(e) {
      e.preventDefault();
     swal({
            title: "Are you sure you want to cancel scholarship given to {{ $user->student->full_name }} ?",
            text: "cancelation of scholarship award to student",
            icon: "warning",
            buttons: true,
            dangerMode: true,
  }).then(function (willUpdate) {
    if (willUpdate) {
      swal("{{ $user->student->full_name }} Scholarship has been cancel successfully", {
        icon: "success",
      });
      $('#form{{ $key + 1 }}').submit();
    } else {
      swal("The Student scholarship remain unchanged!");
    }

      });
  });

  }
  </script>
