 //------------------------------------------MY FUNCTIONS
 //---document.getElementById
 function gtId(id){
 	return document.getElementById(id);
 }
 //---document.getElementById.value
  function gtIdVal(id){
 	return document.getElementById(id).value;
 }
//---getting Private,Public and Gov-Aided radios---ON ADD SCHOOL PAGE
 	 var xklCtgr=null;
    var radiosl = document.getElementsByName('xkl_categ');
    	for(var l = 0; l < radiosl.length; l++){
        	radiosl[l].onclick = function(){
          	xklCtgr=this.value;//----------fourth creteria
        	}
    	}
//------------------------- VAlid phone number
function valid_phone(inputtxt){
	var phone = gtIdVal(inputtxt);
	var lnt = phone.length;
	var sub = phone.substr(0, 3);
	const digits_only = string => [...string].every(c => '0123456789'.includes(c));
	if (lnt==10 && ((sub=='078')||(sub=='072')||(sub=='073'))&&digits_only(phone)&&(phone.substr(0, 1)==0)) {
		return true;
	}else{
		return false;
	}
}
//-------------Set Content
function setCont(elm,cnt){
	document.getElementById(""+elm+"").style.display='block';
	document.getElementById(""+elm+"").innerHTML="<strong>"+cnt+"</strong>";
	function clr(){
		document.getElementById(""+elm+"").style.display='none';
		document.getElementById(""+elm+"").innerHTML="";

	}
	setTimeout(clr,5000);

}
//-------------Set Content With Duration
function setContDir(diration,elm,cnt){
	document.getElementById(""+elm+"").style.display='block';
	document.getElementById(""+elm+"").innerHTML="<strong>"+cnt+"</strong>";
	function clr(){
		document.getElementById(""+elm+"").style.display='none';
		document.getElementById(""+elm+"").innerHTML="";

	}
	setTimeout(clr,diration);

}
//.........................................................isEmpty().......................................
function isEmpty(vval){
	if (vval=="") {
		return true;
	}else{
		return false;
	}
}

//============================================================= loading for button click
		// $('.btn').on('click', function() {
		//     var $this = $(this);
		//   $this.button('loading');
		//     setTimeout(function() {
		//        $this.button('reset');
		//    }, 4000);
		// });
//======================================================================================================================================  IMAGE TABS

function imgTabs(imgs,main) {
  var expandImg = document.getElementById(main);
  expandImg.src = imgs.src;

}
//======================================================================================================================= ON CLINCK ENTER ON INPUTS
function enterKeyPress(inpt,btnn){
	var inputt = document.getElementById(inpt);
	inputt.addEventListener("keyup", function(event) {
	  if (event.keyCode === 13) { 
	    event.preventDefault();
	    document.getElementById(btnn).click();
	  }
	}); 
}


// //==================================================================

// enterKeyPress("logNme","llgnn");
// enterKeyPress("logPass","llgnn");

// enterKeyPress("sgn_fname","sgn_btn");
// enterKeyPress("sgn_lname","sgn_btn");
// enterKeyPress("sgn_email","sgn_btn");
// enterKeyPress("sgn_npass","sgn_btn");
// enterKeyPress("sgn_cpass","sgn_btn");


//==================================================================


//========================================================================= ON SUBMIT SIGNUP
function onSubSignup(){
	var aft_latitude = document.getElementById("hdn_lttd").value;
	var aft_longitude = document.getElementById("hdn_lngtd").value;


	var sgnFnme = gtIdVal("sgn_fname");
	var sgnLnme = gtIdVal("sgn_lname");
	var sgnEmail = gtIdVal("sgn_email");
	var sgnNPass = gtIdVal("sgn_npass");
	var sgnCPass = gtIdVal("sgn_cpass");
	var lnNpass = sgnNPass.length;
	var lnCpass = sgnCPass.length;
	if (isEmpty(sgnFnme) || isEmpty(sgnLnme) || isEmpty(sgnEmail) || isEmpty(sgnNPass) || isEmpty(sgnCPass)) {
		setCont("respns","Please fill all Forms");
	}else{
		if (sgnNPass!=sgnCPass) {
			setCont("respns","Passwords don't match");
		}else{
			if (lnNpass<8) {
				setCont("respns","Minimum password size must atleast equal to 8 characters");
			}else if(lnNpass>36){
				setCont("respns","Maximun password size must atleast equal to 36 characters");
			}else{
				if (valid_phone("sgn_email")) {
					if(aft_latitude>0 || aft_longitude>0){
						var onSubSignup = true;
						$.ajax({url:"js/ajax/main.php",
						type:"GET",data:{onSubSignup:onSubSignup,sgnFnme:sgnFnme,sgnLnme:sgnLnme,sgnEmail:sgnEmail,sgnNPass:sgnNPass,sgnCPass:sgnCPass,lngt:aft_longitude,ltt:aft_latitude},cache:false,success:function(res){$("#respns").html(res);}
						});
						//setCont("respns_1","Latitude: "+aft_latitude+", Longitude: "+aft_longitude);	
					}else{
						alert("Please ALLOW your device LOCATION to register your product location.");
						window.location.reload();
					}
					//setCont("respns","ok");
				}else{
				setCont("respns","Invalid Phone number");	
				}
			}
		}
	}
}


