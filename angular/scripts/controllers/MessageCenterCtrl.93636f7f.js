app.controller("MessageCenterCtrl",["$scope","$sce","$rootScope","$timeout","Restangular","$translatePartialLoader","$translate","RestFullResponse","$location","$routeParams",function($scope,$sce,$rootScope,$timeout,Restangular,$translatePartialLoader,$translate,RestFullResponse,$location,$routeParams){function getMessage(){$scope.inbox=[],$scope.sent=[],$scope.message={},$scope.messageSelected=!1,Restangular.one("account").customGET("message",{sort:"-created"}).then(function(messages){if($scope.$emit("loading_finished"),$scope.messages=messages,$rootScope.checkmessage=$scope.messages,angular.forEach(messages,function(value){value.body=value.body.replace(/<br>/g,"\r\n"),"Message To"==value.message_type?$scope.inbox.push(value):"Message From"==value.message_type&&$scope.sent.push(value)}),$scope.inbox.length){var temp="",index=-1;angular.forEach($scope.inbox,function(value,key){value.created>temp&&(temp=value.created,index=key)}),$scope.message=$scope.inbox[index],$scope.hasMessage=!0,$scope.inboxSelected=0,$scope.personid=$scope.inbox[index].person_id_sender}else $scope.hasMessage=!1;Restangular.one("account/person",$scope.personid).customGET().then(function(success){$scope.personDetail=success.plain(),$scope.files=$scope.personDetail.files,$scope.files&&($scope.filelength=$scope.files.length,$scope.files.length&&($scope.imageurl=$scope.files[0].path_external))});var testindex=0;$location.search()&&angular.forEach($scope.inbox,function(value,key){$scope.personid=$routeParams.person_id,value.message_id==$routeParams.message_id&&($scope.message=$scope.inbox[testindex],$scope.hasMessage=!0,$scope.inboxSelected=testindex),testindex+=1})}),Restangular.one("account/person",$scope.personid).customGET().then(function(success){$scope.personDetail=success.plain(),$scope.files=$scope.personDetail.files,$scope.filelength=$scope.files.length,$scope.files.length&&($scope.imageurl=$scope.files[0].path_external)})}$scope.clearMessage=function(){$rootScope.floatingMessage=[]};var msg;$scope.sendMessage={},$("#message-tabs .menu-tabs .item").tab({context:$("#message-tabs")}),getMessage(),$scope.messageDetail=function(message,index,identifier){message?$scope.hasMessage=!0:$scope.hasMessage=!1,message.body=message.body.replace(/<br>/g,"\r\n"),"inbox"==identifier?($scope.inboxSelected=index,$scope.sentSelected=null,$scope.personid=$scope.inbox[index].person_id_sender):"sent"==identifier&&($scope.sentSelected=index,$scope.inboxSelected=null,$scope.personid=$scope.sent[index].person_id_receiver),$scope.message=message,Restangular.one("account/person",$scope.personid).customGET().then(function(success){$scope.personDetail=success.plain(),$scope.files=$scope.personDetail.files,$scope.files&&$scope.files.length>0&&($scope.imageurl=$scope.files[0].path_external)})},$scope.messageDelete=function(){msg={loading:!0,loading_message:"in_progress"},$rootScope.floatingMessage=msg,$scope.message.id&&Restangular.one("account/message",$scope.message.id).customDELETE().then(function(success){getMessage(),msg={header:"message_center_delete_success"},$rootScope.floatingMessage=msg,$scope.hideFloatingMessage()},function(failed){msg={header:failed.data.message},$rootScope.floatingMessage=msg,$scope.hideFloatingMessage()})},$scope.openModalById=function(id){$(".ui.modal#"+id).modal("show")},$scope.replyPrefill=function(){$scope.sendMessage={subject:"Re: "+$scope.message.subject,body:"\n<<<<<<<<<<<<<<<<< Original Message >>>>>>>>>>>>>>>>>\n"+$scope.message.body}},$scope.send=function(){msg={loading:!0,loading_message:"in_progress"},$rootScope.floatingMessage=msg,$scope.sendMessage.person_id=$scope.message.person_id_sender,$scope.sendMessage.body=$scope.sendMessage.body.replace(/(\r\n|\n|\r)/gm,"<br>"),Restangular.one("account/message").customPOST($scope.sendMessage).then(function(){$scope.sent.push($scope.sendMessage),$scope.sendMessage={},msg={header:"message_center_sent_success"},$rootScope.floatingMessage=msg,$scope.hideFloatingMessage()},function(failed){msg={header:failed.data.message},$rootScope.floatingMessage=msg,$scope.hideFloatingMessage()})},$scope.$on("composed_new_message",function(){getMessage()})}]);