(function(){
    var app = angular.module('employeeModule', [ ]);

    console.log("anguler");

    app.controller("EmployeeController", [ '$scope', '$http', function($scope, $http) {
        
        console.log("anguler");

        $scope.items = [ ];
        $scope.allEmployee=[];
        $http.get('/employee/all').success(function(data) {
            $scope.allEmployee = data;
            //console.log(data);
        });

		
		$scope.saletemp = [ ];
        $scope.newsalesaletemp = { };
        var saleItem=[];
        var totalSaleAmount=0;

        $scope.employeeNewData=[];
        $scope.employeeDetailData=[];
        $scope.employeeModifyData=[];
        $scope.addEmployee=function(employeeData){
            console.log(employeeData);
            /*setTimeout(function(){ 
                $scope.$apply();
                addEmployee(employeeData);
            });*/
            $http({
                method: 'POST',
                dataType: "JSON",
                url: '/store-employee',
                data: {
                    'employee':employeeData
                    }
            })
            .success(function (result) {
                console.log('true',result);
            })
            .error(function(){
                console.log('false');
            });
        }

        $scope.deleteEmployee=function(employeeData){
            if(confirm("Do you want to delete "+employeeData.name)){
                $http({
                    method: 'GET',
                    dataType: "JSON",
                    url: "/delete-employee/"+employeeData.id,
                    data: {
                        'employee':employeeData
                        }
                })
                .success(function (result) {
                    console.log('true',result);
                    if(result!="false"){
                        $("#employeeCreateForm").css("display","none");
                        $("#employeeModifyForm").css("display","none");
                        $("#employeeDetail").css("display","none");

                        $scope.allEmployee = result;

                    }
                })
                .error(function(){
                    console.log('false');
                });
            }
        }

        
        $scope.detailEmployee=function(employeeData){
            $("#employeeDetail").css("display","block");
            $("#employeeCreateForm").css("display","none");
            $("#employeeModifyForm").css("display","none");
                        
            console.log(employeeData);
            $scope.employeeDetailData=employeeData;
        }
        $scope.modifyEmployee=function(employeeData){
            console.log(employeeData);
            $("#employeeDetail").css("display","none");
            $("#employeeCreateForm").css("display","none");
            $("#employeeModifyForm").css("display","block");
            $scope.employeeModifyData=employeeData;
        }
        
    }]);
})();