//========================================================== MOBILE ====== ON SUBMIT SIGNUP
function MobonSubSignup(){
	var aft_latitude = document.getElementById("hdn_lttd").value;
	var aft_longitude = document.getElementById("hdn_lngtd").value;



	var sgnFnme = gtIdVal("sgn_fname");
	var sgnLnme = gtIdVal("sgn_lname");
	var sgnEmail = gtIdVal("sgn_email");
	var sgnNPass = gtIdVal("sgn_npass");
	var sgnCPass = gtIdVal("sgn_cpass");
	var lnNpass = sgnNPass.length;
	var lnCpass = sgnCPass.length;
	if (isEmpty(sgnFnme) || isEmpty(sgnLnme) || isEmpty(sgnEmail) || isEmpty(sgnNPass) || isEmpty(sgnCPass)) {
		setCont("respns_1","Please fill all Forms");
	}else{
		if (sgnNPass!=sgnCPass) {
			setCont("respns_1","Passwords don't match");
		}else{
			if (lnNpass<8) {
				setCont("respns_1","Minimum password size must atleast equal to 8 characters");
			}else if(lnNpass>36){
				setCont("respns_1","Maximun password size must atleast equal to 36 characters");
			}else{
				if (valid_phone("sgn_email")) {
					if(aft_latitude>0 || aft_longitude>0){
					var onSubSignup = true;
					$.ajax({url:"js/ajax/main.php",
					type:"GET",data:{onSubSignup:onSubSignup,sgnFnme:sgnFnme,sgnLnme:sgnLnme,sgnEmail:sgnEmail,sgnNPass:sgnNPass,sgnCPass:sgnCPass,lngt:aft_longitude,ltt:aft_latitude},cache:false,success:function(res){$("#respns_1").html(res);}
					});
					//setCont("respns_1","Latitude: "+aft_latitude+", Longitude: "+aft_longitude);	
					}else{
						alert("Please ALLOW your device LOCATION to register your product location.");
						window.location.reload();
					}
					//setCont("respns","ok");
				}else{
				setCont("respns_1","Invalid Phone number");	
				}
			}
		}
	}
}

//========================================================================= ON SUBMIT LOGIN
function onSubLogin(){
	var logNme = gtIdVal("logNme");
	var logPas = gtIdVal("logPass");
	if (isEmpty(logNme) || isEmpty(logPas)) {
		$('.btn').button('reset');
		setCont("respns_1","Please fill all forms ... ");
	}else{
		var onSubLogin = true;
		$.ajax({url:"js/ajax/main.php",
		type:"GET",data:{onSubLogin:onSubLogin,logNme:logNme,logPas:logPas},cache:false,success:function(res){$("#respns_1").html(res);}
		});
	}
}

//========================================================================= MOBILE ON SUBMIT LOGIN
function MobOnSubLogin(){
	var logNme = gtIdVal("logNme");
	var logPas = gtIdVal("logPass");
	if (isEmpty(logNme) || isEmpty(logPas)) {
		//$('.btn').button('reset');
		setCont("respns_1","Please fill all forms ... ");
	}else{
		var onSubLogin = true;
		$.ajax({url:"js/ajax/main.php",
		type:"GET",data:{onSubLogin:onSubLogin,logNme:logNme,logPas:logPas},cache:false,success:function(res){$("#respns_1").html(res);}
		});
	}
}

//================================================ AUTOLOAD ===== SELECT COUNTRIES
function autCountrie() {
		var autCountrie = true;
		$.ajax({url:"js/ajax/main.php",
		type:"GET",data:{autCountrie:autCountrie},cache:false,success:function(res){$("#chp_cntry").html(res);}
		});
}
autCountrie();

