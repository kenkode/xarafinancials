@extends('layouts.main2')

{{ HTML::script('media/jquery-1.12.0.min.js') }}

@section('content')

<style type="text/css">
li #general:before,li #company:before,li #prefs:before,li #employee:before,
li #bank:before,li #payroll:before,li #reports:before,li #leaves:before,
li #payrollsettings:before,li #emprep:before,li #leavereport:before,
li #advance:before,li #payrep:before,li #statutory:before{
    background-image: url("{{asset('public/uploads/images/collapsed.png')}}");
    margin-right: 4px;
    margin-left: -10px;
}
ul {
    list-style-type:none
}

</style>

@if (Session::get('notice'))
            <div class="alert alert-info">{{ Session::get('notice') }}</div>
        @endif
    

    <script type="text/javascript">
    $(document).ready(function(){
      $('#companyinfo').hide();
      $('#settings').hide();
      $('#employeeinfo').hide();
      $('#bankinfo').hide();
      $('#payrollinfo').hide();
      $('#repall').hide();
      $('#gensettings').hide();
      $('#leaveinfo').hide();
      $('#payrollset').hide();
      $('#hrrep').hide();
      $('#leaverep').hide();
      $('#payrollrep').hide();
      $('#advancerep').hide();
      $('#statutoryrep').hide();
       
      $('#company').click(function(){
      $('#companyinfo').toggle();
      });
      $('#prefs').click(function(){
      $('#settings').toggle();
      });
      $('#employee').click(function(){
      $('#employeeinfo').toggle();
      });
      $('#bank').click(function(){
      $('#bankinfo').toggle();
      });
      $('#payroll').click(function(){
      $('#payrollinfo').toggle();
      });
      $('#reports').click(function(){
      $('#repall').toggle();
      });
      $('#general').click(function(){
      $('#gensettings').toggle();
      $(this).find('img').toggle();
      });
      $('#leaves').click(function(){
      $('#leaveinfo').toggle();
      $(this).find('img').toggle();
      });
      $('#payrollsettings').click(function(){
      $('#payrollset').toggle();
      $(this).find('img').toggle();
      });
      $('#emprep').click(function(){
      $('#hrrep').toggle();
      $(this).find('img').toggle();
      });
      $('#leavereport').click(function(){
      $('#leaverep').toggle();
      $(this).find('img').toggle();
      });
      $('#advance').click(function(){
      $('#advancerep').toggle();
      $(this).find('img').toggle();
      });
      $('#payrep').click(function(){
      $('#payrollrep').toggle();
      $(this).find('img').toggle();
      });
      $('#statutory').click(function(){
      $('#statutoryrep').toggle();
      $(this).find('img').toggle();
      });
    });
    </script>
                  
{{ HTML::script('js/scripts.js') }}

 @if (Session::has('flash_message'))

  <div class="alert alert-success">
  {{ Session::get('flash_message') }}
  </div>
  @endif
 
  @if (Session::has('delete_message'))

  <div class="alert alert-danger">
  {{ Session::get('delete_message') }}
   </div>
   @endif
