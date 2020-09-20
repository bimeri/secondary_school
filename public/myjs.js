    function load(){
document.getElementById('menu').style.display = 'block';
}
document.getElementById('menu').style.display = 'none';

$('#blah').hide();
$(document).ready(function(){
    $('.sidenav').sidenav();
    $('.collapsible').collapsible();
    $('.tabs').tabs();
    $('input#input_text, textarea#textarea1').characterCounter();
  });
  $('.dropdown-trigger').dropdown();
  M.textareaAutoResize($('#reason'));
  $(document).ready(function(){
    $('input.autocomplete').autocomplete({
      data: {
        "Teacher": null,
        "Student": null,
        "Manager": null,
        "Accountant": null,
        "Saccatary": null,
        "Cleaner": null,
        "Principal": null,
        "Chair person": null,
        "Head-Teacher": null,
        "Discipline Master": null,
        "Director": null,
        "Cordinator": null,
        "Administrator": null,
        "Staff-manager": null,
        "General Manager": null,
        "Supervisor": null,
        "Councelor": null,
        "Chancelor": null,
        "Assistant Discipline Master": null,
        "pro Chancelor": null,
        "Google": 'https://placehold.it/250x250'
      },
    });

    $('input.autocompletes').autocomplete({
        data: {
          "Science": null,
          "Arts": null,
          "commercial": null,
          "Technical": null,
          "Uppersixth Art": null,
          "Uppersixth Science": null,
          "Lowersixth Art": null,
          "Lowersixth Science": null,
          "Examination class": null,
          "Grammar": null,
          "Comprehensive": null,
          "GCE O-Level Art": null,
          "GCE A-Level Art": null,
          "GCE O-Level Science": null,
          "GCE A-Level Scince": null,
        },
      });

      $('input.autocompletess').autocomplete({
        data: {
          "Form One": null,
          "Form Two": null,
          "Form Three": null,
          "Form Four": null,
          "Form five": null,
          "Lower-sixth Art": null,
          "Lower-sixth Science": null,
          "Upper-sixth Art": null,
          "Upper-sixth Science": null,
          "sixieme": null,
          "cinqieme": null,
          "quartrieme": null,
          "troisieme": null,
          "second": null,
          "premiere": null,
          "terminal": null
        },
      });

      $('input.autocompletetyle').autocomplete({
        data: {
          "Preventative Discipline": null,
          "Supportive Discipline": null,
          "Corrective Discipline": null,
        },
      });
      $('input.autocompleteChannel').autocomplete({
        data: {
          "Cash Payment": null,
          "MTN Mobile Money": null,
          "Orange Money": null,
          "Bank Transaction": null,
        },
      });
      $('input.autocompleteType').autocomplete({
        data: {
          "PTA": null,
          "Tuition": null,
          "Medical": null,
          "Practical": null,
          "Computer": null,
          "Sanitary": null,
          "Caution": null,
          "Examination": null,
          "GCE": null,
          "Sport": null,
        },
      });
      $('input.autocompleteExpense').autocomplete({
        data: {
          "Library": null,
          "IDP": null,
          "Handicap": null,
          "Sport Activities": null,
          "Medication": null,
          "Part-time Teacher": null,
          "Scholarship": null,
          "School Material": null,
        },
      });

      $('input.autocompleteSubject').autocomplete({
        data: {
          "Biology": null,
          "Chemistry": null,
          "Physics": null,
          "Mathematics": null,
          "Additional Mathematics": null,
          "Business Mathematics": null,
          "Logic": null,
          "Geography": null,
          "Human Biology": null,
          "History": null,
          "French": null,
          "English": null,
          "English Literature": null,
          "Citizenship": null,
          "Economics": null,
          "Accounting": null,
          "Further Mathematics": null,
          "Pure Mathematics Mechanics": null,
          "Pure Mathematics Statistics": null,
          "Philosophy": null,
          "Geology": null,
          "Computer Science": null,
          "Food Science": null,
          "Food and Nutrition": null,
          "Commerce": null,
          "Sport": null,
          "Manual Labour": null,
        },
      });
  });
  $('.modal').modal();
  $('select').formSelect();
  $('.datepicker').datepicker();
  $('.timepicker').timepicker();