//========================================================================= Proceed With Payment
function proPayment(){
	var cntr = gtIdVal("chp_cntry");
	var dstr = gtIdVal("chp_dst");
	var sctr = gtIdVal("chp_sctr");
	var cll = gtIdVal("chp_cll");
	var phn = gtIdVal("chp_phn");
	var strt = gtIdVal("chp_strt");

	var pprro = gtIdVal("py_pr");
	var uusr = gtIdVal("py_usr");
	var qqnty = gtIdVal("py_qnty");

	var phone_length = phn.length;

	if (isEmpty(cntr) || isEmpty(dstr) || isEmpty(sctr) || isEmpty(cll) || isEmpty(phn)) {
		setCont("respns","Please fill all forms ... ");
	}else{
		if (phone_length==10) {
			var proPayment = true;
			$.ajax({url:"js/ajax/main.php",
			type:"GET",data:{proPayment:proPayment,cntr:cntr,dstr:dstr,sctr:sctr,cll:cll,phn:phn,strt:strt,pprro:pprro,uusr:uusr,qqnty:qqnty},cache:false,success:function(res){$("#respns").html(res);}
			});
		}else{
			setCont("respns","Invalid phone number ... ");
		}

	}
}

//=========================================================================  Buy NOW BTN
function BuyNow(){
	var prid = gtIdVal("pr_id");
	var usrid = gtIdVal("usr_id");
	var prqnntty = gtIdVal("prqntty");
	if (!isEmpty(prid) && !isEmpty(usrid) && !isEmpty(prqnntty)) {
		if (prqnntty>0) {
			var BuyNow = true;
			$.ajax({url:"js/ajax/main.php",
				type:"GET",data:{BuyNow:BuyNow,prid:prid,usrid:usrid,prqnntty:prqnntty},cache:false,success:function(res){$("#resp_bynw").html(res);}
				});
		}else{
			setCont("resp_bynw","Invalid Product Quantity ...");
		}
	}else{
		setCont("resp_bynw","Fill Product Quantity...");
	}
}
//=========================================================================  MOBILE   Buy NOW BTN
function MobBuyNow(){
	var prid = gtIdVal("pppr_id");
	var usrid = gtIdVal("pppr_usr");
	var prqnntty = gtIdVal("qnty_to_buy");
	if (!isEmpty(prid) && !isEmpty(prqnntty)) {
		if (prqnntty>0) {
			var MobBuyNow = true;
			$.ajax({url:"js/ajax/main.php",
				type:"GET",data:{MobBuyNow:MobBuyNow,prid:prid,prqnntty:prqnntty},cache:false,success:function(res){$("#resp_bynw").html(res);}
				});
		}else{
			// setCont("resp_bynw","Invalid Product Quantity ...");
			alert("Invalid Product Quantity ...");
		}
	}else{
		// setCont("resp_bynw","Fill Product Quantity...");
		alert("Fill Product Quantity...");
	}
}
//=========================================================================  MOBILE  === ADD TOL CART BTN
function MobAddToCart(){
	var prid = gtIdVal("pppr_id");
	var usrid = gtIdVal("pppr_usr");
	var prqnntty = gtIdVal("qnty_to_buy");
	if (!isEmpty(prid) && !isEmpty(prqnntty)) {
		if (prqnntty>0) {
			var MobAddToCart = true;
			$.ajax({url:"js/ajax/main.php",
				type:"GET",data:{MobAddToCart:MobAddToCart,prid:prid,prqnntty:prqnntty},cache:false,success:function(res){$("#resp_bynw").html(res);}
				});
		}else{
			// setCont("resp_bynw","Invalid Product Quantity ...");
			alert("Invalid Product Quantity ...");
		}
	}else{
		// setCont("resp_bynw","Fill Product Quantity...");
		alert("Fill Product Quantity...");
	}
}
//=========================================================================  ADD TO CART
function addToCart(){
	var prid = gtIdVal("pr_id");
	var usrid = gtIdVal("usr_id");
	var prqnntty = gtIdVal("prqntty");
	if (!isEmpty(prid) && !isEmpty(usrid) && !isEmpty(prqnntty)) {
		if (prqnntty>0) {
			var addToCart = true;
			$.ajax({url:"js/ajax/main.php",
				type:"GET",data:{addToCart:addToCart,prid:prid,usrid:usrid,prqnntty:prqnntty},cache:false,success:function(res){$("#resp_bynw").html(res);}
				});
		}else{
			setCont("resp_bynw","Invalid Product Quantity ...");
		}
	}else{
		setCont("resp_bynw","Fill Product Quantity...");
	}
}
//================================================================================================ Contfirm Product Request
function confirmProduct(prd,pge){
	if (pge==true) {
		var confirmProduct = true;
		$.ajax({url:"../js/ajax/main.php",
		type:"GET",data:{confirmProduct:confirmProduct,prd:prd,pge:pge},cache:false,success:function(res){$("#resp_bynw").html(res);}
		});
		location.reload();
	}
}

