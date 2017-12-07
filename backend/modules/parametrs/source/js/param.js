var adminModule = angular.module('Admin', []);

adminModule .controller('ParametrsController', function($scope,$http) {
    var Entity = this;
    $scope.show = true;
    Entity.count;
    Entity.id;
    $scope.parametrs_list = [];
    Entity.url = window.location.href.split('/')[window.location.href.split('/').length - 1];

    Entity.init = function (id) {
        if($("#parametrs-field_type_id").val() != 3){
            $("#values").css("display","block")
        }
        if(id){
            $http({
                method: 'POST',
                url: '/admin/parametrs/default/parametr-values',
                data: "id=" + id + '&_csrf=' + yii.getCsrfToken(),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {

                if (response.data != 0) {
                    $scope.parametrs_list = response.data;
                }

            });
        }
        Entity.id = id;

    }

    Entity.deleteValue = function (val_id)
    {
        if(val_id){
            $http({
                method: 'POST',
                url: '/admin/parametrs/default/delete-value',
                data: 'value_id=' + val_id+"&param_id="+Entity.id,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {
                $scope.parametrs_list = response.data;

            });
        }
        else
        {
            // index = index - 1;
            // console.log(index);
            // console.log($scope.parametrs_list[index]);
            // $scope.parametrs_list[index] = undefined;
            // $scope.parametrs_list.splice(index, 1);
            // console.log($scope.parametrs_list);
        }

    }
    Entity.addValue = function ()
    {
        var newRow = {id: "", value: ""}
        $scope.parametrs_list[$scope.parametrs_list.length] = newRow;
    }

})

