function countryList(){
	
	this.prepareCountryList = function(){

		var countryListJSON = countryJSON,
		optionList = '<option value="">Country List</option>';	
		
		$.each(countryListJSON,function(key,val){
			optionList+='<option value="'+val.country_id+'">'+val.country+'</option>';
		});	
		
		$('body .countryList').html("").html(optionList);
		$('body').delegate(".countryList","change",function(){
			if($(this).val() != ""){												
			var objStateList = new statList(),
			objCityList = new cityList(),
			countryID = $(this).val();
			objStateList.prepareStateList({"countryID":countryID});
			objCityList.prepareCityList({"countryID":countryID});

			}
		});
	}
	
}
function statList(){
	this.prepareStateList = function(params){
		var countryID = params.countryID,
		optionList = '<option value="">State List</option>';
		$.ajax({
			url:"bridges/states/func_getAllStatesByCuntry.php",
			data: params,
			dataType: "json",
			success:function(resp){ 
			
			console.log(resp);
			
				if(resp.length > 0){
					$.each(resp,function(key,val){
						optionList+='<option value="'+val.state_id+'">'+val.state+'</option>';
					});	
				}
			$('body .stateList').html("").html(optionList);

			$('body').delegate(".stateList","change",function(){
				if($(this).val() != ""){												
				var objCityList = new cityList(),
				stateID = $(this).val();
				objCityList.prepareCityList({"stateID":stateID});
				}
			});

			},
			error:function(e){
				console.log("state AJAX Error",e)
			}
		});
	}	
}
function cityList(){

	this.scase = "";
	this.prepareCityList = function(params){
		var dataObj = {},
			optionList = '<option value="">City List</option>';
		if(params.stateID != undefined && params.stateID != 'undefined'){
			this.scase = "state";
		}else if(params.countryID != undefined && params.countryID != 'undefined'){
			this.scase = "country";
		}
		switch(this.scase){
			case "state":
				dataObj.stateID = params.stateID;
			break;
			case "country":
				dataObj.countryID = params.countryID;
			break;
			default:
				dataObj.countryID = 82;
			break;
		}

		$.ajax({
			url:"bridges/city/func_getCityListByCountryState.php",
			data: dataObj,
			dataType: "json",
			cache: true,
			success: function(resp){ 
			
			if(resp.length > 0){
				$.each(resp,function(key,val){
					optionList+='<option value="'+val.city_id+'">'+val.city+'</option>';
				});	
			}
			$('body .cityList').html("").html(optionList);

			},
			error:function(e){
				console.log("city AJAX Error",e)
			}
		});

	}
}
function existingServiceList() {
	
	this.preparServiceList = function() {
		
		console.log(servicesJSON);

		var serviceListJSON = servicesJSON,
		optionList = '<option value="">Service List</option>';	
		
		$.each(serviceListJSON,function(key,val){
			optionList+='<option value="'+val.service_id+'">'+val.service_name+'</option>';
		});	
		
		$('body .serviceList').html("").html(optionList);
		
	}
	
}
$(document).ready(function(){

	if($(".dashBlocks").length >= 1){
		prepareServicesStatusList();
		var countryListDropDowns = new countryList();
		countryListDropDowns.prepareCountryList();		

		var objStateList = new statList(),
		objServiceList = new existingServiceList();
		objStateList.prepareStateList({"countryID":"82"});
		objServiceList.preparServiceList();
		
	}

	$(".formInter").delegate(".blockHead","click",function(){
		var _self = $(this),
		_detailBlockID = _self.attr("id"),
		allBlocks = $(".formInter .blockDetail, .formInter  li"),
		_detailBlock = $("."+_detailBlockID),
		_parentLI = _self.parents("li");
		
		allBlocks.removeClass("active");
		_parentLI.addClass("active");
		_detailBlock.addClass("active").find("h2:first").attr("tabindex","-1").focus();
	});

	if($('.services .serviceListWrapper').length == 1){
		servicesList();	
	}
	if($(".profileUserDetail").length > 0){
		imageUploadRead();
	}
	if($("#serviceSearchResult").length == 1){
			$("#serviceSearchResult").delegate(".sAction a","click",function(evt){
				
				evt.preventDefault();
				var _URL = $(this).attr("href");

				overlay({"url":_URL, "overlyTemplate":"#tmpl_hireTemplate" ,"context":$(this).context,"isForce":true});
			});
	}
	
	if($('.services').length == 1){
			$(".services li.active").find("h3").attr("tabindex","-1").focus()
	}

	if($('.nonLogin').length == 1){
		userRegistration();	
	}
	if($("#postService").length == 1){
			postedServiceList();
	}
	if($(".countryMgtWraper").length == 1){
		
		$("#formAddCountry").bind("submit",function(){
		
			var countryField = $("#txtCountry").val();
			if(countryField =="" ){
				alert("Country name cant be blank");			
				$("#txtCountry").focus();			
				return false;
			}								
		
		});
		
		$(".countryMgtWraper").delegate("#selectCountry","change",function(){

			var _selectedOption = $("option:selected",$(this)),
			_selfval = $(this).val();

			if(_selfval != ""){
				$("#txtCountry").val(_selectedOption.text());
				$("#txtCountryShortName").val(_selectedOption.attr("value2"));			
				
			}else{
				$("#txtCountry,#txtCountryShortName").val("");
			}
			
		})
	}
	if($(".pageContent,.blockDetail").length > 0){
		//default focus
		setTimeout(function(){ $(".pageContent, .blockDetail").find("h2:first").attr("tabindex","-1").focus(); }, 400);	
	}
	if($(".stateMgtWraper").length == 1){
		
		$(".stateMgtWraper").delegate("#selectCountry","change",function(){
			var countrID = $(this).val(),
			stateList = getStateList(countrID),
			stListTemp = '<option value="" data-state="">Add New State / Select to Update</option>';
			$.each(stateList,function(key,val){
					stListTemp += '<option value="'+val.state_id+'" data-state="'+val.state+'">'+val.state+'</option>';			  
			});
			
			$("#stateName").val("");
			$("#selectState").html(stListTemp);
		});

		$(".stateMgtWraper").delegate("#selectState","change",function(){
																	   
			var stateName = $("#selectState option:selected").attr("data-state");
			
			$("#stateName").val("").val(stateName);
		});

		
		//message Disapear call
		if($(".message span").length > 0){
			setTimeout('timeout_trigger()', 5000);
		}

	}
	$(".buttonContainer").delegate("#canccelAction","click",function(){		  
		location.reload();
	});
	$("#searchResults").delegate("#okBtn","click",function(){
		$('.confirmMsg').remove();											
	});
	$("#postServiceList").delegate(".enable, .disable","click",function(){
		
		var _self = $(this)
		_thisClass = (_self.hasClass("enable"))?"disable":"enable",
		psID = _self.attr("btnVal");

		var url = "bridges/services/func_setServiceStatus.php";
			$.ajax({
			  type: "GET",		   
			  url: url,
			  async: false,
			  data: {"id" : psID, "status" : _thisClass},
			  dataType: "json",
			  success: function(Response) {

				if(Response.service_status == 0){
					_self.attr("href","#enable").addClass("disable").removeClass("enable");
				}else{
					_self.attr("href","#disable").addClass("enable").removeClass("disable");			
				}

			  }
			});
		
	});
		
});

