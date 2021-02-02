<html>
<head>
	<title>Fee Report</title>
	<style>
	body{
		font-family:Arial, Helvetica, sans-serif;
	}
	@page { size: portrait; }
	  @page {
	  size: A4;

	}
	@media print {
	  html, body {
		width: 210mm;
		height: 297mm;
	  }
	  /* ... the rest of the rules ... */
	}
  .head1{
	  width:960px;
	  height:130px;
      border:1px solid#000;

  }
  .left_box{
	    width:400px;
	  height:130px;
      border-right:;
	  font-size:12px;
	  float:left;
	  text-align:center;
  }
  .middle_box{
	    width:130px;
	  height:130px;
      border-right:;
	  font-size:12px;
	  float:left;
  }
  .middle_box img{
	    width:120px;
	  height:120px;
	  padding:5px 5px;

  }
  .right_box{
	    width:400px;
	  height:130px;
	  text-align:center;

	  font-size:12px;
	  float:left;
  }
    .head2{
	  width:960px;
	  padding:10px 10px;
	  font-weight:bold;
	  text-align:center;

  }
  .head3{
	  width:960px;
	  height:50px;
	  text-align:center;
	  font-size:16px;

  }
  .footer1{
	  width:960px;
	  height:80px;
	  border:1px solid#000;

  }
  .footer1_left{
	  width:300px;
	  float:left;
	  height:80px;
	  border:1px solid#000;

  }
  .footer1 h2{
	font-family: italic small-caps bold 12px/30px Georgia, serif;;
	font-size:18px;
	 text-align:center;
	  margin:0px;

  }
  .footer1_right{
	  width:200px;
	  float:left;
	  height:80px;


  }

  table{
	  width:960px;
	  line-height:1.5;
	  border-collapse:collapse;
      padding:5px 5px;
      text-align: center;

  }
  .table,tr,td,th{
      border-collapse:collapse;
      border:1px solid#000;
  }
  .red{
    color: #F44336 !important;
  }
  .blue{
    color: #2196F3 !important;
  }
  .bold{
      font-weight: bold;
  }
  </style>
</head>
<body>
    <div class="head1">
        <div class="left_box">
        Republic of Cameroon<br>
        Peace-Work-FatherLand<br>
        Ministry of Secondary Education<br>
        <strong style="text-transform: uppercase">{{ $setting->school_name }}</strong>
        </div>
        <div class="middle_box">
            <img src="{{ URL::asset('image/logo/new.jpg') }}">
        </div>
        <div class="right_box">
        Republique du Cameroun<br>
        Paix-Travail-Patrie<br>
        Ministère de Enseignements Secondaires<br>

        <strong style="text-transform: uppercase">{{ $setting->school_name }}</strong>
        </div>
    </div>
    <div class="head2" style="text-transform: uppercase">
    ACADEMIC REPORT SHEET /BULLETIN DE NOTES -
    @if($term->id == 1) {{ $term->name }}/PREMIER TRIMESTRE @endif
    @if($term->id == 2) {{ $term->name }}/DEUXIEME TRIMESTRE @endif
    {{ $year }} <BR>
        {{ $student->form->background->sector->name }}
    </div>
    <div class="head3">
        <div style="float:left;width:100px;font-weight:bold;">Name /Nom :</div>
        <div style="float:left;width:350px; font-weight:normal; font-style:italic;">{{ $student->student->full_name }}</div>
        <div style="float:left;width:140px;font-weight:bold;">Class / Classe :</div>
        <div style="float:left;width:360px; font-weight:normal; font-style:italic;">{{ $student->form->name }} {{ $student->form_type }}</div>
        <div style="clear:both; height:10px"></div>
        <div style="float:left;width:150px;font-weight:bold;">Reg No/ Matricule :</div>
        <div style="float:left;width:100px; font-weight:normal; font-style:italic;">{{ $student->student->school_id }}</div>
        <div style="float:left;width:150px;font-weight:bold;">Place of Birth /<br>
        Lieu de naissance
        :</div>
        <div style="float:left;width:220px; font-weight:normal; font-style:italic;
        ">{{ $student->student->place_of_birth }}</div>
        <div style="float:left;width:150px;font-weight:bold;">Date of Birth /<br>
        Date de naissance
        :</div>
        <div style="float:left;width:180px; font-weight:normal; font-style:italic">
        {{ date('d-M-Y', strtotime($studentInfo->date_of_birth)) }}
        </div>
    </div>
    <table>
         <thead>
           <tr>
            <th>MATIERES/SUBECTS</TH><th>Test {{ $t1 }}/20<br>Eval {{ $t1 }}/20</th>
            <th>Test {{ $t2 }}/20<br>Eval {{ $t2 }}/20</th><th>Ave /20<br>Moy /20</th>
            <th>Coef</th><th>Total</th><th>Position</th><th>Teacher</th>
            </tr>
        </thead>
        <tbody>
        {!! $tr !!}
            <!---Average------>
        {!! $ave !!}
        </tbody>
        </table>
