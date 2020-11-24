<html>
<head>
	<title></title>
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
	  height:130px;	  font-size:12px;
	  float:left;
	  text-align:center;
  }
  .middle_box{
	    width:130px;
	  height:130px;
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

  }
  .table,tr,td,th{
      border-collapse:collapse;
      border:1px solid#000;
	  padding:0px 5px;
  }
  </style>
</head>
		<div class="head1">
			<div class="left_box">
			Republic of Cameroon<br>
			Peace-Work-FatherLand<br>
			Ministry of Secondary Education<br>
			<strong>SABIBI COMPREHENSIVE COLLEGE</strong>
			</div>
			<div class="middle_box">
			<img src="{{ URL::asset('image/logo/new.jpg') }}">
			</div>
			<div class="right_box">
			Republique du Cameroun<br>
			Paix-Travail-Patrie<br>
			Ministère de Enseignements Secondaires<br>

			<strong>SABIBI COMPREHENSIVE COLLEGE</strong>
			</div>
		</div>
		<div class="head2">
		ACADEMIC REPORT SHEET /BULLETIN DE NOTES - ANNUAL / ANNUEL 2019/2020 <BR>
			GRAMMAR
		</div>
		<div class="head3">
			<div style="float:left;width:100px;font-weight:bold;">Name /Nom :</div>
			<div style="float:left;width:350px; font-weight:normal; font-style:italic;
			">Henery Marie Jean Dieu Kamga Yvee</div>

			<div style="float:left;width:140px;font-weight:bold;">Class / Classe :</div>
			<div style="float:left;width:360px; font-weight:normal; font-style:italic;
			">Form 5 B</div>

			<div style="clear:both; height:10px"></div>
			<div style="float:left;width:150px;font-weight:bold;">Reg No/ Matricule :</div>
			<div style="float:left;width:100px; font-weight:normal; font-style:italic;
			">BG20A005</div>

			<div style="float:left;width:150px;font-weight:bold;">Place of Birth /<br>
			Lieu de naissance

			:</div>
			<div style="float:left;width:220px; font-weight:normal; font-style:italic;
			">Buea Regional Hospital</div>


			<div style="float:left;width:150px;font-weight:bold;">Date of Birth /<br>
			Date de naissance

			:</div>
			<div style="float:left;width:180px; font-weight:normal; font-style:italic;
			"> 01 / 01/2000</div>

		</div>
		<table>
			 <thead>
               <tr>
				<th>MATIERES/SUBECTS</TH><th>Eval1 /20</th>
				<th>Eval2 /20</th><th>Eval3 /20</th><th>Eval4 /20</th>
				<th>Eval5 /20</th><th>Eval6 /20</th><th>Ave /20<br>Moy /20</th>
				<th>Coef</th><th>Total</th><th>Position</th><th>Teacher</th>
				</tr>

			</thead>
			<tbody>
			<?php
			$con = mysqli_connect('localhost','root','','school');

			// Check connection
			if (mysqli_connect_errno())
			  {
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			  }
			$select=$con->query("SELECT * FROM subjects where form_id='31' ") or die(msyqli_error($con));
			while($row=$select->fetch_assoc()){
			?>


				<!---Display All Subects and Scores------>
				<tr>
				<td><?php echo $row['name']; ?></td>
				<td>18</td>
				<td>20</td>
				<td>19</td>
				<td>18</td>
				<td>20</td>
				<td>19</td>
				<td>19</td>
				<td><?php echo $row['coefficient']; ?></td>
				<td><?php echo $row['coefficient']; ?></td>
				<td></td>
				<td>Leonard</td>
				</tr>

			<?php } ?>



				<!---Average------>
				<tr>
				<td>Average </td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				</tr>




			</tbody>
			</table>
			<table  >
			<tbody>
			<!-----General Conduct/ CONDUITE GENERALE---------->

				<tr>
					<td style="font-weight:bold; text-align:center;
					text-transform:uppercase">ANNUAL RESULTS <BR>
					RESULTAT ANNUEL DE L'ELEVE</td><td style="width:50px"></td>
					<td style="font-weight:bold; text-align:center;
					text-transform:uppercase">CLASS PROFILE /PROFILE DE LA CLASSE</td>
					<td style="width:50px"></td><td style="font-weight:bold; text-align:center;
					text-transform:uppercase">
					DISCIPLINE
				</tr>
				<tr style="font-weight:bold" >
				<td>Annual Ave / Moy Annuelle </td><td style="width:50px"></td><td>Highest Ave/ Moy Premier  </td>
				<td style="width:50px"></td> <td>Absences: </td>
				</tr>


				<tr style="font-weight:bold" >
				<td>Annual Rank / Rang Annuel </td><td style="width:50px"></td><td>Lowest Ave / Moy Dernier </td>
				<td style="width:50px"></td> <td>Warning /Averttissements : </td>

				</tr>



				<tr style="font-weight:bold">
				<td>  </td><td style="width:50px"></td><td>Class Ave/ Moy Classe </td>
				<td style="width:50px"></td> <td>Punishment /Consignes  : </td>
				</tr>

				<tr style="font-weight:bold" >
				<td> </td><td style="width:50px"></td><td></td>
				<td style="width:50px"></td> <td>Suspension /Exc Temporaire </td>

				</tr>


			</tbody>
		</table>
		<div class="footer1" style="height:auto; overflow:hidden; border:none" >
			<div class="footer1_left">
				<table style="width:300px">
					<thead>
						<tr>
							<th></th><th>Ave/ Moy </th><th>Rank / Rang</th>
						</tr>

					</thead>
					<tbody>
					<tr>
							<td>Eval / Test : 3</td><td></td><td></td>
				 </tr>
				 <tr>
							<td>Eval / Test : 4</td><td></td><td></td>
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

			</div></div>

		<div style="clear:both; height:20px; margin-top:10px; width:960px;">NB: AN AV/MOY AN= SEQ1+SEQ2+SEQ3+SEQ4+SEQ5+SEQ6/Nbre SEQ</div>

<body>

























</body>
</html>