setInterval(displayclock, 100);
                            function displayclock() {

                              var months =['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                              var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                               var time = new Date();
                               var day = days[time.getDay().toString()];
                               var month = months[time.getMonth().toString()];
                               var dates = time.getDate().toString();
                               var year = time.getFullYear().toString();
                               var hrs = time.getHours();
                               var min = time.getMinutes();
                               var sec = time.getSeconds();
                               var en = 'AM';

                               if (hrs > 12) {
                                en = 'PM';
                               }

                               if (hrs > 12) {
                                hrs = hrs -12;
                               }
                               if (hrs == 0) {
                                hrs = 12;
                               }

                               if (hrs < 10) {
                                hrs = '0' + hrs;
                               }
                               if (min < 10) {
                                min = '0' + min;
                               }
                               if (sec < 10) {
                                sec = '0' + sec;
                               }

                                var mat = document.getElementById("dateField");
  if (typeof mat !== 'undefined' && mat !== null) {
                               document.getElementById("dateField").innerHTML = day + ' ' + dates + ' ' + month + ' ' + year + ' <br> ' + hrs + ':' + min + ':' +sec + ' ' + en;
                             }
                            }

    $("#myDropdown").hide();
  $(document).ready(function(){

  $("#dropbtn").click(function(){
        $("#myDropdown").fadeIn(1000);

        });

           window.onclick=function(e){
         if (!e.target.matches('.mydwn')) {
            if (!e.target.matches('.logo-icon')) {


   $("#myDropdown").fadeOut();

}
}
}
    });

    function readURL(input) {
        $('#blah').show();
        if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function(e) {
            $('#blah').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
      }

      $("#imgInp").change(function() {
        readURL(this);
      });

      $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.scrollToTop').fadeIn();
        } else {
            $('.scrollToTop').fadeOut();
        }
    });
    //Click event to scroll to top
    $('.scrollToTop').click(function () {
        $('html, body').animate({scrollTop: 0}, 800);
        return false;
    });
    function change(){
        var v = document.getElementById("teacher");
            if(v.classList.contains('fa-chevron-up')) {
                v.className = "teal-text right fa fa-chevron-down w3-small";
            }
           else if(v.classList.contains('fa-chevron-down')) {
                v.className = "teal-text right fa fa-chevron-up w3-small";
            }
    }
    function students(){
        var v = document.getElementById("student");
            if(v.classList.contains('fa-chevron-up')) {
                v.className = "teal-text right fa fa-chevron-down w3-small";
            }
           else if(v.classList.contains('fa-chevron-down')) {
                v.className = "teal-text right fa fa-chevron-up w3-small";
            }
    }
    function expenses(){
        var v = document.getElementById("expense");
            if(v.classList.contains('fa-chevron-up')) {
                v.className = "teal-text right fa fa-chevron-down w3-small";
            }
           else if(v.classList.contains('fa-chevron-down')) {
                v.className = "teal-text right fa fa-chevron-up w3-small";
            }
    }
    function settings(){
        var v = document.getElementById("setting");
            if(v.classList.contains('fa-chevron-up')) {
                v.className = "teal-text right fa fa-chevron-down w3-small";
            }
           else if(v.classList.contains('fa-chevron-down')) {
                v.className = "teal-text right fa fa-chevron-up w3-small";
            }
    }
    function classes(){
        var v = document.getElementById("class");
            if(v.classList.contains('fa-chevron-up')) {
                v.className = "teal-text right fa fa-chevron-down w3-small";
            }
           else if(v.classList.contains('fa-chevron-down')) {
                v.className = "teal-text right fa fa-chevron-up w3-small";
            }
    }
    function sectors(){
        var v = document.getElementById("sector");
            if(v.classList.contains('fa-chevron-up')) {
                v.className = "teal-text right fa fa-chevron-down w3-small";
            }
           else if(v.classList.contains('fa-chevron-down')) {
                v.className = "teal-text right fa fa-chevron-up w3-small";
            }
    }
    function fees(){
        var v = document.getElementById("fee");
            if(v.classList.contains('fa-chevron-up')) {
                v.className = "teal-text right fa fa-chevron-down w3-small";
            }
           else if(v.classList.contains('fa-chevron-down')) {
                v.className = "teal-text right fa fa-chevron-up w3-small";
            }
    }
    function results(){
        var v = document.getElementById("result");
            if(v.classList.contains('fa-chevron-up')) {
                v.className = "teal-text right fa fa-chevron-down w3-small";
            }
           else if(v.classList.contains('fa-chevron-down')) {
                v.className = "teal-text right fa fa-chevron-up w3-small";
            }
    }
    function roles(){
        var v = document.getElementById("role");
            if(v.classList.contains('fa-chevron-up')) {
                v.className = "teal-text right fa fa-chevron-down w3-small";
            }
           else if(v.classList.contains('fa-chevron-down')) {
                v.className = "teal-text right fa fa-chevron-up w3-small";
            }
    }
    function subjects(){
        var v = document.getElementById("subject");
            if(v.classList.contains('fa-chevron-up')) {
                v.className = "teal-text right fa fa-chevron-down w3-small";
            }
           else if(v.classList.contains('fa-chevron-down')) {
                v.className = "teal-text right fa fa-chevron-up w3-small";
            }
    }