function getStateList(cntID){
	var jsonstateList = stateListJSON.stateList,
	tempArrState = new Array;	
	for(var t= 0 ; t < jsonstateList.length ; t++){
			if(jsonstateList[t].country_id == cntID)
			tempArrState.push(jsonstateList[t]);
	}
	return tempArrState;
}

function servicesList(){
	
	var jsonServices = {"services":jQuery.parseJSON($("#servicesList").text())};

	$('.services .serviceListWrapper').html("");
	$('#tmpl_servicesList').tmpl(jsonServices).appendTo('.services .serviceListWrapper');		
	$(".formWraper input[type='text']").val("");
	
	$(".formWraper").delegate("form#addService","submit",function(evt){
																  
		if($.trim($("input#addService").val()) == ""){
			//showInlineErrorMessage("Enter Service Title","input#addService");	
			alert("Enter Service Title");
			$("input#addService").focus();
			return false;
		}
		if($.trim($("input#addServiceDesc").val()) == ""){
			//showInlineErrorMessage("Enter Service Description","input#addServiceDesc");	
			alert("Enter Service Description");
			$("input#addServiceDesc").focus();
			return false;			
		}

	});
	$(".services .addservice").delegate(".edit, .cancelEdit","click",function(evt){
		evt.preventDefault();	
		if($(this).attr("class") == 'edit'){
		var _parent = $(this).parents("td"),
		_rowData = $.parseJSON(_parent.find(".rowData").text());
				
			$(".addservice #addService").val(_rowData.service_name);
			$(".addservice #addServiceDesc").val(_rowData.service_desc);
			$(".addservice #editServiceID").val(_rowData.service_id);
			$(".addservice #sbmtAddService").val("SAVE CHANGES");		
		}
		else{
			$(".addservice #addService, .addservice #addServiceDesc, .addservice #editServiceID").val("");
			$(".addservice #sbmtAddService").val("ADD SERVICE");					
		}
		$(".addservice #addService").focus();
		
	});
	
}
function userRegistration(){
		$("#userRegistration").delegate("#genUserName","focusout",function(){
		
			var _self = $(this),
				userval = _self.val();
			
			if(userval != "" && userval.length > 3){
				$.ajax({
					url: 'bridges/users/func_getUserStatus.php',
					type: 'POST',
					dataType: "json",
					data: {
						"userName": userval         
					},
					success: function(resp){
						if(resp.exists == '100' && resp.status == 'exists'){
							_self.addClass('available').removeClass('not-available');
						}
						
						if(resp.exists == '200' && resp.status == 'dont-exists'){
							_self.addClass('not-available').removeClass('available');
						}
						$("#hdn_successSubmit").val(resp.exists);						
					},
					error : function(ere){
						console.log(ere);
					} 
				});	
			}
			else{
					_self.removeClass("available, not-available");
				}
			
		});
}