<table>
        <tbody>
        <!-----General Conduct/ CONDUITE GENERALE---------->
            <tr>
                <td style="font-weight:bold; text-align:center;
                text-transform:uppercase">SEMESTER RESULTS <BR>
                RESULTAT SEQUENTIEL DE L'ELEVE</td><td style="width:50px"></td>
                <td style="font-weight:bold; text-align:center;
                text-transform:uppercase">CLASS PROFILE /PROFILE DE LA CLASSE</td>
                <td style="width:50px"></td><td style="font-weight:bold; text-align:center;
                text-transform:uppercase">
                DISCIPLINE
            </tr>
            <tr style="font-weight:bold" >
            <td>Term Ave / Moy Trimestriel </td>
            <td style="width:50px" class="{{ $studentResult->stud_ave<10? 'red':'blue' }}">{{ $studentResult->stud_ave }}</td>
            <td>Highest Ave/ Moy Premier  </td>
            <td style="width:50px" class="{{ $classResult->highest_avg < 10 ? 'red':'blue' }}">{{ $classResult->highest_avg }}</td>
            <td>Absences: </td>
            </tr>
            <tr style="font-weight:bold" >
                <td>Term Rank / Rang Trimestriel </td>
                <td style="width:50px" class="{{ $studentResult->stud_ave<10? 'red':'blue' }}">{{ $studentResult->class_position }}</td>
                <td>Lowest Ave / Moy Dernier</td>
                <td style="width:50px" class="{{ $classResult->lowest_avg < 10 ? 'red':'blue' }}">{{ $classResult->lowest_avg }}</td>
                <td>Warning /Averttissements : </td>
            </tr>
            <tr style="font-weight:bold">
                <td></td>
                <td style="width:50px"></td>
                <td>Class Ave/ Moy Classe </td>
                <td style="width:50px" class="{{ $classResult->class_avg < 10 ? 'red':'blue' }}">{{ $classResult->class_avg }}</td>
                <td>Punishment /Consignes  : </td>
            </tr>
            <tr style="font-weight:bold">
                <td> </td>
                <td style="width:50px"></td>
                <td></td>
                <td style="width:50px"></td>
                <td>Suspension /Exc Temporaire </td>
            </tr>
        </tbody>
    </table>
    <div class="footer1" style="height:auto; overflow:hidden; border:none" >
        <div class="footer1_left">
            <table style="width:300px">
                <thead>
                    <tr>
                        <th></th>
                        <th>Ave/ Moy </th>
                        <th>Rank / Rang</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Eval / Test : {{ $t1 }}</td>
                        <td class="{{ $first<10?'red':'blue' }}">{{ $first }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Eval / Test : {{ $t2 }}</td>
                        <td class="{{ $second<10?'red':'blue' }}">{{ $second }}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="footer1_left" style="font-size:16px; width:430px; height:auto; overflow:hidden">
            <h2>Remarks/ Appreciation Travail </h2>
            <div style="width:430px; height:25px;padding:5px 5px;  float:left; border:1px solid#000">
            </div>
        <h2>Class Council Decison / Décision du conseil de classe </h2>
            <div style="width:430px; height:25px; padding:5px 5px; float:left; border:1px solid#000">
            </div>
        </div>

        <div class="footer1_left" style="width:200px; border:none; text-align:center; padding:10px 10px">
                Buea <?php echo date('d/m/Y G:i'); ?> <br><br>
                The Principal/ Le Proviseur
        </div>
    </div>
</body>
</html>