//================================================================================================ DELETE PRODUCT
function deleteProduct(prd,pge){
	if (pge==true) {
		var deleteProduct = true;
		$.ajax({url:"../js/ajax/main.php",
		type:"GET",data:{deleteProduct:deleteProduct,prd:prd,pge:pge},cache:false,success:function(res){$("#resp_bynw").html(res);}
		});
		location.reload();
	}
}

//==================================================================================================================================== Final Request Cnfirmation

function condProdReq(product,status){
	var condProdReq = true;
		$.ajax({url:"../js/ajax/main.php",
		type:"GET",data:{condProdReq:condProdReq,product:product,status:status},cache:false,success:function(res){$("#rts_tr").html(res);}
		});
		window.location=".index/#resp_pr_req";
}

//======================================================================================================================================  Finalise Payment

function allPayConfrm(phone,amount,prod,qnty,dist,sect,cell,street,shipp){ 
	gtId("allPayConfrm").disabled = true;
	var allPayConfrm = true;
	gtId("resp_mdl_ttl").innerHTML="<span style='color:font-weight:bolder;color:#285734;font-size:30px'>Response:</span>";
	$.ajax({url:"js/ajax/direct_pay.php",		//    phone      amount
		type:"GET",data:{allPayConfrm:allPayConfrm,sAjR:phone,rJaS:amount,prod:prod,qnty:qnty,dist:dist,sect:sect,cell:cell,street:street,shipp:shipp},cache:false,success:function(res){$("#resp_mdl_cnt").html(res);}
		});
}

//================================================================================================================ Sub Select Category
function selSubCat(){
	var mnCat = gtIdVal("pr_gr_cat");
	if (!isEmpty(mnCat)) {
		var selSubCat = true;
		$.ajax({url:"../js/ajax/main.php",
		type:"GET",data:{selSubCat:selSubCat,mnCat:mnCat},cache:false,success:function(res){$("#pr_cat").html(res);}
		});
	}
}

//================================================================================================================ Search Products ON Enter

function searchEgura(){
    if(event.keyCode == 13) {
        var conttent = gtIdVal("search");
        if (!isEmpty(conttent)) {
        	//document.getElementById("tobe_rmvd_1").style.display='none';
        	document.getElementById("slider").style.display='none';
        	var searchEgura = true;
        	gtId("res_imgs").innerHTML="<center style='font-size:20px;font-weight:bolder'>Loading ...</center>";
			$.ajax({url:"js/ajax/main.php",
			type:"GET",data:{searchEgura:searchEgura,conttent:conttent},cache:false,success:function(res){$("#res_imgs").html(res);}
			});
        }else{
        	//document.getElementById("tobe_rmvd_1").style.display='block';
        	document.getElementById("slider").style.display='block';
        }
    }
}
function searchEguraBut(){

        var conttent = gtIdVal("search");
        if (!isEmpty(conttent)) {
        	//document.getElementById("tobe_rmvd_1").style.display='none';
        	document.getElementById("slider").style.display='none';
        	var searchEgura = true;
        	gtId("res_imgs").innerHTML="<center style='font-size:20px;font-weight:bolder'>Loading ...</center>";
			$.ajax({url:"js/ajax/main.php",
			type:"GET",data:{searchEgura:searchEgura,conttent:conttent},cache:false,success:function(res){$("#res_imgs").html(res);}
			});
        }else{
        	//document.getElementById("tobe_rmvd_1").style.display='block';
        	document.getElementById("slider").style.display='block';
        }
}

//====================================================================================================== MOBILE Search

function mobSearch(){
        var conttent = gtIdVal("search_cont");
        if (!isEmpty(conttent)) {
        	var mobSearch = true;
        	gtId("sch_resp").innerHTML="<center style='font-size:20px;font-weight:bolder'>Loading ...</center>";
			$.ajax({url:"js/ajax/main.php",
			type:"GET",data:{mobSearch:mobSearch,conttent:conttent},cache:false,success:function(res){$("#sch_resp").html(res);}
			});
        }
}

function searchProductCategory(category){
        	//document.getElementById("tobe_rmvd_1").style.display='none';
        	document.getElementById("slider").style.display='none';
        	var searchProductCategory = true;
        	gtId("res_imgs").innerHTML="<center style='font-size:20px;font-weight:bolder'>Loading ...</center>";
			$.ajax({url:"js/ajax/main.php",
			type:"GET",data:{searchProductCategory:searchProductCategory,category:category},cache:false,success:function(res){$("#res_imgs").html(res);}
			});

}


