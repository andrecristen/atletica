var app = angular.module('app', ['ngSanitize', 'RouterUtil']);
app.controller('MainController', function($scope, RouterUtil, $sce, $q, $compile) {
    var vm = this;

    /**
     *  ---------------------------- GERAL ------------------------------
     */

    //Armazena as Tabs Abertas
    $scope.tabs = [];

    vm.selectMenu = function (router) {
        try{
            closeMessages(false);
            onOverlay();
            let data = RouterUtil.callGet(router, {}, $scope);
            if(!data.type){
                var dataMessage = {
                    typeMessage: 'error',
                    message: 'Não localizado formato da resposta.',
                };
                processaDataMessage(dataMessage);
                offOverlay();
                return;
            }
            if(!existsRouterTab(router)){
                $scope.tabs.push({title: data.title, router: router});
            }
            setTimeout(function () {
                selectTab(router);
                switch (data.type) {
                    case 'grid':
                        processaDataGrid(router, data, 1);
                        break;
                    default:
                }
                offOverlay();
                $scope.$apply();
            },200);
        }catch (e) {
            offOverlay();
        }
    };

    function selectTab(router) {
        $("#"+router+"-tab").click();
        $("#content-"+router).addClass('show active');
    }

    vm.clickTab = function(tab, event){
        //Se clicou com o botão do meio do mouse fecha
        if(event.button  == 1){
            vm.closeTab(tab.router);
            event.stopImmediatePropagation();
            event.stopPropagation();
        }
    };

    vm.closeTab = function(router) {
        let indexClose = -1;
        angular.forEach($scope.tabs, function (item, index) {
            if(indexClose > -1){
                return;
            }
            if(item.router == router){
                indexClose = index;
            }
        });
        if(indexClose > -1){
            $scope.tabs.splice(indexClose, 1);
            reiniciaGrid(router);
        }
        if($scope.tabs.length > 0){
            setTimeout(function () {
                selectTab($scope.tabs[0].router);
                $scope.$apply();
            },200);
        }
    };

    function onOverlay() {
        $("#overlay").show();
    }

    function offOverlay() {
        $("#overlay").hide();
    }

    /**
     *  ---------------------------- GRID ------------------------------
     */

    function reiniciaGrid(router){
        $scope.rows[router] = {};
        $scope.rowsSelecteds[router] = {};
        $scope.countRowsSelecteds[router] = {};
        $scope.actions[router] = {};
        $scope.columns[router] = {};
        $scope.filters[router] = {};
        $scope.filterSelected[router] = {};
        $scope.pageAtual[router] = {};
        $scope.countPages[router] = {};
        $scope.countRows[router] = {};
    }

    //Armazena os dados dos grid abertos
    $scope.rows = {};
    $scope.rowsSelecteds = {};
    $scope.countRowsSelecteds = {};
    $scope.actions = {};
    $scope.columns = {};
    $scope.filters = {};
    $scope.filterSelected = {};
    $scope.pageAtual = {};
    $scope.countPages = {};
    $scope.countRows = {};

    vm.reloadGrid = function(router, page){
        onOverlay();
        if(!page){
            page = 1;
        }
        let data = RouterUtil.callGet(router, {page: page, filters: $scope.filters[router]}, $scope);
        if(!data.type){
            var dataMessage = {
                typeMessage: 'error',
                message: 'Erro ao realizar reload da consulta, não localizado formato da resposta.',
            };
            processaDataMessage(dataMessage);
            offOverlay();
            return;
        }else if(data.type == 'message'){
            processaDataMessage(data);
            offOverlay();
            return;
        }
        processaDataGrid(router, data, page);
        offOverlay();
    };

    vm.apllyFilter = function(event, router){
        if(event.which === 13) {
            vm.reloadGrid(router, 1);
        }
    };

    vm.pageFirst = function(router){
        if($scope.pageAtual[router] == 1){
            return;
        }
        vm.reloadGrid(router, 1);
    };

    vm.pageLast = function(router){
        if($scope.pageAtual[router] >= $scope.countPages[router]){
            return;
        }
        vm.reloadGrid(router, $scope.countPages[router]);
    };

    vm.pageAnterior = function(router){
        if($scope.pageAtual[router] == 1){
            return;
        }
        vm.reloadGrid(router, ($scope.pageAtual[router]- 1));
    };

    vm.pageSelecionada = function(router, event){
        if(event.which === 13) {
            if($scope.pageAtual[router] > $scope.countPages[router]){
                return;
            }
            vm.reloadGrid(router, ($scope.pageAtual[router]));
            event.preventDefault();
        }
    };

    vm.pageProxima = function(router){
        if($scope.pageAtual[router] >= $scope.countPages[router]){
            return;
        }
        vm.reloadGrid(router, ($scope.pageAtual[router] + 1));
    };

    vm.closeFilter = function (filter, router) {
        angular.forEach($scope.columns[router], function (item, index) {
            if(item.content == filter){
                if($scope.filters[router]){
                    if($scope.filters[router][filter]){
                        delete $scope.filters[router][filter];
                        setTimeout(function () {
                            applyMasks();
                        },200)
                    }
                }
            }
        });
    };

    vm.openFilter = function (router) {
        let filter = $scope.filterSelected[router];
        angular.forEach($scope.columns[router], function (item, index) {
            if(item.content == filter){
                if(!$scope.filters[router]){
                    $scope.filters[router] = {};
                }
                if(!$scope.filters[router][filter]){
                    $scope.filters[router][filter] = {};
                }
                $scope.filters[router][filter] = item;
                setTimeout(function () {
                    applyMasks();
                },200)
            }
        });
        $scope.filterSelected[router] = undefined;
    };

    function processaDataGrid(router, data, pageAtual){
        $scope.rows[router] = data.data;
        angular.forEach(data.fields.actions, function (item, index) {
            item.routerOrigem = router;
        });
        $scope.actions[router] = data.fields.actions;
        $scope.columns[router] = data.fields.columns;
        $scope.rowsSelecteds[router] = [];
        $scope.countRowsSelecteds[router] = 0;
        $scope.pageAtual[router] = pageAtual;
        $scope.countPages[router] = data.pages;
        $scope.countRows[router]  = data.count;
        setTimeout(function () {
            //resizableGrid($('table'));
        }, 1400);
        setTimeout(function () {
            $scope.$apply();
            $("table").colResizable({
                liveDrag:true
            });
        }, 200);
    }

    vm.selectRow = function(rowIndice, router, rowData){
        //Ta deselecionando
        if($scope.rowsSelecteds[router][rowIndice]){
            $scope.rowsSelecteds[router] = {};
            $scope.countRowsSelecteds[router] = 0;
        }else{
            $scope.rowsSelecteds[router] = {};
            $scope.rowsSelecteds[router][rowIndice] = {
                selected: true,
                data: rowData
            };
            $scope.countRowsSelecteds[router] = 1;
        }
    };


    function existsRouterTab(router) {
        let exists = false;
        angular.forEach($scope.tabs, function (item, index) {
            if(exists){
                return;
            }
            if(item.router == router){
                exists = true;
            }
        });
        return exists;
    }

    /**
     *  ---------------------------- FORMS ------------------------------
     */

    //Armazena os dados dos forms abertos
    $scope.form = {};
    $scope.dataForm = {};

    vm.callAction = function (action) {
        try{
            onOverlay();
            let row = {};
            if(action.isRow){
                row = $scope.rowsSelecteds[action.routerOrigem];
            }
            let data = RouterUtil.callGet(action.router, {row: row}, $scope);
            switch (data.type) {
                case 'form':
                    setTimeout(function () {
                        processaDataForm(data, action.router, action.routerOrigem);
                        offOverlay();
                        $scope.$apply();
                    },200);
                    break;
                case 'message':
                    setTimeout(function () {
                        processaDataMessage(data, action.router, action.routerOrigem);
                        offOverlay();
                        $scope.$apply();
                    },200);
                    break;
                default:
                    var dataMessage = {
                        typeMessage: 'error',
                        message: 'Resposta recebida não tratada.',
                    };
                    processaDataMessage(dataMessage);
                    offOverlay();
                    return;
                    break;
            }
            if(!data.type){
                var dataMessage = {
                    typeMessage: 'error',
                    message: 'Sem tratamento para o formato da resposta.',
                };
                processaDataMessage(dataMessage);
                offOverlay();
                return;
            }
        }catch (e) {
            offOverlay()
        }
    };

    $scope.trustedHtml = function (plainText) {
        return $sce.trustAsHtml(plainText);
    };

    function processaDataForm(data, router, routerOrigem) {
        $scope.form.title = data.title;
        if(data.data.maximized){
            $scope.form.maximizedClass = 'modal-dialog-full';
            $scope.form.maximizedClassContent = 'modal-content-full';
        }
        $scope.form.router = router;
        $scope.form.routerOrigem = routerOrigem;
        //Adiciona tudo que recebemos no nosso dataForm
        angular.forEach(data.data.params, function (value, name) {
            $scope[name] = value;
        });
        $scope.data = {};
        angular.forEach(data.data.form, function (value, name) {
            $scope.data[name] = value;
        });
        //Tem algum controller externo? Adiciona eles e compila o HTML
        if(data.controllers && data.controllers.length > 0) {
            var controllers = data.controllers;
            var last = controllers.length;
            angular.forEach(controllers, function (controller) {
                var controllerPath = controller.path + '.js';
                var script = document.createElement('script');
                script.src = controllerPath;
                script.onload = function () {
                    last--;
                    if (last == 0) {
                        var html = $compile(data.html)($scope);
                        appendHtmlOnModal(html);
                    }
                };
                document.head.appendChild(script);
            });
        //Não tem os controlles só compila o HTML
        } else {
            var html = $compile(data.html)($scope);
            appendHtmlOnModal(html);
        }
        var buttons = '';
        angular.forEach(data.buttons, function (button) {
            buttons += '<button ng-click="'+button.function+'" type="button" class="btn btn-sm '+button.class+'">'+button.title+'</button>';
        });
        var buttons = $compile(buttons)($scope);
        appendHtmlOnModalFooter(buttons);
        openModal();
        if(data.data.isView){
            $('#append-modal').find('input, textarea, button, select').attr('disabled','disabled');
        }
    }

    function openCloseModal() {
        $("#modal").modal('toggle');
    }

    function openModal() {
        $('#modal').modal('show')
    }

    function closeModal() {
        $('#modal').modal('hide')
    }

    function appendHtmlOnModal(html) {
        $("#append-modal").empty();
        if(html){
            $("#append-modal").append(html);
        }else{
            var dataMessage = {
                typeMessage: 'error',
                message: 'Erro ao renderizar form, reinicie o sistema.',
            };
            processaDataMessage(dataMessage);
        }
    }

    function appendHtmlOnModalFooter(html) {
        $("#append-modal-actions").empty();
        if(html){
            $("#append-modal-actions").append(html);
        }else{
            var dataMessage = {
                typeMessage: 'error',
                message: 'Erro ao renderizar ações od form, reinicie o sistema.',
            };
            processaDataMessage(dataMessage);
        }
    }

    vm.cancelar = function () {
        $scope.form = {};
        $scope.data = {};
        closeModal();
    };

    vm.confirmar = function () {
        onOverlay();
        let message = validarForm();
        if(message){
            offOverlay();
            var dataMessage = {
                typeMessage: 'info',
                message: message,
            };
            processaDataMessage(dataMessage);
            return;
        }
        var data = RouterUtil.callPost($scope.form.router, $scope.data);
        offOverlay();
        processaDataMessage(data, $scope.form.router, $scope.form.routerOrigem);
    };

    /**
     * Monta as mensagens de erro com base nos erros dos inputs
     *
     * @returns {boolean}
     */
    function validarForm() {
        let message = false;
        angular.forEach($scope.modal.$$element[0].elements, function (value, index) {
            var elements = angular.element(value);
            angular.forEach(elements, function (element, index) {
                if(element.validationMessage){
                    if(!message){
                        message = '';
                    }
                    message += "O campo "+element.id+" está incorreto: "+element.validationMessage+"</br>";
                }
            });
        });
        return message;
    }

    /**
     * Message
     */
    function  processaDataMessage(data, router, routerGrid){

        switch (data.typeMessage) {
            case 'success':
                closeModal();
                Swal.fire({
                    icon: 'success',
                    title: data.message,
                    showConfirmButton: false,
                    timer: 2000
                });
                if(routerGrid){
                    vm.reloadGrid(routerGrid);
                }
                break;
            case 'error':
                Swal.fire({
                    icon: 'error',
                    title: 'Atenção!',
                    html: data.message,
                });
                break;
            case 'confirm':
                Swal.fire({
                    title: 'Atenção!',
                    html: data.message,
                    icon: 'question',
                    showCancelButton: true,
                    reverseButtons: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirmar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.value) {
                        var data = RouterUtil.callPost(router, $scope.rowsSelecteds[routerGrid]);
                        processaDataMessage(data, router, routerGrid);
                    }
                });
                break;
            case 'info':
                Swal.fire({
                    title: 'Atenção!',
                    icon: 'info',
                    html: data.message,
                });
                break;
        }
    }

});


