<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => ['web']], function()
{
    route::get('admin_layout', 'pageController@adminLaygout')->name('admin.layout');
    route::get('student_layout', 'pageController@studentLaygout')->name('student.layout');
    route::get('teacher_layout', 'pageController@teacherLaygout')->name('teacher.layout');
    route::get('boser_layout', 'pageController@boserLaygout')->name('boser.layout');
});

Auth::routes();
Route::post('user_login', 'authController@login')->name('user.login');

Route::post('language/french', function(){

        DB::table('languages')->where('id', '!=', '2')->update(['active' => 0 ]);
        DB::table('languages')->where('id', 2)->update(['active' => 1]);
        App::setLocale('fr');
        session()->put('key', 'fr');
    $notification = array(
        'message' => 'Your language has been changed to French successfully!',
        'alert-type' => 'success');
        Artisan::call('config:cache');
    return redirect()->back()->with($notification);
})->name('language.french');

Route::post('language/english', function(){

        DB::table('languages')->where('id', '!=', '1')->update(['active' => 0 ]);
        DB::table('languages')->where('id', 1)->update(['active' => 1]);
        App::setLocale('en');
        session()->put('key', 'en');
    $notification = array(
        'message' => 'Your language has been changed to English successfully!',
        'alert-type' => 'success');
        Artisan::call('config:cache');
    return redirect()->back()->with($notification);
})->name('language.english');


//admin pages
Route::get('admin_home', 'AdminController@index')->name('admin.home');
Route::get('admin/role', 'AdminController@add_role')->name('admin.manage.role');
Route::get('admin/add_user', 'AdminController@UserView')->name('manage.user');
Route::post('admin/add_role', 'AdminController@addRole')->name('role.add');
Route::post('add_user', 'AdminController@addUser')->name('user.save');
Route::get('view_roles/{id}', 'AdminController@seeRole')->name('user.role.view');
Route::get('edit_user/{id}', 'AdminController@editUser')->name('user.admin.edit');
Route::post('edit_user', 'AdminController@editUserFunction')->name('user.information.update');
Route::get('admin/edit_role/{id}', 'AdminController@editRole')->name('user.role.edit');
Route::post('admin/edit_role', 'AdminController@editRoleFunction')->name('role.edit');
Route::get('admin/all_user', 'AdminController@seeUser')->name('view.admin.user');
//school profile and theming
Route::get('admin/school_theme', 'SettingController@index')->name('view.admin.theme');
Route::get('admin/school_profile', 'SettingController@profile')->name('view.admin.profile');
Route::get('admin/more_setting', 'SettingController@moreSetting')->name('admin.more_setting');
Route::get('admin/all_setting', 'SettingController@allSetting')->name('admin.all_settintg');
Route::post('admin/create_sequence', 'SettingController@createSequence')->name('sequence.create');
Route::post('admin/onTest', 'SettingController@OnTest')->name('on.test.session');
Route::post('admin/offTest', 'SettingController@OffTest')->name('off.test.session');
Route::post('admin/onExam', 'SettingController@OnExam')->name('on.exam.session');
Route::post('admin/offExam', 'SettingController@OffExam')->name('off.exam.session');
Route::post('admin/setting/time', 'SettingController@schoolTime')->name('setting.school.time');
Route::post('admin/setting/information', 'SettingController@schoolCurrentInformation')->name('setting.current.information');
Route::post('admin/setting/profile', 'SettingController@schoolProfile')->name('setting.school.profile');
Route::post('admin/setting/year', 'SettingController@addYear')->name('setting.year.create');
Route::post('admin/setting/ajax/table', 'SettingController@resultTable')->name('get.result.table');
Route::post('admin/setting/ajax/publish_first', 'SettingController@PublishFirstResult')->name('publish.first.result');
Route::post('admin/setting/ajax/publish_second', 'SettingController@PublishSecondResult')->name('publish.second.result');
Route::post('admin/setting/teacher/', 'SettingController@recordTeacherMarks')->name('teacher.record.marks');
// Sectors and Background
Route::get('admin/sector', 'SectorController@create')->name('admin.add.sector');
Route::get('admin/background', 'SectorController@createBackround')->name('admin.create.background');
Route::post('admin/sector/create', 'SectorController@createSector')->name('sector.create');
Route::post('admin/background/create', 'SectorController@createBackground')->name('background.create');
Route::post('admin/sector/update', 'SectorController@updateSector')->name('sector.update');
Route::post('admin/background/update', 'SectorController@updateBackground')->name('background.update');
Route::post('admin/sector/delete', 'SectorController@deleteSector')->name('sector.delete');
Route::post('admin/background/delete', 'SectorController@deleteBackground')->name('background.delete');
Route::get('admin/view/sector', 'SectorController@viewSector')->name('sector.view');
Route::get('admin/view/background', 'SectorController@viewBackground')->name('background.view');
// manage classes
Route::get('admin/create/class', 'ClassController@create')->name('admin.create.class');
Route::post('admin/edit/class', 'ClassController@edit')->name('admin.edit.class');
Route::post('admin/delete/class', 'ClassController@delete')->name('admin.delete.class');
Route::post('admin/delete/subclass', 'ClassController@deletesubClass')->name('admin.delete.subclass');
Route::get('admin/create/subclass', 'ClassController@subClass')->name('admin.create.subclass');
Route::get('admin/view/class', 'ClassController@index')->name('admin.view.class');
Route::get('admin/getclass', 'ClassController@getclassSubjects')->name('class.form.create');
Route::post('admin/create', 'ClassController@submitClass')->name('class.form.submit');
Route::post('admin/create/subclass', 'ClassController@subClassSubmit')->name('subclass.form.submit');
Route::post('admin/edit/subclass', 'ClassController@EditsubClassSubmit')->name('admin.edit.subclass');
Route::post('class/type', 'ClassController@getType')->name('class.getType');
Route::get('student/class_list', 'ClassController@showClassLiss')->name('school.class_list');
Route::get('student/class/change', 'ClassController@changeClass')->name('change.student.class');
Route::post('student/class/change', 'ClassController@changeClassFunction')->name('change.student_class');
Route::post('student/ajax/getdetail', 'ClassController@getStudentclassDetails')->name('student.getDetail');
Route::post('student/parent/getdetail', 'ClassController@studentParent')->name('student.parent');
//manage student
Route::get('admin/student/create', 'AdminstudentController@create')->name('amin.create.student');
Route::get('admin/student/list', 'AdminstudentController@viewStudent')->name('amdin.view.student');
Route::post('admin/student/create', 'AdminstudentController@submitInfo')->name('admin.submit.student.info');
Route::post('admin/student/update', 'AdminstudentController@updateStudentInfo')->name('student_info.update');
Route::get('admin/student', 'AdminstudentController@getStudent')->name('student.get');
Route::post('admin/class_size', 'AdminstudentController@getSize')->name('class.getsize');
Route::get('admin/student/subclasses', 'AdminstudentController@studentSubclasses')->name('view.student.class');
Route::post('student/ajax/post', 'AdminstudentController@searchStudentLive')->name('live.search.student');
Route::post('student/ajax/background', 'AdminstudentController@ajaxGetBackground')->name('background.ajax.get');
Route::post('student/ajax/class', 'AdminstudentController@ajaxGetClass')->name('classes.ajax.get');
Route::post('class/ajax/subjects', 'AdminstudentController@ajaxGetClassSubjects')->name('classes.ajax.subjects');
Route::get('student/excel/class', 'DownloadController@exportStudentRecord')->name('export.excel.student');
Route::get('student/excel/import', 'AdminstudentController@importStudentExcel')->name('student.import.excel');