<div class="row" style="margin-top: 3%;">
  <div class="col-lg-12">

    <div class="col-lg-4">
    <a href="{{'hrdashboard'}}" id="payroll"><img src="{{asset('public/uploads/images/briefcase-business-tool.png')}}" alt="logo" width="20%">MANAGE PAYROLL</a>
    </div>
  
    <div class="col-lg-4">
    <a href="{{'erpmgmt'}}" id="erp"><img src="{{asset('public/uploads/images/software-carton-1076811_640.jpg')}}" alt="logo" width="20%">ERP</a>
    </div>
    
    <div class="col-lg-4">
    <a href="#" id="prefs"><img src="{{asset('public/uploads/images/cogwheel-145804_1280.png')}}" alt="logo" width="20%">PREFERENCES</a>
    <ul id="settings">
    <li><a href="{{ URL::to('users/profile/'.Confide::user()->id ) }}">  Profile</a></li>
    <li><a href="{{ URL::to('organizations') }}">Organization Settings</a></li>
    <li><a href="{{ URL::to('accounts') }}"> Accounts Settings</a></li>
    <li><a href="{{ URL::to('system') }}"> System Settings</a></li>
    @if($organization->is_payroll_active)
    <li><a href="{{ URL::to('departments') }}">General Settings</a></li></div>
    @else
    @endif    
  </ul>
    </div>
    <div class="col-lg-12">
    <div class="col-lg-4">
    <a href="{{ URL::to('users/logout') }}"><img src="{{asset('public/uploads/images/logout-153871_1280.png')}}" alt="logo" width="20%">LOG OUT / CHANGE USER</a>
    </div>

    </div>
    


      <!-- <table id="datadash" class="table" style="border-style: none;">


      <thead style="border-style: none;">

        <th></th>
        <th></th>
        <th></th>
        <th></th>

      </thead>

      <tbody style="border-style: none;">

        <tr>

          <td><a href="{{ URL::to('employees') }}"><i class="fa fa-users fa-fw"></i>Manage Employees </a></td>
          <td><a href="{{ URL::to('other_earnings') }}"><i class="glyphicon glyphicon-credit-card fa-fw"></i> Manage Payroll</a></td>
          <td><a href="{{ URL::to('leavemgmt') }}"><i class="fa fa-user fa-fw"></i> Manage Leaves</a></td>
          <td><a href="{{ URL::to('reports')}}"><i class="fa fa-file fa-fw"></i>View Reports</a></td>
          
        </tr>

        <tr>
          <td><a href="{{ URL::to('organizations') }}"><i class="glyphicon glyphicon-cog fa-fw"></i> Organization Settings</a></td>
          <td><a href="{{ URL::to('accounts') }}"><i class="glyphicon glyphicon-cog fa-fw"></i> Accounts Settings</a></td>
          <td><a href="{{ URL::to('system') }}"><i class="glyphicon glyphicon-cog fa-fw"></i> System Settings</a></td>
          <td><a href="{{ URL::to('departments') }}"><i class="glyphicon glyphicon-cog fa-fw"></i>General Settings</a></td>
         
        </tr>

         <tr>

          <td><a href="{{ URL::to('branches') }}"><i class="fa fa-list fa-fw"></i> Branches</a></td>
          <td><a href="{{ URL::to('departments') }}"><i class="fa fa-list fa-fw"></i> Departments</a></td>
          <td><a href="{{ URL::to('employee_type') }}"><i class="fa fa-users fa-fw"></i> Employee Types</a></td>
          <td><a href="{{ URL::to('job_group') }}"><i class="fa fa-users fa-fw"></i> Job Groups</a></td>
          
        </tr>


        <tr>
          
          <td><a href="{{ URL::to('benefitsettings') }}"><i class="glyphicon glyphicon-cog fa-fw"></i> Benefit Settings</a></td>
          <td><a href="{{ URL::to('citizenships') }}"><i class="glyphicon glyphicon-cog fa-fw"></i>  Citizenship</a></td>
          <td><a href="{{ URL::to('AppraisalSettings') }}"><i class="glyphicon glyphicon-cog fa-fw"></i> Appraisal Setting</a></td>
          <td><a href="{{ URL::to('appraisalcategories') }}"><i class="glyphicon glyphicon-cog fa-fw"></i>Appraisal Category</a></td>
        </tr>

        <tr>
 
          <td><a href="{{ URL::to('banks') }}"><i class="glyphicon glyphicon-home fa-fw"></i> Banks</a></td>
          <td><a href="{{ URL::to('bank_branch') }}"><i class="glyphicon glyphicon-home fa-fw"></i> Bank Branches</a></td>
          <td><a href="{{ URL::to('nssf') }}"><i class="fa fa-list fa-fw"></i> Nssf Rates</a></td> 
          <td><a href="{{ URL::to('nhif') }}"><i class="fa fa-list fa-fw"></i> Nhif Rates</a></td>
        </tr>

        <tr>
          <td><a href="{{ URL::to('allowances') }}"><i class="glyphicon glyphicon-cog fa-fw"></i>  Payroll Settings</a></td>
          <td><a href="{{ URL::to('occurencesettings') }}"><i class="glyphicon glyphicon-cog fa-fw"></i>  Occurence Settings</a></td>
          <td><a href="{{ URL::to('leavetypes') }}"><i class="fa fa-list fa-fw"></i> Leave Types</a></td>
          <td><a href="{{ URL::to('holidays') }}"><i class="fa fa-random fa-fw"></i> Holiday Management</a></td>
           
          
        </tr>

        <tr>
          <td><a href="{{ URL::to('leavemgmt') }}"><i class="fa fa-file fa-fw"></i> Leave Applications</a></td>
          <td><a href="{{ URL::to('leaveamends') }}"><i class="fa fa-edit fa-fw"></i>  Leaves Amended</a></td>
          <td><a href="{{ URL::to('leaveapprovals') }}"><i class="fa fa-check fa-fw"></i>  Leaves Approved</a></td>
           <td><a  href="{{ URL::to('leaverejects') }}"><i class="fa fa-barcode fa-fw"></i> Leaves Rejected</a></td>
          
        </tr>


       

        <tr>
          <td><a href="{{ URL::to('portal')}}"><i class="fa fa-user fa-fw"></i>Portal</a></td>
          <td><a href="{{ URL::to('deactives') }}"><i class="fa fa-users fa-fw"></i> Activate Employee</a></td>
          <td><a target="_blank" href="{{ URL::to('EmployeeForm') }}"><i class="fa fa-file fa-fw"></i>  Employee Detail Form</a></td>
          <td><a href="{{ URL::to('migrate') }}"><i class="glyphicon glyphicon-random fa-fw"></i>  Data Migration</a></td>     
            
        </tr>

        
      
        <tr>
          <td><a href="{{ URL::to('earningsettings') }}"><i class="glyphicon glyphicon-cog fa-fw"></i>  Earning Settings</a></td>
          <td><a href="{{ URL::to('allowances') }}"><i class="glyphicon glyphicon-cog fa-fw"></i> Allowance Settings</a></td>
          <td><a href="{{ URL::to('reliefs') }}"><i class="glyphicon glyphicon-cog fa-fw"></i> Relief Settings</a></td>
          <td><a href="{{ URL::to('deductions') }}"><i class="glyphicon glyphicon-cog fa-fw"></i> Deductions Settings</a></td>
          
        </tr>

        <tr>
          <td><a href="{{ URL::to('nontaxables') }}"><i class="glyphicon glyphicon-cog fa-fw"></i> Non Taxable Income Settings</a></td>
          <td><a href="{{ URL::to('other_earnings') }}"><i class="glyphicon glyphicon-credit-card fa-fw"></i>Manage Earnings</a></td>
          <td><a href="{{ URL::to('employee_allowances') }}"><i class="glyphicon glyphicon-credit-card fa-fw"></i>Manage Allowances</a></td>
          <td><a href="{{ URL::to('overtimes') }}"><i class="glyphicon glyphicon-credit-card fa-fw"></i>Manage Overtimes</a></td> 
          
        </tr>


        <tr>
          <td><a href="{{ URL::to('employee_relief') }}"><i class="glyphicon glyphicon-credit-card fa-fw"></i>Manage Relief</a></td>
          <td><a href="{{ URL::to('employee_deductions') }}"><i class="glyphicon glyphicon-barcode fa-fw"></i>Manage Deductions</a></td>
          <td><a href="{{ URL::to('employeenontaxables') }}"><i class="glyphicon glyphicon-barcode fa-fw"></i>Manage Non Taxable Income</a></td>
         <td><a href="{{ URL::to('payrollcalculator') }}"><i class="glyphicon glyphicon-calendar"></i> Payroll Calculator</a></td> 
         
          
        </tr>


        <tr> 
          <td><a href="{{ URL::to('advance') }}"><i class="glyphicon glyphicon-circle-arrow-right fa-fw"></i>  Process Advance Salaries</a></td>
          <td><a href="{{ URL::to('payroll') }}"><i class="glyphicon glyphicon-circle-arrow-right fa-fw"></i>  Process Payroll</a></td> 
         <td><a href="{{ URL::to('email/payslip') }}"><i class="glyphicon glyphicon-envelope fa-fw"></i>  Email Payslips</a></td>      
        
        <td><a href="{{ URL::to('users/profile/'.Confide::user()->id ) }}"><i class="fa fa-user fa-fw"></i>  Profile</a></td>
        <td></td>
        </tr>

        <tr>
         <td><a href="{{ URL::to('users/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a></td>
         <td></td><td></td><td></td>
        </tr>
        

      </tbody>


    </table> -->
</div>
</div>

  </div>  



@stop