function confirmDealProc(dealConfirmResp){
	jsonServices = {};
	$('.higheredList').html("");
	$('#tmpl_servicesDealConfirmMsg').tmpl(jsonServices).appendTo('.higheredList');
	setTimeout(function(){
		$(".confirmMsg li:first").attr("tabindex",-1).focus();
	}, 200);
	//setTimeout('timeout_trigger()', 5000);
}

function postedServiceList(){
	var jsonServices = {"postedServices":jQuery.parseJSON($("#postedServiceData").val())};
	console.log(jsonServices);

	$('.services .postService .serviceList').html("");
	$('#tmpl_nonPostedServicesList').tmpl(jsonServices).appendTo('.services .postService .serviceList');		

	$('.services .postService .rightCol').html("");
	$('#tmpl_postedServicesList').tmpl(jsonServices).appendTo('.services .postService .rightCol');		
/*	*/
//tmpl_postedServicesList		

	$("body").delegate("#addServicetoList","click",function(evt){

		evt.preventDefault();																	

		var addServices = $(".leftCol .serviceList input[name='servicesList']:checked"),
		serviceArr = [],
		tmpbj = {},thisserviceName="",thisserviceDesc="";
		

		if(addServices.length > 0){
			$.each(addServices,function(key2,val2){
										
				var chkVal = $(val2).val(),
				thisserviceName 	= $("#labelID"+chkVal).text(),
				thisserviceDesc 	= $("#serviceDetails"+chkVal).text();									
				
				$("#servicesList"+chkVal).closest("li").remove();
				
				tmpbj.service_id = null;
				tmpbj.serviceID = $(val2).val();
				tmpbj.service_name = thisserviceName;
				tmpbj.service_desc = thisserviceDesc;
				tmpbj.price = "";
				tmpbj.serviceunit = "";
				tmpbj.servicetime = "";					
				tmpbj.comments = "";					
					serviceArr.push(tmpbj);
					tmpbj = {};
			});
	
			var jsonServices = {"postedServices":serviceArr};																	
			console.log(jsonServices);
			$('#tmpl_addNewServicesList').tmpl(jsonServices).appendTo('#postServiceList');
		}else{
				displayMessage("Please select any service from service list in left column");							
		}
	});
	
/*	$(".wantedServices").delegate("#searchSevices","keyup",function(evt){
	
	console.log(evt);
	
	});*/

}