Route::post('student/suspend', 'AdminstudentController@suspendStudent')->name('student.suspend');
Route::post('student/dismiss', 'AdminstudentController@dismissStudent')->name('student.dismiss');

// manage subjects
Route::get('admin/subject', 'SubjectController@index')->name('admin.subject');
Route::post('admin/subject', 'SubjectController@submit')->name('subject.create.submit');
Route::get('admin/subject/all', 'SubjectController@view')->name('admin.subject.view');
Route::post('admin/subject/edit', 'SubjectController@edit')->name('subject.edit');
Route::get('admin/subject/get', 'SubjectController@select')->name('subject.create.select');
Route::get('admin/class/subject', 'SubjectController@getClassSujects')->name('class.subject.get');
// manage teacher
Route::get('admin/create/teacher', 'AdminTeacherController@index')->name('admin.teacher.create');
Route::post('admin/update/teacher', 'AdminTeacherController@update')->name('teacher.update');
Route::post('admin/create/teacher', 'AdminTeacherController@submit')->name('teacher.create.submit');
Route::get('admin/subject/add_subject', 'SubjectController@edit')->name('subject.subject.assign');
Route::get('admin/teacher/view', 'AdminTeacherController@view')->name('admin.teacher.view');
Route::get('admin/teacher/assign', 'AdminTeacherController@assign')->name('admin.subject.assign');
Route::post('admin/teacher/assign', 'AdminTeacherController@saveSubject')->name('teacher.subject');
Route::get('admin/teacher/subjects', 'AdminTeacherController@selectSubtect')->name('teacher.subject.select');
Route::post('admin/subject/ajax', 'AdminTeacherController@getAjaxSubject')->name('subject.class.get');
Route::get('admin/teacher/suspend', 'AdminTeacherController@suspendTeacher')->name('teacher.suspend');
Route::get('admin/teacher/permit', 'AdminTeacherController@permitTeacher')->name('teacher.permit');
//discipline
Route::get('admin/create/discipline', 'DisciplineController@create')->name('admin.create.discipline');
Route::get('admin/record/discipline', 'DisciplineController@record')->name('admin.record.discipline');
Route::get('admin/view/discipline', 'DisciplineController@view')->name('admin.view.discipline');
Route::post('admin/discipline', 'DisciplineController@submit')->name('discipline.form.submit');
Route::post('admin/discipline/update', 'DisciplineController@update')->name('discipline.form.update');
Route::post('admin/discipline/delete', 'DisciplineController@delete')->name('admin.delete.discipline');
Route::get('student/get/all', 'DisciplineController@getStudent')->name('get.student.all');//incomplete
Route::post('student/discipline/save', 'DisciplineController@saveStudentDiscipline')->name('save.student.discipline');
Route::post('student/discipline/delete', 'DisciplineController@deleteStudentDiscipline')->name('delete.student.discipline');

