<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controller\backend\UsersController;
use App\Http\Controllers\Auth\RegisterController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

//Frontend routes
Route::get('/',[App\Http\Controllers\frontend\FrontendController::class,'index'])->name('frontend.home');


Route::group(['middleware'=>'auth'],function(){

//users routes
Route::prefix('users')->group(function(){
    Route::get('/',[App\Http\Controllers\backend\UsersController::class,'index'])->name('users.index');
    Route::get('/create',[App\Http\Controllers\backend\UsersController::class,'create'])->name('users.create');
    Route::post('/',[App\Http\Controllers\backend\UsersController::class,'store'])->name('users.store');
    Route::get('/{id}/edit',[App\Http\Controllers\backend\UsersController::class,'edit'])->name('users.edit');
    Route::put('/{id}',[App\Http\Controllers\backend\UsersController::class,'update'])->name('users.update');
    Route::delete('/{id}',[App\Http\Controllers\backend\UsersController::class,'destroy'])->name('users.destroy');
});

//profiles routes
Route::prefix('profiles')->group(function(){
    Route::get('/',[App\Http\Controllers\backend\profilesController::class,'index'])->name('profiles.index');
    Route::get('/edit',[App\Http\Controllers\backend\profilesController::class,'edit'])->name('profiles.edit');
    Route::put('/',[App\Http\Controllers\backend\profilesController::class,'update'])->name('profiles.update');
});

// Change Password
Route::prefix('password')->group(function(){
    Route::get('/',[App\Http\Controllers\backend\PasswordController::class,'index'])->name('password.index');
    Route::get('/edit',[App\Http\Controllers\backend\PasswordController::class,'edit'])->name('password.edit');
    Route::put('/',[App\Http\Controllers\backend\PasswordController::class,'update'])->name('password.update');
});


//setup routes
Route::prefix('setup')->group(function(){
    //student class
    Route::get('/student/class',[App\Http\Controllers\backend\setup\StudentClassController::class,'index'])->name('setup.student.class.index');
    Route::get('/student/class/create',[App\Http\Controllers\backend\setup\StudentClassController::class,'create'])->name('setup.student.class.create');
    Route::post('/student/class/',[App\Http\Controllers\backend\setup\StudentClassController::class,'store'])->name('setup.student.class.store');
    Route::get('/student/class/{id}/edit',[App\Http\Controllers\backend\setup\StudentClassController::class,'edit'])->name('setup.student.class.edit');
    Route::put('/student/class/{id}',[App\Http\Controllers\backend\setup\StudentClassController::class,'update'])->name('setup.student.class.update');
    Route::delete('/student/class/{id}',[App\Http\Controllers\backend\setup\StudentClassController::class,'destroy'])->name('setup.student.class.destroy');



    //student Year
    Route::get('/student/year',[App\Http\Controllers\backend\setup\YearController::class,'index'])->name('setup.student.year.index');
    Route::get('/student/year/create',[App\Http\Controllers\backend\setup\YearController::class,'create'])->name('setup.student.year.create');
    Route::post('/student/year/',[App\Http\Controllers\backend\setup\YearController::class,'store'])->name('setup.student.year.store');
    Route::get('/student/year/{id}/edit',[App\Http\Controllers\backend\setup\YearController::class,'edit'])->name('setup.student.year.edit');
    Route::put('/student/year/{id}',[App\Http\Controllers\backend\setup\YearController::class,'update'])->name('setup.student.year.update');
    Route::delete('/student/year/{id}',[App\Http\Controllers\backend\setup\YearController::class,'destroy'])->name('setup.student.year.destroy');

    //student Group
    Route::get('/student/group',[App\Http\Controllers\backend\setup\StudentGroupController::class,'index'])->name('setup.student.group.index');
    Route::get('/student/group/create',[App\Http\Controllers\backend\setup\StudentGroupController::class,'create'])->name('setup.student.group.create');
    Route::post('/student/group/',[App\Http\Controllers\backend\setup\StudentGroupController::class,'store'])->name('setup.student.group.store');
    Route::get('/student/group/{id}/edit',[App\Http\Controllers\backend\setup\StudentGroupController::class,'edit'])->name('setup.student.group.edit');
    Route::put('/student/group/{id}',[App\Http\Controllers\backend\setup\StudentGroupController::class,'update'])->name('setup.student.group.update');
    Route::delete('/student/group/{id}',[App\Http\Controllers\backend\setup\StudentGroupController::class,'destroy'])->name('setup.student.group.destroy');

        //student Shift
    Route::get('/student/shift',[App\Http\Controllers\backend\setup\StudentShiftController::class,'index'])->name('setup.student.shift.index');
    Route::get('/student/shift/create',[App\Http\Controllers\backend\setup\StudentShiftController::class,'create'])->name('setup.student.shift.create');
    Route::post('/student/shift/',[App\Http\Controllers\backend\setup\StudentShiftController::class,'store'])->name('setup.student.shift.store');
    Route::get('/student/shift/{id}/edit',[App\Http\Controllers\backend\setup\StudentShiftController::class,'edit'])->name('setup.student.shift.edit');
    Route::put('/student/shift/{id}',[App\Http\Controllers\backend\setup\StudentShiftController::class,'update'])->name('setup.student.shift.update');
    Route::delete('/student/shift/{id}',[App\Http\Controllers\backend\setup\StudentShiftController::class,'destroy'])->name('setup.student.shift.destroy');

            //student Fee Category
    Route::get('/fee/category',[App\Http\Controllers\backend\setup\FeeCategoryController::class,'index'])->name('setup.fee.category.index');
    Route::get('/fee/category/create',[App\Http\Controllers\backend\setup\FeeCategoryController::class,'create'])->name('setup.fee.category.create');
    Route::post('/fee/category/',[App\Http\Controllers\backend\setup\FeeCategoryController::class,'store'])->name('setup.fee.category.store');
    Route::get('/fee/category/{id}/edit',[App\Http\Controllers\backend\setup\FeeCategoryController::class,'edit'])->name('setup.fee.category.edit');
    Route::put('/fee/category/{id}',[App\Http\Controllers\backend\setup\FeeCategoryController::class,'update'])->name('setup.fee.category.update');
    Route::delete('/fee/category/{id}',[App\Http\Controllers\backend\setup\FeeCategoryController::class,'destroy'])->name('setup.fee.category.destroy');

    //student Fee Amount
    Route::get('/fee/amount',[App\Http\Controllers\backend\setup\FeeAmountController::class,'index'])->name('setup.fee.amount.index');
    Route::get('/fee/amount/create',[App\Http\Controllers\backend\setup\FeeAmountController::class,'create'])->name('setup.fee.amount.create');
    Route::post('/fee/amount/',[App\Http\Controllers\backend\setup\FeeAmountController::class,'store'])->name('setup.fee.amount.store');
    Route::get('/fee/amount/{category_id}/edit',[App\Http\Controllers\backend\setup\FeeAmountController::class,'edit'])->name('setup.fee.amount.edit');
    Route::get('/fee/amount/{category_id}/show',[App\Http\Controllers\backend\setup\FeeAmountController::class,'show'])->name('setup.fee.amount.show');
    Route::put('/fee/amount/{category_id}',[App\Http\Controllers\backend\setup\FeeAmountController::class,'update'])->name('setup.fee.amount.update');
    Route::delete('/fee/amount/{category_id}',[App\Http\Controllers\backend\setup\FeeAmountController::class,'destroy'])->name('setup.fee.amount.destroy');

        //Exam Type
    Route::get('/exam/type',[App\Http\Controllers\backend\setup\ExamTypeController::class,'index'])->name('setup.exam.type.index');
    Route::get('/exam/type/create',[App\Http\Controllers\backend\setup\ExamTypeController::class,'create'])->name('setup.exam.type.create');
    Route::post('/exam/type/',[App\Http\Controllers\backend\setup\ExamTypeController::class,'store'])->name('setup.exam.type.store');
    Route::get('/exam/type/{id}/edit',[App\Http\Controllers\backend\setup\ExamTypeController::class,'edit'])->name('setup.exam.type.edit');
    Route::get('/exam/type/{id}/show',[App\Http\Controllers\backend\setup\ExamTypeController::class,'show'])->name('setup.exam.type.show');
    Route::put('/exam/type/{id}',[App\Http\Controllers\backend\setup\ExamTypeController::class,'update'])->name('setup.exam.type.update');
    Route::delete('/exam/type/{id}',[App\Http\Controllers\backend\setup\ExamTypeController::class,'destroy'])->name('setup.exam.type.destroy');

    //Subjects 

    Route::get('/designation/view',[App\Http\Controllers\backend\setup\DesignationController::class,'index'])->name('setup.designation.index');
    Route::get('/designation/view/create',[App\Http\Controllers\backend\setup\DesignationController::class,'create'])->name('setup.designation.create');
    Route::post('/designation/view/',[App\Http\Controllers\backend\setup\DesignationController::class,'store'])->name('setup.designation.store');
    Route::get('/designation/view/{id}/edit',[App\Http\Controllers\backend\setup\DesignationController::class,'edit'])->name('setup.designation.edit');
    Route::get('/designation/view/{id}/show',[App\Http\Controllers\backend\setup\DesignationController::class,'show'])->name('setup.designation.show');
    Route::put('/designation/view/{id}',[App\Http\Controllers\backend\setup\DesignationController::class,'update'])->name('setup.designation.update');
    Route::delete('/designation/view/{id}',[App\Http\Controllers\backend\setup\DesignationController::class,'destroy'])->name('setup.designation.destroy');

    //Assign Subjects 

    Route::get('/assign/subject/view',[App\Http\Controllers\backend\setup\AssignSubjectController::class,'index'])->name('setup.assign.subject.index');
    Route::get('/assign/subject/view/create',[App\Http\Controllers\backend\setup\AssignSubjectController::class,'create'])->name('setup.assign.subject.create');
    Route::post('/assign/subject/view/',[App\Http\Controllers\backend\setup\AssignSubjectController::class,'store'])->name('setup.assign.subject.store');
    Route::get('/assign/subject/view/{class_id}/edit',[App\Http\Controllers\backend\setup\AssignSubjectController::class,'edit'])->name('setup.assign.subject.edit');
    Route::get('/assign/subject/view/{class_id}/show',[App\Http\Controllers\backend\setup\AssignSubjectController::class,'show'])->name('setup.assign.subject.show');
    Route::put('/assign/subject/view/{class_id}',[App\Http\Controllers\backend\setup\AssignSubjectController::class,'update'])->name('setup.assign.subject.update');
    Route::delete('/assign/subject/view/{class_id}',[App\Http\Controllers\backend\setup\AssignSubjectController::class,'destroy'])->name('setup.assign.subject.destroy');

//Subjects 

    Route::get('/subject/view',[App\Http\Controllers\backend\setup\SubjectController::class,'index'])->name('setup.subject.index');
    Route::get('/subject/view/create',[App\Http\Controllers\backend\setup\SubjectController::class,'create'])->name('setup.subject.create');
    Route::post('/subject/view/',[App\Http\Controllers\backend\setup\SubjectController::class,'store'])->name('setup.subject.store');
    Route::get('/subject/view/{id}/edit',[App\Http\Controllers\backend\setup\SubjectController::class,'edit'])->name('setup.subject.edit');
    Route::get('/subject/view/{id}/show',[App\Http\Controllers\backend\setup\SubjectController::class,'show'])->name('setup.subject.show');
    Route::put('/subject/view/{id}',[App\Http\Controllers\backend\setup\SubjectController::class,'update'])->name('setup.subject.update');
    Route::delete('/subject/view/{id}',[App\Http\Controllers\backend\setup\SubjectController::class,'destroy'])->name('setup.subject.destroy');

});
//Students routes
Route::prefix('students')->group(function(){

//Student Registration routes
    Route::get('/reg',[App\Http\Controllers\backend\students\studentRegController::class,'index'])->name('students.registration.index');
    Route::get('/reg/create',[App\Http\Controllers\backend\students\studentRegController::class,'create'])->name('students.registration.create');
    Route::post('/reg/',[App\Http\Controllers\backend\students\studentRegController::class,'store'])->name('students.registration.store');
    Route::get('/reg/{student_id}/edit',[App\Http\Controllers\backend\students\studentRegController::class,'edit'])->name('students.registration.edit');
    Route::put('/reg/{student_id}',[App\Http\Controllers\backend\students\studentRegController::class,'update'])->name('students.registration.update');
    Route::get('/year-class-wise',[App\Http\Controllers\backend\students\studentRegController::class,'classYearWise'])->name('students.class.year.wise');
    Route::get('/promotion/{student_id}',[App\Http\Controllers\backend\students\studentRegController::class,'studentPromotion'])->name('students.promotion');

    Route::put('/promotion/{student_id}',[App\Http\Controllers\backend\students\studentRegController::class,'studentPromotionStore'])->name('students.promotion.store');
    Route::get('/details/{student_id}',[App\Http\Controllers\backend\students\studentRegController::class,'details'])->name('students.details');

//Student Roll Generate routes
    Route::get('/roll/view',[App\Http\Controllers\backend\students\studentRollController::class,'index'])->name('students.roll.index');
    Route::get('/roll/get-student',[App\Http\Controllers\backend\students\studentRollController::class,'getStudent'])->name('students.roll.get.student');
    Route::post('/roll/store',[App\Http\Controllers\backend\students\studentRollController::class,'store'])->name('students.roll.store');

    //Student registration Fee 
    Route::get('/reg-fee/view',[App\Http\Controllers\backend\students\studentRegFeeController::class,'index'])->name('students.reg-fee.index');
    Route::get('/reg-get-student-reg-fee/view',[App\Http\Controllers\backend\students\studentRegFeeController::class,'getStudent'])->name('students.reg-fee.get-student');
    Route::get('/reg-get-student-reg-fee/payslip',[App\Http\Controllers\backend\students\studentRegFeeController::class,'payslip'])->name('students.reg-fee.get-student-payslip');

    //Student Monthly Fee 
    Route::get('/monthly-fee/view',[App\Http\Controllers\backend\students\studentmonthlyFeeController::class,'index'])->name('students.monthly-fee.index');
    Route::get('/monthly-get-student-monthly-fee/view',[App\Http\Controllers\backend\students\studentmonthlyFeeController::class,'getStudent2'])->name('students.monthly-fee.get-student');
    Route::get('/monthly-get-student-monthly-fee/payslip',[App\Http\Controllers\backend\students\studentmonthlyFeeController::class,'payslip'])->name('students.monthly-fee.get-student-payslip');

    //Student Exam Fee 
    Route::get('/exam-fee/view',[App\Http\Controllers\backend\students\studentexamFeeController::class,'index'])->name('students.exam-fee.index');
    Route::get('/exam-get-student-exam-fee/view',[App\Http\Controllers\backend\students\studentexamFeeController::class,'getStudent'])->name('students.exam-fee.get-student');
    Route::get('/exam-get-student-exam-fee/payslip',[App\Http\Controllers\backend\students\studentexamFeeController::class,'payslip'])->name('students.exam-fee.get-student-payslip');
});
//Students routes
Route::prefix('employee')->group(function(){

//employee Registration routes
    Route::get('/reg',[App\Http\Controllers\backend\employees\EmployeeRegController::class,'index'])->name('employees.registration.index');
    Route::get('/reg/create',[App\Http\Controllers\backend\employees\EmployeeRegController::class,'create'])->name('employees.registration.create');
    Route::post('/reg/',[App\Http\Controllers\backend\employees\EmployeeRegController::class,'store'])->name('employees.registration.store');
    Route::get('/reg/{id}/edit',[App\Http\Controllers\backend\employees\EmployeeRegController::class,'edit'])->name('employees.registration.edit');
    Route::put('/reg/{id}',[App\Http\Controllers\backend\employees\EmployeeRegController::class,'update'])->name('employees.registration.update');
    Route::get('/details/{id}',[App\Http\Controllers\backend\employees\EmployeeRegController::class,'details'])->name('employees.registration.details');

    //employee Salary routes
    Route::get('/salary',[App\Http\Controllers\backend\employees\EmployeeSalaryController::class,'index'])->name('employees.salary.index');
    Route::get('/salary/{id}/increment',[App\Http\Controllers\backend\employees\EmployeeSalaryController::class,'increment'])->name('employees.salary.increment');
    Route::put('/salary/store/{id}',[App\Http\Controllers\backend\employees\EmployeeSalaryController::class,'store'])->name('employees.salary.store');
    Route::get('/salary/details/{id}',[App\Http\Controllers\backend\employees\EmployeeSalaryController::class,'details'])->name('employees.salary.details');

    //employee Leave routes
    Route::get('/leave',[App\Http\Controllers\backend\employees\EmployeeLeaveController::class,'index'])->name('employees.leave.index');
    Route::get('/leave/create',[App\Http\Controllers\backend\employees\EmployeeLeaveController::class,'create'])->name('employees.leave.create');
    Route::post('/leave/',[App\Http\Controllers\backend\employees\EmployeeLeaveController::class,'store'])->name('employees.leave.store');
    Route::get('/leave/{id}/edit',[App\Http\Controllers\backend\employees\EmployeeLeaveController::class,'edit'])->name('employees.leave.edit');
    Route::put('/leave/{id}',[App\Http\Controllers\backend\employees\EmployeeLeaveController::class,'update'])->name('employees.leave.update');

        //employee Attendance routes
    Route::get('/attendance',[App\Http\Controllers\backend\employees\EmployeeAttendanceController::class,'index'])->name('employees.attendance.index');
    Route::get('/attendance/create',[App\Http\Controllers\backend\employees\EmployeeAttendanceController::class,'create'])->name('employees.attendance.create');
    Route::post('/attendance/',[App\Http\Controllers\backend\employees\EmployeeAttendanceController::class,'store'])->name('employees.attendance.store');
    Route::get('/attendance/{date}/edit',[App\Http\Controllers\backend\employees\EmployeeAttendanceController::class,'edit'])->name('employees.attendance.edit');
        Route::get('/attendance/{date}/details',[App\Http\Controllers\backend\employees\EmployeeAttendanceController::class,'details'])->name('employees.attendance.details');
   

    //employee Monthly Salary routes
    Route::get('/monthly-salary',[App\Http\Controllers\backend\employees\EmployeeMonthlySalaryController::class,'index'])->name('employees.salary.monthly.index');
    Route::get('/monthly-salary/getSalary',[App\Http\Controllers\backend\employees\EmployeeMonthlySalaryController::class,'getSalary'])->name('employees.salary.monthly.getSalary');
    Route::get('/monthly-salary/payslip/{employee_id}',[App\Http\Controllers\backend\employees\EmployeeMonthlySalaryController::class,'payslip'])->name('employees.salary.monthly.payslip');
    Route::post('/monthly-salary/',[App\Http\Controllers\backend\employees\EmployeeMonthlySalaryController::class,'store'])->name('employees.salary.monthly.store');
    Route::get('/monthly-salary/{date}/edit',[App\Http\Controllers\backend\employees\EmployeeMonthlySalaryController::class,'edit'])->name('employees.salary.monthly.edit');
    Route::get('/attend/details/{date}',[App\Http\Controllers\backend\employees\EmployeeMonthlySalaryController::class,'details'])->name('employees.salary.monthly.details');
});
Route::prefix('marks')->group(function(){
//Student Marks Management routes
    Route::get('/entry',[App\Http\Controllers\backend\MarksManagements\MarksEntryController::class,'index'])->name('marks.entry.index');
    Route::post('/marks/entry/',[App\Http\Controllers\backend\MarksManagements\MarksEntryController::class,'store'])->name('marks.entry.store');
    Route::get('/entry/edit',[App\Http\Controllers\backend\MarksManagements\MarksEntryController::class,'edit'])->name('marks.entry.edit');
    Route::post('/marks/update',[App\Http\Controllers\backend\MarksManagements\MarksEntryController::class,'update'])->name('marks.entry.update');
    Route::get('/marks/edit',[App\Http\Controllers\backend\MarksManagements\MarksEntryController::class,'marksEdit'])->name('marks.edit.details');

    //Student Grade Point Routesutes
    Route::get('/grade',[App\Http\Controllers\backend\MarksManagements\MarksGradeController::class,'index'])->name('marks.grade.index');
    Route::get('/grade/create',[App\Http\Controllers\backend\MarksManagements\MarksGradeController::class,'create'])->name('marks.grade.create');
    Route::post('/grade/',[App\Http\Controllers\backend\MarksManagements\MarksGradeController::class,'store'])->name('marks.grade.store');
    Route::get('/grade/{id}/edit',[App\Http\Controllers\backend\MarksManagements\MarksGradeController::class,'edit'])->name('marks.grade.edit');
    Route::put('/grade/{id}',[App\Http\Controllers\backend\MarksManagements\MarksGradeController::class,'update'])->name('marks.grade.update');

});

//Accounts Managements
Route::prefix('accounts')->group(function(){
    //Student Fee collection
    Route::get('student/fee/view',[App\Http\Controllers\backend\accounts\StudentAccountFeeController::class,'index'])->name('students.accounts.fee.index');
    Route::get('student/fee/create',[App\Http\Controllers\backend\accounts\StudentAccountFeeController::class,'create'])->name('students.accounts.fee.create');
    Route::post('student/fee/store',[App\Http\Controllers\backend\accounts\StudentAccountFeeController::class,'store'])->name('students.accounts.fee.store');
    Route::get('student/fee/{id}/edit',[App\Http\Controllers\backend\accounts\StudentAccountFeeController::class,'edit'])->name('students.accounts.fee.edit');
    Route::get('getstudent/view',[App\Http\Controllers\backend\accounts\StudentAccountFeeController::class,'getStudent'])->name('students.accounts.fee.getStduent');


    //Employee Salary payment
    Route::get('employee/fee/view',[App\Http\Controllers\backend\accounts\EmployeeAccountSalaryController::class,'index'])->name('employee.accounts.fee.index');
    Route::get('employee/fee/create',[App\Http\Controllers\backend\accounts\EmployeeAccountSalaryController::class,'create'])->name('employee.accounts.fee.create');
    Route::post('employee/fee/store',[App\Http\Controllers\backend\accounts\EmployeeAccountSalaryController::class,'store'])->name('employee.accounts.fee.store');
    Route::get('employee/fee/{id}/edit',[App\Http\Controllers\backend\accounts\EmployeeAccountSalaryController::class,'edit'])->name('employee.accounts.fee.edit');
    Route::get('employee/fee/getemployee',[App\Http\Controllers\backend\accounts\EmployeeAccountSalaryController::class,'getEmployee'])->name('employee.accounts.fee.getemployee');

//Other Cost 
    Route::get('cost/fee/view',[App\Http\Controllers\backend\accounts\OtherCostyController::class,'index'])->name('cost.fee.index');
    Route::get('cost/fee/create',[App\Http\Controllers\backend\accounts\OtherCostyController::class,'create'])->name('cost.fee.create');
    Route::post('cost/fee/store',[App\Http\Controllers\backend\accounts\OtherCostyController::class,'store'])->name('cost.fee.store');
    Route::get('cost/fee/{id}/edit',[App\Http\Controllers\backend\accounts\OtherCostyController::class,'edit'])->name('cost.fee.edit');
    Route::put('cost/fee/{id}/update',[App\Http\Controllers\backend\accounts\OtherCostyController::class,'update'])->name('cost.fee.update');
    Route::get('getemployee/view',[App\Http\Controllers\backend\accounts\OtherCostyController::class,'getCost'])->name('cost.fee.getemployee');


});

//Report Managements
Route::prefix('reports')->group(function(){
    //Monthly Profit
    Route::get('monthly/profit/view',[App\Http\Controllers\backend\Reports\MonthlyProfitController::class,'index'])->name('reports.profit.index');
    Route::get('monthly/profit/get',[App\Http\Controllers\backend\Reports\MonthlyProfitController::class,'getProfit'])->name('report.profit.dwise.get');
    Route::get('monthly/profit/pdf',[App\Http\Controllers\backend\Reports\MonthlyProfitController::class,'profitPdf'])->name('reports.profit.pdf');

    //Marks Sheet
    Route::get('marksheet/view',[App\Http\Controllers\backend\Reports\MarksheetController::class,'index'])->name('reports.marksheet.index');
    Route::post('marksheet/get',[App\Http\Controllers\backend\Reports\MarksheetController::class,'getMarksheet'])->name('report.marksheet.get');

    //Employee Attendance Report
    Route::get('employee/attendance/report/view',[App\Http\Controllers\backend\Reports\EmpAttendanceReportController::class,'index'])->name('reports.attendance.index');
    Route::post('employee/attendance/report/get',[App\Http\Controllers\backend\Reports\EmpAttendanceReportController::class,'getattendance'])->name('report.attendance.get');

    //Students Results Report
    Route::get('students/results/report/view',[App\Http\Controllers\backend\Reports\StudentResultReportController::class,'index'])->name('student.results.reports.index');
    Route::post('students/results/report/get',[App\Http\Controllers\backend\Reports\StudentResultReportController::class,'getStudentResults'])->name('student.results.reports.getResults');

    //Students ID Card Generate
    Route::get('students/idcard/view',[App\Http\Controllers\backend\Reports\StudentIdCardReportController::class,'index'])->name('student.idcard.reports.index');
    Route::post('students/idcard/get',[App\Http\Controllers\backend\Reports\StudentIdCardReportController::class,'getStudentidcard'])->name('student.idcard.reports.getidcard');


});
Route::get('/get-student/search',[App\Http\Controllers\backend\DefaultController::class,'getStudent'])->name('get.student.search');
Route::get('/get-student/subject',[App\Http\Controllers\backend\DefaultController::class,'getSubject'])->name('get.student.subject');
});


 
