var service = angular.module('RouterUtil', []);
service.factory('RouterUtil',  function() {
    function _callGet(router, params, $scope) {
        if(!params){
            params = {};
        }
        let dataResponse = {};
        $.ajax({
            type: 'GET',
            url: window.location.href,
            async: false,
            data: {
                'router': router,
                'params': params
            },
            dataType: 'json',
            contentType: 'application/json',
            success: function (data) {
                dataResponse = data;
            },
            error: function (data) {
                dataResponse = data;
            }
        });
        return dataResponse;
    }

    function _callPost(router, data) {
        var dataPost = new FormData();
        let formData = {};
        angular.forEach(data, function (att, index) {
            formData[index] = att;
        });
        dataPost.append('formData', JSON.stringify(formData));
        //Tratativa para arquivos de File
        var files = $('input[type="file"]');
        angular.forEach(files, function (file, index) {
            if(file.id && file.files.length > 0){
                dataPost.append(file.id, file.files[0], file.id);
            }
        });
        dataPost.append('router', router);
        let dataResponse = {};
        $.ajax({
            type: 'POST',
            url: window.location.href,
            async: false,
            data: dataPost,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (data) {
                dataResponse = data;
            },
            error: function (data) {
                dataResponse = data;
            }
        });
        return dataResponse;
    }

    return {
        callGet: _callGet,
        callPost: _callPost,
    }
});