//fees and expenses
Route::get('fees/create', 'Fees_expensesController@createfeeType')->name('admin.create.fees.type');
Route::get('expense/create', 'Fees_expensesController@createexpenseType')->name('admin.create.expense.type');
Route::get('expense/creates', 'Fees_expensesController@getExpenseType')->name('expense.type.get');
Route::post('expense/create', 'Fees_expensesController@createexpenseSubmit')->name('expense.type.submit');
Route::post('fee/create', 'Fees_expensesController@SubmitType')->name('fee.type.submit');
Route::post('fee/update', 'Fees_expensesController@updateType')->name('fee_type.update.submit');
Route::post('expense/update', 'Fees_expensesController@updateExpenseType')->name('expense_type.update.submit');
Route::post('fee/delete', 'Fees_expensesController@deleteFeeType')->name('fee_type.delete');
Route::get('admin/collect_fees', 'Fees_expensesController@collectFees')->name('admin.collect.fees');
Route::post('admin/collect_fee', 'Fees_expensesController@collectSubmit')->name('student.fee.collect');
Route::post('admin/fee_clearance', 'Fees_expensesController@feeclearance')->name('student.fee_clearance');
Route::get('admin/fee_statistics', 'Fees_expensesController@feeStatistics')->name('student_fee_statistics');
Route::post('admin/student/fees_statistics', 'Fees_expensesController@getFeeType')->name('year.getfeetype');
Route::get('expense/view', 'Fees_expensesController@viewExpense')->name('admin.view.expense');
Route::get('fees/report', 'Fees_expensesController@reportFee')->name('fees.report');
Route::get('admin/collect/fees', 'Fees_expensesController@getStudents')->name('student.get.all');
Route::get('admin/fees/statistics', 'Fees_expensesController@getSatistics')->name('fees.statistics.all');
Route::post('admin/fees/statistics', 'Fees_expensesController@addExpenseType')->name('addExpense.type');
Route::get('admin/fees/ajax/create', 'Fees_expensesController@getClasses')->name('student.get.classes');
Route::get('fees/control', 'Fees_expensesController@showFeecontrolPage')->name('fees.control');
Route::post('fees/control', 'Fees_expensesController@feeControl')->name('fees.control.post');

// scholarship
Route::get('scholarship/create', 'ScholarshipController@index')->name('scholarship.create');
Route::get('scholarship/student', 'ScholarshipController@getStudents')->name('scholarship.students.get');
Route::post('student/scholarship', 'ScholarshipController@store')->name('scholarship.student.create');
Route::get('student/scholarship/report', 'ScholarshipController@showReportView')->name('admin.scholarship.view');
Route::get('student/scholarship/get', 'ScholarshipController@scholarshipPeryear')->name('report.scholarship.get');
Route::post('student/scholarship/delete', 'ScholarshipController@deleteScholarship')->name('scholarship.cancel');