function prepareSearchList(){
	var jsonSearchlist = {"searchServices":jQuery.parseJSON($("#searchServiceData").val())};
	console.log(jsonSearchlist);	

	$('.searchServices .postService .serviceList').html("");
	$('#serviceSearchResult').html("");
	$('#tmpl_serviceSearchResult').tmpl(jsonSearchlist).appendTo('#serviceSearchResult');		


}
function prepareContryList(countryJson){

	var countryLst = '<option value="">Add New Country / Select to Update</option>',
	countryObj = countryJson.countryList,
	countryName = countryJson.addCountry;
	
		for(var t=0 ; t < countryObj.length ; t++){
			var shortName = (countryObj[t].country_shortname == null)?"":countryObj[t].country_shortname;
			
			if(countryObj[t].country == countryName){
				countryLst += '<option value="'+countryObj[t].country_id+'" selected="selected" value2="'+shortName+'">'+countryObj[t].country+'</option>';
			} else {
				countryLst += '<option value="'+countryObj[t].country_id+'" value2="'+shortName+'">'+countryObj[t].country+'</option>';			
			}
		}
		$("#selectCountry").html("").append(countryLst);
}

function overlay(overlayObj){
					
		var _overlayObject = {"url":"",
		"overlyTemplate":"",
		"overlyTemplateData":{}},
		_overlayParent = $(".overlay");

			if(_overlayParent.is(":visible")){
				$("#close",_overlayParent).trigger("click");
			}
		
			$.extend( _overlayObject, overlayObj );
			
			if(_overlayObject.url !=""){
				$.ajax({
				  type: "POST",		   
				  url: _overlayObject.url,
				  async: false,
				  data: {"status" : ""},
				  dataType: "json",
				  success: function(Response) {
					$(_overlayObject.overlyTemplate).tmpl(Response).appendTo("body");
					/*
					if(_overlayObject.isForce){
						$(".overlay").addClass("force");
					}else{
						$(".overlay").removeClass("force");
					}*/
					_overlayParent.find(".overlayTitle").attr("tabindex","-1").focus();
				  },
				  error: function(e) {
						console.log(e);  
					}
				});
			}else{
					$(_overlayObject.overlyTemplate).tmpl(_overlayObject.overlyTemplateData).appendTo("body");					
			}
			
			$(".overlay").delegate("#close, #cancelDeal","click",function(){
				
				var _overlayParent = $(".overlay");
				
				$(".overlayCurtain").hide();
				_overlayParent.html("").hide();
				_overlayObject.context.focus();
			});
			
			$(".overlay").delegate("*","keyup",function(evt){
				console.log($(".overlay").hasClass("force"));
				if(!$(".overlay").hasClass("force") && evt.keyCode == 27) {
					$("#close",_overlayParent).trigger("click");
				}
				
			});
			
}
function imageUploadRead(){
	
	var reader = new FileReader();
	
	$(".profileUserDetail").delegate("input[type='file']","change",function(ev){
		var tmppath = URL.createObjectURL(ev.target.files[0]);
		$("#profileImg").attr('src',URL.createObjectURL(ev.target.files[0]));
	});	
}
function prepareServicesStatusList(){
	var statusListJSON = {}, serviceRequestJSON = {}, allExistingServiceJSON = {}, allCityJSON = {} ;
	statusListJSON = allServiceStausListJSON;
	serviceRequestJSON = allServiceRequestListJSON;
	
	if(statusListJSON.serviceStatusList.length > 0){
		$('#tmpl_serviceRatingStaut').tmpl(statusListJSON).appendTo('.ratings');				
		$('#tmpl_serviceFeedbackStaut').tmpl(statusListJSON).appendTo('.serviceFeedback');						
		
	}
	if(serviceRequestJSON.serviceRequestList.length > 0){
		//console.log("allServiceRequestListJSON \n");
		//console.log(allServiceRequestListJSON);
		$('#tmpl_serviceRequestList').tmpl(serviceRequestJSON).appendTo('.requestPendings');
	}

	$('#tmpl_searchCriteria').tmpl({}).appendTo('.leftBlock .searchBox');
	
	
	$(".givRating").delegate(".rateThisService","click",function(){
		var _self = $(this),
		tmpAraay = new Array,
		rateData = _self.attr("lnkData");
		tmpAraay = rateData.split("|");
		
		overlay({"overlyTemplate":"#tmpl_serviceRatngOverlay","overlyTemplateData" : {"ovrlaystyle" : "width:450px; height: 400px;","dealID":tmpAraay[0],"psID":tmpAraay[1]} ,"context":$(this).context});															 
	});

	$(".givRating").delegate(".comentThisService","click",function(){
		var _self = $(this),
		rateData = _self.attr("lnkData");
		
		overlay({"overlyTemplate":"#tmpl_serviceCommentOverlay","overlyTemplateData" : {"ovrlaystyle" : "width:450px; height: 206px;","dealID":rateData} ,"context":$(this).context});															 
	});

	$(".dashBlocks").delegate("fomr#searchService","submit",function(ev){
		ev.preventDefault();
		var _self = $(this),
		fomrAction = _self.attr("action"),
		dataset = _self.serialize();

		$.ajax({
			url:fomrAction,
			data:dataset,
			async:false,
			success:function(resp){
				console.log(resp);
				//$('#tmpl_searchCriteria').tmpl({}).appendTo('.dashBlocks .leftBlock .searchResult');
			},
			error:function(err){
				console.log(err);
			}
		});


	});
}
function showInlineErrorMessage(msg,field){
	$(field).after("<p class='error-message'>"+msg+"</p>");
	$(field).addClass("error-field");
}
function displayMessage(msg){
	$(".error,.message").html('<span>'+msg+'</span>').show().attr({"tabindex":"-1","role":"alert","generated":"true"}).focus();
	setTimeout(function(){
						timeout_trigger();
						}, 5000);
}
function timeout_trigger(){
	if($(".error,.message").length >= 1){
		$(".error span,.message span,.message").fadeOut("5",function(){
			//$(this).remove();
			$("h2:first").attr("tabindex","-1").focus();
		});
	}
		
}

