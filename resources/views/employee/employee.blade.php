<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Employee</title>
    <link rel="stylesheet" href="/css/app.css">
    <script src="{{ mix('js/app.js') }}"></script>
    <script type="text/javascript" src="/js/bootstrap.js"></script>
    <script type="text/javascript" src="/js/angular.min.js"></script>
    <script type="text/javascript" src="/js/employee.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#employeeCreateForm").css("display","none");
            $("#employeeModifyForm").css("display","none");
            $("#employeeDetail").css("display","none");
            
        }); 

        function showEmployeeForm(){
            $("#employeeCreateForm").css("display","block");
            $("#employeeModifyForm").css("display","none");
            $("#employeeDetail").css("display","none");
        }

        function addEmployee(employee){
            console.log(employee);
            //return 0;
            $.ajax({
                dataType:'json',
                type:'POST',
                url:'/store-employee',  
                data:{
                'employee':employee
                },
                success:function(result){     
                console.log(result);
                if(result!=null){
                
                }
                },
                error: function( req, status, err ) {
                console.log( 'wrong->', status, err );
                alert(err);
                }
            });
        }

    </script>
</head>
<body class="bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Employee</div>
                    <div class="panel-body" ng-app="employeeModule" id="EmployeeControllerID"  ng-controller="EmployeeController">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="javascript:void(0)" onclick="showEmployeeForm();">Create New</a>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form id="employeeCreateForm" method="POST" action="/store-employee">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="employeeName" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" id="employeeName" value="@{{employeeNewData.name}}" ng-model="employeeNewData.name" placeholder="Employee name">
                                        </div>
                                    </div>
                                    <fieldset class="form-group">
                                        <div class="row">
                                        <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                                        <div class="col-sm-10">
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="maleGender" ng-model="employeeNewData.gender" value="Male" checked>
                                            <label class="form-check-label" for="maleGender">
                                                Male
                                            </label>
                                            </div>
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="femaleGender" ng-model="employeeNewData.gender" value="FemaleMale" checked>
                                            <label class="form-check-label" for="femaleGender">
                                                Female
                                            </label>
                                            </div>
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="otherGender" ng-model="employeeNewData.gender" value="Other">
                                            <label class="form-check-label" for="otherGender">
                                                Other
                                            </label>
                                            </div>
                                
                                        </div>
                                        </div>
                                    </fieldset>

                                    <div class="form-group row">
                                        <label for="department" class="col-sm-2 col-form-label">Department</label>
                                        <div class="col-sm-10">
                                        <select id="department" name="department" class="form-control" ng-model="employeeNewData.department" >
                                            <option value="" selected>Select Department</option>
                                            <option value="Finance">Finance</option>
                                            <option value="Accounts">Accounts</option>
                                            <option value="HR Manager">HR Manager</option>
                                        </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="city" class="col-sm-2 col-form-label">City</label>
                                        <div class="col-sm-10">
                                        <select id="city" name="city" class="form-control" ng-model="employeeNewData.city" >
                                            <option value="" selected>Select City</option>
                                            <option value="Dhaka">Dhaka</option>
                                            <option value="Rangpur">Rangpur</option>
                                            <option value="Rajshahi">Rajshahi</option>
                                        </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label  class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10 ">
                                        <button type="submit" class="btn btn-primary" >Create Employee</button>
                                        </div>
                                    </div>
                                </form>

                                <form id="employeeModifyForm" method="POST" action="/modify-employee">
                                    @csrf
                                    <input type="hidden" name="id" ng-model="employeeModifyData.id" value="@{{employeeModifyData.id}}">
                                    <div class="form-group row">
                                        <label for="employeeName" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" id="employeeName" value="@{{employeeModifyData.name}}" ng-model="employeeModifyData.name" placeholder="Employee name">
                                        </div>
                                    </div>
                                    <fieldset class="form-group">
                                        <div class="row">
                                        <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                                        <div class="col-sm-10">
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="maleGender" ng-model="employeeModifyData.gender" value="Male" checked>
                                            <label class="form-check-label" for="maleGender">
                                                Male
                                            </label>
                                            </div>
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="femaleGender" ng-model="employeeModifyData.gender" value="FemaleMale" checked>
                                            <label class="form-check-label" for="femaleGender">
                                                Female
                                            </label>
                                            </div>
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="otherGender" ng-model="employeeModifyData.gender" value="Other">
                                            <label class="form-check-label" for="otherGender">
                                                Other
                                            </label>
                                            </div>
                                
                                        </div>
                                        </div>
                                    </fieldset>

                                    <div class="form-group row">
                                        <label for="department" class="col-sm-2 col-form-label">Department</label>
                                        <div class="col-sm-10">
                                        <select id="department" name="department" class="form-control" ng-model="employeeModifyData.department" >
                                            <option value="" selected>Select Department</option>
                                            <option value="Finance">Finance</option>
                                            <option value="Accounts">Accounts</option>
                                            <option value="HR Manager">HR Manager</option>
                                        </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="city" class="col-sm-2 col-form-label">City</label>
                                        <div class="col-sm-10">
                                        <select id="city" name="city" class="form-control" ng-model="employeeModifyData.city" >
                                            <option value="" selected>Select City</option>
                                            <option value="Dhaka">Dhaka</option>
                                            <option value="Rangpur">Rangpur</option>
                                            <option value="Rajshahi">Rajshahi</option>
                                        </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label  class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10 ">
                                        <button type="submit" class="btn btn-primary" >Modify Employee</button>
                                        </div>
                                    </div>
                                </form>

                                <div id="employeeList" class="row table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Gender</th>
                                                <th scope="col">Department</th>
                                                <th scope="col">City</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="employee in allEmployee">
                                                <td>@{{employee.name}}</td>
                                                <td>@{{employee.gender}}</td>
                                                <td>@{{employee.department}}</td>
                                                <td>@{{employee.city}}</td>
                                                <td> <a href="javascript:void(0)" ng-click="modifyEmployee(employee)">Edit</a>  | <a href="javascript:void(0)" ng-click="detailEmployee(employee)" >Details</a>  | <a href="javascript:void(0)" ng-click="deleteEmployee(employee)">Delete</a> </td>
                                            </tr>
                                          
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="row" id="employeeDetail" >
                                    
                                    <label class="col-sm-12 col-form-label">Emloyee Details</label>

                                    <div class="form-group col-md-12">
                                        <div class="col-md-12 col-sm-12">
                                            Name  :  @{{employeeDetailData.name}}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="col-md-12 col-sm-12">
                                            Gender : @{{employeeDetailData.gender}}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="col-md-12 col-sm-12">
                                            Department: @{{employeeDetailData.department}}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="col-md-12 col-sm-12">
                                            City :  @{{employeeDetailData.city}}
                                        </div>
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>