// record marks for student
Route::get('student/marks/record', 'RecordController@index')->name('admin.record.marks');
Route::get('get/student/record', 'RecordController@getStudents')->name('record.student.get');
Route::get('student/fisrt_sequence', 'RecordController@savefirstSequence')->name('first.sequence.save');
Route::get('student/second_sequence', 'RecordController@saveSecondSequence')->name('second.sequence.save');
Route::get('student/third_sequence', 'RecordController@saveThirdSequence')->name('third.sequence.save');
Route::get('student/fourth_sequence', 'RecordController@savefourthSequence')->name('fourth.sequence.save');
Route::get('student/firth_sequence', 'RecordController@savefirthSequence')->name('firth.sequence.save');
Route::get('student/sith_sequence', 'RecordController@saveSithSequence')->name('sith.sequence.save');
Route::get('student/rank', 'RankStudentController@index')->name('student.rank.result');
Route::get('class/result', 'RankStudentController@classResult')->name('rank.result');
Route::post('student/result/generate', 'RankStudentController@studentResult')->name('student.result.generate');
Route::post('student/result', 'ClassResultController@getStudentResultPerclass')->name('generate.class.result');
Route::get('class/student/result', 'RankStudentController@getResult')->name('student.class.result');
Route::get('class/type/result', 'ClassResultController@getClassResult')->name('get.class_result');
Route::get('student/report_card', 'ClassResultController@showStudentReportCardPage')->name('student.report_card');

// income statement
Route::get('admin/income_statetment', 'IncomeController@index')->name('admin.income.statement');
Route::get('admin/income_statetments', 'IncomeController@getIncomeStatment')->name('get.income.statment');
Route::get('income/detail', 'IncomeController@getDetail')->name('get.detail');

Route::get('admin_logout', 'authController@adminLogout')->name('admin.logout');

//student's route
Route::get('student_home', 'StudentController@index')->name('student.home');
Route::get('student/subjects', 'StudentController@studentSubjectPage')->name('student.subjects');
Route::get('student/test_result', 'StudentController@studentResultPage')->name('student.result');
Route::get('student/test/result', 'StudentController@studentTestResult')->name('get_student.tes_result');
Route::get('student/note/get', 'StudentController@studentTeacherNote')->name('student.get.note');
Route::get('student/view_file', 'StudentController@studentFileView')->name('student.view.file');

Route::get('student_logout', 'authController@studentLogout')->name('student.logout');

//teacher's route
Route::get('teacher_logout', 'authController@teacherLogout')->name('teacher.logout');
Route::get('teacher_home', 'TeacherController@index')->name('teacher.home');
Route::get('teacher/subjects', 'TeacherController@getSubjects')->name('teacher.subjects');
Route::get('teacher/subjects/test', 'TeacherController@enterSubjectsTest')->name('student.register.test');
Route::get('get/student/records', 'TeacherController@getStudents')->name('teacher.record.student.mark');
Route::get('teacher/fisrt_sequence', 'TeacherController@savefirstSequence')->name('first.sequence.saves');
Route::get('teacher/second_sequence', 'TeacherController@saveSecondSequence')->name('second.sequence.saves');
Route::get('teacher/third_sequence', 'TeacherController@saveThirdSequence')->name('third.sequence.saves');
Route::get('teacher/fourth_sequence', 'TeacherController@savefourthSequence')->name('fourth.sequence.saves');
Route::get('teacher/firth_sequence', 'TeacherController@savefirthSequence')->name('firth.sequence.saves');
Route::get('teacher/sith_sequence', 'TeacherController@saveSithSequence')->name('sixth.sequence.save');
Route::get('teacher/file/upload', 'TeacherController@uploadFilePage')->name('teacher.upload.file');
Route::post('teacher/pdf/upload', 'TeacherController@uploadPfdf')->name('pdf.upload');
Route::get('teacher/pdf/preview', 'TeacherController@previewPfdf')->name('preview.pdf');
Route::get('teacher/pdf/share', 'TeacherController@pdfShare')->name('share.pdf');
Route::get('teacher/upload_assignments', 'teacherAssignmentController@assignments')->name('teacher.upload.assignment');
Route::post('teacher/upload_assignments', 'teacherAssignmentController@assignmentsAddFunction')->name('teacher.add_assignment');
Route::get('teacher/preview_assignment', 'teacherAssignmentController@assignmentPreview')->name('teacher.view.assignment');

//download controller
Route::get('fee/download', 'Downloadcontroller@feeDownload')->name('fee.download');
Route::get('classList/download', 'Downloadcontroller@classListDownload')->name('classlist.download');
Route::get('fee/print', 'Downloadcontroller@printFee')->name('downoad.print');
Route::get('admin/fees/excel', 'Downloadcontroller@downloadExcel')->name('report.fee.excel');
Route::get('admin/income_statement', 'Downloadcontroller@incomeStatementDownload')->name('download.incomestatement');
Route::get('admin/complete_fee', 'Downloadcontroller@completeFee')->name('student.completeFee.download');
Route::get('admin/uncomplete_fee', 'Downloadcontroller@uncompleteFee')->name('student.uncompleteFee.download');
