<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Session;
use \Hash;
class PageController extends Controller{

  public function index($data){
    return view('import');
  }
 ////fee settings
  public function feesimp(){
    return view('feesimp');
  }
  ////fee payments imports
  public function imppmt(){
    return view('imppmt');
  }

  public function ca(){
    return view('pages.ca');
  }


  public function course(){
    return view('pages.course');
  }

  public function uploadFile(Request $request){
     $file = $request->file('file');
      // File Details 
     
      $extension = $file->getClientOriginalExtension();
      $filename = "Names.".$extension;
      // Valid File Extensions;
      $valid_extension = array("csv","xls");
      if(in_array(strtolower($extension),$valid_extension)){
        // File upload location
          $location = public_path().'/files/';
          // Upload file
         $file->move($location, $filename);
          $filepath = public_path('/files/'.$filename);

          $file = fopen($filepath,"r");

          $importData_arr = array();
           $i = 0;
 
           while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
              $num = count($filedata );
           
              for ($c=0; $c < $num; $c++) {
                 $importData_arr[$i][] = $filedata [$c];
              }
              $i++;
           }
           fclose($file);

       
             
        \DB::beginTransaction();
          try{
            
              foreach($importData_arr as $importData){
                  if(\App\StudentInfo::where('matricule',$importData[5])->count() === 0){
                    $newStudent = new \App\StudentInfo();
                    $newStudent->matricule =  $importData[5];
                    $newStudent->firstname = $importData[2];
                    $year = \App\Year::where('name', $importData[7])->first();
                    $program = \App\Options::where('name', $importData[3])->first();
                    $password = "12345678";
                    $newStudent->year_id = $year->id;
                    $newStudent->password = Hash::make($password);
                    $newStudent->program_id = ($program == null)?'0':$program->id;
                    $newStudent->gender = $importData[6];
                    $newStudent->level_id = ( \App\Level::where('name','like',strtoupper($importData[4]) )->first() == null)?'0': \App\Level::where('name','like',strtoupper($importData[4]) )->first()->id;
                    $newStudent->institutional_email = str_replace(" ", "",strtolower($newStudent->firstname)).'@buib.com';
                    $newStudent->save();
                    if( \App\Level::where('name','like',strtoupper($importData[4]) )->first() == null){
                      echo ($importData[5]."  <b style='color:#ff0000;'> Has no level, please set level on your db later. 0 wil be used as default Level id  <br></b>");
                    }

                    if( ($program == null)){
                      echo ($importData[5]."  <b style='color:#ff0000;'> Belongs to no programe. ) will be used as default program id  <br></b>");
                    }
                    echo ($importData[5]." Inserted Successfully<br>");
                  }else{
                    echo ($importData[5]."  <b style='color:#ff0000;'> Exist already on DB and wont be added. Please verify <br></b>");
                  }
              }

            \DB::commit();
        echo("successful");
        }catch(\Exception $e){
            \DB::rollback();
            echo ($e);
            }
          Session::flash('message','Import Successful.');
          echo("<h3 style='color:#0000ff;'>Import Successful.</h3>");

      }else{
        echo("<h3 style='color:#ff0000;'>Invalid File Extension.</h3>");

         Session::flash('message','Invalid File Extension.');
      }
    }
    
    
       public function uploadFees(Request $request){
      $file = $request->file('file');
       // File Details 
      
       $extension = $file->getClientOriginalExtension();
       $filename = "Names.".$extension;
       // Valid File Extensions;
       $valid_extension = array("csv","xls");
       if(in_array(strtolower($extension),$valid_extension)){
         // File upload location
           $location = public_path().'/files/';
           // Upload file
          $file->move($location, $filename);
           $filepath = public_path('/files/'.$filename);
 
           $file = fopen($filepath,"r");
 
           $importData_arr = array();
            $i = 0;
  
            while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
               $num = count($filedata );
            
               for ($c=0; $c < $num; $c++) {
                  $importData_arr[$i][] = $filedata [$c];
               }
               $i++;
            }
            fclose($file);
 
        
              
         \DB::beginTransaction();
           try{
             
               foreach($importData_arr as $importData){
                  
                     $newStudent = new \App\Fee;                     
                     $newStudent->reg_fee = $importData[1];                     
                     $program = \App\Options::where('name', $importData[0])->first();                    
                     $newStudent->program_id = ($program == null)?'0':$program->id;
                     $Level = \App\Options::where('name', $importData[0])->first();  
                     $newStudent->fee_amt = $importData[2];
                     $newStudent->level_id = ( \App\Level::where('name','like',strtoupper($importData[3]) )->first() == null)?'0': \App\Level::where('name','like',strtoupper($importData[3]) )->first()->id;
                   
                     $newStudent->save();
                   
               }
 
             \DB::commit();
         echo("successful");
         }catch(\Exception $e){
             \DB::rollback();
             echo ($e);
             }
           Session::flash('message','Import Successful.');
           echo("<h3 style='color:#0000ff;'>Import Successful.</h3>");
 
       }else{
         echo("<h3 style='color:#ff0000;'>Invalid File Extension.</h3>");
 
          Session::flash('message','Invalid File Extension.');
       }
     }









     public function uploadpmts(Request $request){
      $file = $request->file('file');
       // File Details 
      
       $extension = $file->getClientOriginalExtension();
       $filename = "Names.".$extension;
       // Valid File Extensions;
       $valid_extension = array("csv","xls");
       if(in_array(strtolower($extension),$valid_extension)){
         // File upload location
           $location = public_path().'/files/';
           // Upload file
          $file->move($location, $filename);
           $filepath = public_path('/files/'.$filename);
 
           $file = fopen($filepath,"r");
 
           $importData_arr = array();
            $i = 0;
  
            while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
               $num = count($filedata );
            
               for ($c=0; $c < $num; $c++) {
                  $importData_arr[$i][] = $filedata [$c];
               }
               $i++;
            }
            fclose($file);
 
        
              
         \DB::beginTransaction();
           try{
             
               foreach($importData_arr as $importData){
                  
                $newStudent = new \App\FeePaymt();
                $newStudent->fee_amt=  $importData[2];
                $newStudent->date = $importData[3];
                $year = \App\Year::where('name', $importData[5])->first();
                $program = \App\Options::where('name', $importData[4])->first();
                $mat = \App\Studentinfo::where('matricule', $importData[1])->first();
                
                $newStudent->yearid =($year==null)?'0':$year->id;
                $newStudent->student_id = ($mat == null)?'0':$mat->id;
                $newStudent->program_id = ($program == null)?'0':$program->id;
                $newStudent->level_id = ( \App\Level::where('name','like',strtoupper($importData[6]) )->first() == null)?'0': \App\Level::where('name','like',strtoupper($importData[6]) )->first()->id;
                $newStudent->save();
               }
 
             \DB::commit();
         echo("successful");
         }catch(\Exception $e){
             \DB::rollback();
             echo ($e);
             }
           Session::flash('message','Import Successful.');
           echo("<h3 style='color:#0000ff;'>Import Successful.</h3>");
 
       }else{
         echo("<h3 style='color:#ff0000;'>Invalid File Extension.</h3>");
 
          Session::flash('message','Invalid File Extension.');
       }
     }






  public function resultUpload(Request $request){
    $file = $request->file('file');
     // File Details 
    
     $extension = $file->getClientOriginalExtension();
     $valid_extension = array("csv","xls");
     if(in_array(strtolower($extension),$valid_extension)){

          $file=$request->file;
          $originalname = $file->getClientOriginalName();
          $filepath = explode('/',$file->storeAs('files', $originalname))[1];
            $file = fopen(storage_path().'/'.'app'.'/files/'.$filepath,"r");
            $importData_arr = array();
             $i = 0;
   
             while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                $num = count($filedata );
                for ($c=0; $c < $num; $c++) {
                   $importData_arr[$i][] = $filedata [$c];
                }
                $i++;
             }
             fclose($file);
       \DB::beginTransaction();
         try{
             foreach($importData_arr as $importData){
                 if(\App\StudentInfo::where('matricule',$importData[2])->count() > 0){
                   $course = \App\Course::where('course_code',$importData[1])->first();
                   if($course == null){
                        echo ($importData[1]."  <b style='color:#ff0000;'>Course Does not exist on DB and wont be added. Please verify <br></b>");
                   }else{
                       if(\App\Result::where('matric',$importData[2])->where('year_id',\App\Year::where('name',$importData[6])->first()->id)->where('semester_id',$importData[5])->where('course_id',$course->id)->count() > 0){
                            echo ($importData[1]."  <b style='color:#ff0000;'>Duplicate Result for ".$importData[2].". Please verify <br></b>");
                       }else{
                            $newResult = new \App\Result();
                            $newResult->course_id = $course->id;
                            $newResult->student_id =  \App\StudentInfo::where('matricule',$importData[2])->first()->id;
                            $newResult->matric = $importData[2];
                            $newResult->semester_id =  $importData[5];
                            $newResult->year_id = \App\Year::where('name',$importData[6])->first()->id;
                            $newResult->ca = $importData[7];
                            $newResult->exam = $importData[8];
                            $newResult->credit = $importData[9];
                            $newResult->grade = "";
                            $newResult->earned = "";
                            $newResult->save();
                            
                            echo ($importData[2]." Inserted Successfully<br>");
                       }
                   }
                 }else{ 
                   echo ($importData[2]."  <b style='color:#ff0000;'>Does not exist on DB and wont be added. Please verify <br></b>");
                 }
             }

           \DB::commit();
       echo("successful");
       }catch(\Exception $e){
           \DB::rollback();
           echo ($e);
           }
         Session::flash('message','Import Successful.');
         echo("<h3 style='color:#0000ff;'>Import Successful.</h3>");

     }else{
       echo("<h3 style='color:#ff0000;'>Invalid File Extension.</h3>");

        Session::flash('message','Invalid File Extension.');
     }
   }
  }