//===========================================  UPDATE PRODUCT

function updProduct(){
	var proName = gtIdVal("pro_name");
	var proPrice = gtIdVal("pro_price");
	var proDescr = gtIdVal("pro_desc");
	var proShip = gtIdVal("pro_ship");
	var proIdd = gtIdVal("pro_iid");

	if (!isEmpty(proName) && !isEmpty(proPrice) && !isEmpty(proDescr) && !isEmpty(proShip) ) {
		if (isNaN(proPrice)) {
			setCont("respns","Enter a valid price value");
		}else if (isNaN(proPrice)) {
			setCont("respns","Enter a valid Shipping-Price value");
		}else{
			var updProduct = true;
			$.ajax({url:"../js/ajax/main.php",
			type:"GET",data:{updProduct:updProduct,proName:proName,proPrice:proPrice,proDescr:proDescr,proShip:proShip,proIdd:proIdd},cache:false,success:function(res){$("#respns").html(res);}
			});
		}
	}
}

//================================================================== FORGOT PASSWORD TOGGLE DIVISION

$(document).ready(function(){
	$("#frgt_pss").click(function(){
		$("#frg_eml_dv").toggle();
	})
});

//==================================================================  ON SUBMIT FORGET PASSWORD

function onSbmtFrgPss(){
	var usr_email = gtIdVal("user_email");
	if (!isEmpty(usr_email)) {
		$.ajax({url:"js/ajax/main.php",
			type:"GET",data:{onSbmtFrgPss:onSbmtFrgPss,usr_email:usr_email},cache:false,success:function(res){$("#resp").html(res);}
			});
		// var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		// if(usr_email.match(mailformat)){
		// 	var onSbmtFrgPss = true;
		// 	$.ajax({url:"js/ajax/main.php",
		// 	type:"GET",data:{onSbmtFrgPss:onSbmtFrgPss,usr_email:usr_email},cache:false,success:function(res){$("#resp").html(res);}
		// 	});
		// }else{
		// 	setCont("resp","Invalid email ...");
		// }
		
	}else{
		setCont("resp"," <span style='color:red;font-weight:bolder;'>Please fill your phone number ...</span>");
	}
}

//==================================================== MOBILE =========  ON SUBMIT FORGET PASSWORD

function mobOnSbmtFrgPss(){
	var usr_email = gtIdVal("mobuser_email");
	if (!isEmpty(usr_email)) {
		var mobOnSbmtFrgPss = true;
		$.ajax({url:"js/ajax/main.php",
			type:"GET",data:{mobOnSbmtFrgPss:mobOnSbmtFrgPss,usr_email:usr_email},cache:false,success:function(res){$("#mobForgDiv").html(res);}
			});

		
	}else{
		setCont("frg_ttl"," <span style='color:red;font-weight:bolder;'>Please fill your phone number ...</span>");
	}
}

//============================================================================== CLOSE FORGET PASSWORD

function closeFrtgPss(){
	document.getElementById("frg_eml_dv").style.display = "none";
}
//============================================================ MOBILE ========= CLOSE FORGET PASSWORD

function mobCloseFrtgPss(){
	document.getElementById("mobForgDiv").style.display = "none";
}

//=========================================================================================  PROCEED WITH PAYMENT
function proceedWithPayPrDetails(){
	var upnm = gtIdVal("upnm");
	var pnm = gtIdVal("pnm");
	var qnt = gtIdVal("qnt");
	var phn = gtIdVal("phn");
	var dst = gtIdVal("dst");
	var str = gtIdVal("str");
	var cll = gtIdVal("cll");
	var amnt = gtIdVal("amnt");

	alert("Ammount: "+amnt+" - Username: "+upnm+" - Product name: "+pnm+" - Quantity: "+qnt+" - Phone: "+phn+" - District: "+dst+" - Sector: "+str+" - Cell: "+cll);
}


//=============================================================================================  REMOVE PRODUCT IN CART
function removeOnCart(cart){
	var removeOnCart = true;
	$.ajax({url:"js/ajax/main.php",
			type:"GET",data:{removeOnCart:removeOnCart,cart:cart},cache:false,success:function(res){$("#reviews").html(res);}
			});
}

//====================================================== MOBILE ==== FORGOT PASSWORD TOGGLE DIVISION

$(document).ready(function(){
	$("#mobFrgtLink").click(function(){
		$("#mobForgDiv").toggle();
	})
});