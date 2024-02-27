@php 
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();

@endphp


<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
      <img src="{{asset('public/backend/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('public/backend/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{route('profiles.index')}}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               @if(Auth::user()->role == 'admin')
        <li class="nav-item has-treeview {{($prefix == '/users')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                 Manage User
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('users.index')}}" class="nav-link {{($route=='users.index')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View User</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          

          <li class="nav-item has-treeview {{($prefix == '/password')?'menu-open':''}} {{($prefix == '/profiles')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Profile
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('profiles.index')}}" class="nav-link {{($route == 'profiles.index')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('password.index')}}" class="nav-link {{($route == 'password.index')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item has-treeview {{($prefix == '/setup')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Setup
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('setup.student.class.index')}}" class="nav-link {{($route == 'setup.student.class.index')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Student Class</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="{{route('setup.student.year.index')}}" class="nav-link {{($route == 'setup.student.year.index') ?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Year</p>
                </a>
              </li>
              </li>
                <li class="nav-item">
                <a href="{{route('setup.student.group.index')}}" class="nav-link {{($route == 'setup.student.group.index') ?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Student Group</p>
                </a>
              </li>

                <li class="nav-item">
                <a href="{{route('setup.student.shift.index')}}" class="nav-link {{($route == 'setup.student.shift.index') ?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Shift</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="{{route('setup.fee.category.index')}}" class="nav-link {{($route == 'setup.fee.category.index') ?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Fee Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('setup.fee.amount.index')}}" class="nav-link {{($route == 'setup.fee.amount.index') ?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Fee Amount</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('setup.exam.type.index')}}" class="nav-link {{($route == 'setup.exam.type.index') ?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Exam Type</p>
                </a>
              </li>


              <li class="nav-item">
                <a href="{{route('setup.subject.index')}}" class="nav-link {{($route == 'setup.subject.index') ?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Subject View</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('setup.assign.subject.index')}}" class="nav-link {{($route == 'setup.assign.subject.index') ?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Assign Subject</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('setup.designation.index')}}" class="nav-link {{($route == 'setup.designation.index') ?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Designation</p>
                </a>
              </li>


            </ul>

          </li>
            <li class="nav-item has-treeview {{($prefix == '/students')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Students
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('students.registration.index')}}" class="nav-link {{($route == 'students.registration.index')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Reg</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('students.roll.index')}}" class="nav-link {{($route == 'students.roll.index')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Roll Generate</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('students.reg-fee.index')}}" class="nav-link {{($route == 'students.reg-fee.index')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Registration Fee</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('students.monthly-fee.index')}}" class="nav-link {{($route == 'students.monthly-fee.index')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Monthly Fee</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('students.exam-fee.index')}}" class="nav-link {{($route == 'students.exam-fee.index')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Exam Fee</p>
                </a>
              </li>

            </ul>
          </li>

          </li>
            <li class="nav-item has-treeview {{($prefix == '/employee')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Employee
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('employees.registration.index')}}" class="nav-link {{($route == 'employees.registration.index')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Employee Registration</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('employees.salary.index')}}" class="nav-link {{($route == 'employees.salary.index')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Employee Salary</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('employees.leave.index')}}" class="nav-link {{($route == 'employees.leave.index')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Employee Leave</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('employees.attendance.index')}}" class="nav-link {{($route=='employees.attendance.index')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Employee Attendace</p>
                </a>
              </li>

                <li class="nav-item">
                <a href="{{route('employees.salary.monthly.index')}}" class="nav-link {{($route=='employees.salary.monthly.index')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Employee Monthly Salary </p>
                </a>
              </li>

            </ul>
          </li>

          </li>

          <li class=" nav-item has-treeview {{($prefix == '/marks')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Marks Managements
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{route('marks.entry.index')}}" class="nav-link {{($route == 'marks.entry.index')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Marks Entry</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('marks.entry.edit')}}" class="nav-link {{($route == 'marks.entry.edit')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Marks Edit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('marks.grade.index')}}" class="nav-link {{($route == 'marks.grade.index')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Grade Point</p>
                </a>
              </li>
            </ul>
          </li>


          <li class=" nav-item has-treeview {{($prefix == '/accounts')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Accounts Managements
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{route('students.accounts.fee.index')}}" class="nav-link {{($route == 'students.accounts.fee.index')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Fee </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('employee.accounts.fee.index')}}" class="nav-link {{($route == 'employee.accounts.fee.index')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Employee Salary </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('cost.fee.index')}}" class="nav-link {{($route == 'cost.fee.index')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Other Costs </p>
                </a>
              </li>
            </ul>
          </li>
          <li class=" nav-item has-treeview {{($prefix == '/reports')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Reports Managements
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('reports.profit.index')}}" class="nav-link {{($route == 'reports.profit.index')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Monthly Profit </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('reports.marksheet.index')}}" class="nav-link {{($route == 'reports.marksheet.index')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Marks Sheet</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('reports.attendance.index')}}" class="nav-link {{($route == 'reports.attendance.index')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Employee Attendance Reports</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{route('student.results.reports.index')}}" class="nav-link {{($route == 'student.results.reports.index')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Exam Result</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('student.idcard.reports.index')}}" class="nav-link {{($route == 'student.idcard.reports.index')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student ID Card</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  