function formloadComplete(resultObject){

	switch(resultObject.formAction){
			case "addService":
				
				displayMessage("new Service added successfuly");
				$("#servicesList").text(JSON.stringify(resultObject.resultCallBack));
				servicesList();
				$(".addservice #addService, .addservice #addServiceDesc, .addservice #editServiceID").val("");

			break;
			case "editService":
				
				displayMessage("Service updated successfuly");
				$("#servicesList").text(JSON.stringify(resultObject.resultCallBack));
				servicesList();
				
			break;			
			case "dealDetails":
				
				
			break;
			case "loginSuccess":
				

			break;
			case "searchService":
				
				$("#searchServiceData").val(JSON.stringify(resultObject.resultCallBack));
				prepareSearchList();				
				
			break;
			case "countryMgt":
			
			console.log(resultObject.resultCallBack);
			
			if(resultObject.resultCallBack.selectcountry == ""){
				displayMessage("Country : "+resultObject.resultCallBack.addCountry+" Added Successfuly");
			}else{
				displayMessage("Country : "+resultObject.resultCallBack.addCountry+" updated Successfuly");
			}
			
				prepareContryList(resultObject.resultCallBack);
				
			break;
			case "confirmDeal":
				confirmDealProc(resultObject.resultCallBack);
				$(".overlay #close").trigger("click");
			break;			
			case "ratingAdded":
				console.log(resultObject.resultCallBack);
				//window.location.reload();
				allServiceStausListJSON = {"serviceStatusList":resultObject.resultCallBack};
				statusListJSON = allServiceStausListJSON;
				if(resultObject.serviceComentOnly != 1){
					$('.ratings h3').next().remove();
					$('#tmpl_serviceRatingStaut').tmpl(statusListJSON).appendTo('.ratings');				
				}else{
					$('.serviceFeedback h3').next().remove();
					$('#tmpl_serviceFeedbackStaut').tmpl(statusListJSON).appendTo('.serviceFeedback');						
				}
				displayMessage("Feedback Receved Successfuly");
				$(".overlay #close").trigger("click");

			break;
		}
}