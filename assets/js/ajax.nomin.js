function show_loading() {
      // show loading icon dan disable button1 & button2
      $(".ajax-loader").show();
      $("#button1").attr("disabled", "disabled");
      $("#button2").attr("disabled", "disabled");
}

function hide_loading() {
      // hide loading icon dan enable button1 & button2
      $(".ajax-loader").hide();
      $("#button1").removeAttr("disabled");
      $("#button2").removeAttr("disabled");
}

function show_dialog_confirmation($message) {
      $("#confirmation").html("<p>"+$message+"</p>");
		
      // untuk menampilkan dialog box konfirmasi
      $("#confirmation").dialog({
            modal: true,
            buttons: {
                  Ok: function() {
                        $(this).dialog("close");
                  }
            }
      });
}

function show_dialog_delete(obj, todo, urlChange, urlContent, urlInsert, id) {
      var message = "";
      if (todo == "delete")
            message = "Anda yakin ingin menghapus ?";
      else if (todo == "unapprove")
            message = "Anda yakin ingin mengunapprove ?";
		
      $("#confirmation").html("<p>"+message+"</p>");
		
      // untuk menampilkan dialog box konfirmasi
      $("#confirmation").dialog({
            modal: true,
            buttons: {
                  Ya: function() {
                        $(this).dialog("close");
                        ajaxChange(obj, todo, urlChange, urlContent, urlInsert, id);
                  },
                  Tidak: function() {				
                        $(this).dialog("close");
                  }
            }
      });
	
      return false;
}

function ajaxChange(obj, todo, urlChange, urlContent, urlInsert, id) {
      if (id == undefined)
            id = "";
	
      if (obj == "client") {
            if (todo == "insert") {
                  var txtName = $("#txtName").val();
                  var arrParam = new Array(txtName);
            } else if (todo == "update") {
                  var hdId = $("#hdId").val();
                  var txtName = $("#txtName").val();
                  var arrParam = new Array(hdId, txtName);
            } else if (todo == "delete") {
                  var arrParam = new Array(id);
            }
      } else if (obj == "agency") {
            if (todo == "insert") {
                  var txtName = $("#txtName").val();
                  var txtAddress = $("#txtAddress").val();
                  var txtContact = $("#txtContact").val();
                  var arrParam = new Array(txtName, txtAddress, txtContact);
            } else if (todo == "update") {
                  var hdId = $("#hdId").val();
                  var txtName = $("#txtName").val();
                  var txtAddress = $("#txtAddress").val();
                  var txtContact = $("#txtContact").val();
                  var arrParam = new Array(hdId, txtName, txtAddress, txtContact);
            } else if (todo == "delete") {
                  var arrParam = new Array(id);
            }
      } else if (obj == "department") {
            if (todo == "insert") {
                  var txtName = $("#txtName").val();
                  var arrParam = new Array(txtName);
            } else if (todo == "update") {
                  var hdId = $("#hdId").val();
                  var txtName = $("#txtName").val();
                  var arrParam = new Array(hdId, txtName);
            } else if (todo == "delete") {
                  var arrParam = new Array(id);
            }
      } else if (obj == "level") {
            if (todo == "insert") {
                  var txtName = $("#txtName").val();
                  var txtKeterangan = $("#txtKeterangan").val();
                  var txtAccessData = $("input[name=rdbAccessData]:checked").val();
                  var txtAccess = new Array();
                  $("input[name=chkAccess]:checked").each(function() {
                        if ($(this).val() != "")
                              txtAccess.push($(this).val());
                  });
                  txtAccess = (txtAccess.length > 0) ? txtAccess : "";
                  var arrParam = new Array(txtName, txtKeterangan, txtAccessData, txtAccess);
            } else if (todo == "update") {
                  var hdId = $("#hdId").val();
                  var txtName = $("#txtName").val();
                  var txtKeterangan = $("#txtKeterangan").val();
                  var txtAccessData = $("input[name=rdbAccessData]:checked").val();
                  var txtAccess = new Array();
                  $("input[name=chkAccess]:checked").each(function() {
                        if ($(this).val() != "")
                              txtAccess.push($(this).val());
                  });
                  txtAccess = (txtAccess.length > 0) ? txtAccess : "";
                  var arrParam = new Array(hdId, txtName, txtKeterangan, txtAccessData, txtAccess);
            } else if (todo == "delete") {
                  var arrParam = new Array(id);
            }
      } else if (obj == "user") {
            if (todo == "insert") {
                  var txtUsername = $("#txtUsername").val();
                  var txtPassword = $("#txtPassword").val();
                  var txtName = $("#txtName").val();
                  var txtEmail = $("#txtEmail").val();
                  var selectDepartment = $("#selectDepartment").val();
                  var selectLevel = $("#selectLevel").val();
                  var arrParam = new Array(txtUsername, txtPassword, txtName, txtEmail, selectDepartment, selectLevel);
            } else if (todo == "update") {
                  var txtUsername = $("#txtUsername").val();
                  var txtPassword = $("#txtPassword").is(":checked");
                  var txtName = $("#txtName").val();
                  var txtEmail = $("#txtEmail").val();
                  var selectDepartment = $("#selectDepartment").val();
                  var selectLevel = $("#selectLevel").val();
                  var arrParam = new Array(txtUsername, txtPassword, txtName, txtEmail, selectDepartment, selectLevel);
            } else if (todo == "delete") {
                  var arrParam = new Array(id);
            }
      } else if (obj == "ads") {
            if (todo == "insert") {
                  var txtName = $("#txtName").val();
                  var arrParam = new Array(txtName);
            } else if (todo == "update") {
                  var hdId = $("#hdId").val();
                  var txtName = $("#txtName").val();
                  var arrParam = new Array(hdId, txtName);
            } else if (todo == "delete") {
                  var arrParam = new Array(id);
            }
      } else if (obj == "kanal") {
            if (todo == "insert") {
                  var txtName = $("#txtName").val();
                  var txtRubrik = new Array();
                  $("input[name=txtRubrik]").each(function() {
                        txtRubrik.push($(this).val());
                  });
                  var arrParam = new Array(txtName, txtRubrik);
            } else if (todo == "update") {
                  var hdId = $("#hdId").val();
                  var txtName = $("#txtName").val();
                  var txtRubrik = new Array();
                  $("input[name=txtRubrik]").each(function() {
                        txtRubrik.push($(this).val());
                  });
                  var arrParam = new Array(hdId, txtName, txtRubrik);
            } else if (todo == "delete") {
                  var arrParam = new Array(id);
            }
      } else if (obj == "position") {
            if (todo == "insert") {
                  var txtName = $("#txtName").val();
                  var txtKeterangan = $("#txtKeterangan").val();	
                  //                  var txtOverride = $("input[name=rdbOverride]:checked").val();
                  //                  var txtCpmQuota = $("#txtCpmQuota").val();
                  var arrParam = new Array(txtName, txtKeterangan/*, txtOverride, txtCpmQuota*/);
            } else if (todo == "update") {
                  var hdId = $("#hdId").val();
                  var txtName = $("#txtName").val();
                  var txtKeterangan = $("#txtKeterangan").val();
                  //                  var txtOverride = $("input[name=rdbOverride]:checked").val();
                  //                  var txtCpmQuota = $("#txtCpmQuota").val();
                  var arrParam = new Array(hdId, txtName, txtKeterangan/*, txtOverride, txtCpmQuota*/);
            } else if (todo == "delete") {
                  var arrParam = new Array(id);
            }
      } else if (obj == "productgroup") {
            if (todo == "insert") {
                  var txtName = $("#txtName").val();
                  var txtKeterangan = $("#txtKeterangan").val();	
                  var txtKanal = $("#selectKanal").val();
			
                  var txtRubrik = "";
                  $("select[name=selectRubrikDestination] option").each(function() {
                        txtRubrik += $(this).val() +",";
                  });
                  txtRubrik = txtRubrik.substring(0, txtRubrik.length-1); // untuk menghilangkan "," di belakang
			
                  var txtPosition = "";
                  $("select[name=selectPositionDestination] option").each(function() {
                        txtPosition += $(this).val() +",";
                  });
                  txtPosition = txtPosition.substring(0, txtPosition.length-1); // untuk menghilangkan "," di belakang
                  
                  var chkCpm = new Array();
                  $("input[name=chkCpm]:checked").each(function() {
                        chkCpm.push($(this).val());
                  });
                  
                  var arrParam = new Array(txtName, txtKeterangan, txtKanal, txtRubrik, txtPosition, chkCpm);
            } else if (todo == "update") {
                  var hdId = $("#hdId").val();
                  var txtName = $("#txtName").val();
                  var txtKeterangan = $("#txtKeterangan").val();
                  var txtKanal = $("#selectKanal").val();
			
                  var txtRubrik = "";
                  $("select[name=selectRubrikDestination] option").each(function() {
                        txtRubrik += $(this).val() +",";
                  });
                  txtRubrik = txtRubrik.substring(0, txtRubrik.length-1); // untuk menghilangkan "," di belakang
			
                  var txtPosition = "";
                  $("select[name=selectPositionDestination] option").each(function() {
                        txtPosition += $(this).val() +",";
                  });
                  txtPosition = txtPosition.substring(0, txtPosition.length-1); // untuk menghilangkan "," di belakang
			
                  var chkCpm = new Array();
                  $("input[name=chkCpm]:checked").each(function() {
                        chkCpm.push($(this).val());
                  });
                        
                  var arrParam = new Array(hdId, txtName, txtKeterangan, txtKanal, txtRubrik, txtPosition, chkCpm);
            } else if (todo == "delete") {
                  var arrParam = new Array(id);
            }
      }else if (obj == "industry_cat") {
            if (todo == "insert") {
                  var txtName = $("#txtName").val();
			
                  var txtSubIndustry = "";
                  $("select[name=selectSubIndustryDestination] option").each(function() {
                        txtSubIndustry += $(this).val() +",";
                  });
                  txtSubIndustry = txtSubIndustry.substring(0, txtSubIndustry.length-1); // untuk menghilangkan "," di belakang
                  
                  var arrParam = new Array(txtName, txtSubIndustry);
            } else if (todo == "update") {
                  var hdId = $("#hdId").val();
                  var txtName = $("#txtName").val();
			
                  var txtSubIndustry = "";
                  $("select[name=selectSubIndustryDestination] option").each(function() {
                        txtSubIndustry += $(this).val() +",";
                  });
                  txtSubIndustry = txtSubIndustry.substring(0, txtSubIndustry.length-1); // untuk menghilangkan "," di belakang
                        
                  var arrParam = new Array(hdId, txtName, txtSubIndustry);
            } else if (todo == "delete") {
                  var arrParam = new Array(id);
            }
      } else if (obj == "industry") {
            if (todo == "insert") {
                  var txtName = $("#txtName").val();
                  var arrParam = new Array(txtName);
            } else if (todo == "update") {
                  var hdId = $("#hdId").val();
                  var txtName = $("#txtName").val();
                  var arrParam = new Array(hdId, txtName);
            } else if (todo == "delete") {
                  var arrParam = new Array(id);
            }
      } else if (obj == "conflictbrand") {
            if (todo == "insert") {
                  var selectIndustry = $("#selectIndustry").val();	
                  var selectKanal = $("#selectKanal").val();
                  var selectProductGroup = $("#selectProductgroup").val();
			
                  var selectRule = new Array();
                  $("input[name=txtRule]").each(function() {
                        selectRule.push($(this).attr("nilai"));
                  });
                  selectRule = (selectRule.length > 0) ? selectRule : "";

                  var arrParam = new Array(selectIndustry, selectKanal, selectProductGroup, selectRule);
            } else if (todo == "update") {
                  var hdId = $("#hdId").val();
                  var selectIndustry = $("#selectIndustry").val();	
                  var selectKanal = $("#selectKanal").val();
                  var selectProductGroup = $("#selectProductgroup").val();
			
                  var selectRule = new Array();
                  $("input[name=txtRule]").each(function() {
                        selectRule.push($(this).attr("nilai"));
                  });
                  selectRule = (selectRule.length > 0) ? selectRule : "";
			
                  var arrParam = new Array(hdId, selectIndustry, selectKanal, selectProductGroup, selectRule);
            } else if (todo == "delete") {
                  var arrParam = new Array(id);
            }
      } else if (obj == "masterbrandcomm") {
            if (todo == "insert") {
                  var txtItem = $("#txtItem").val();
                  var selectNumberOrder = $("select[name=selectNumberOrder]").val();
                  var arrParam = new Array(txtItem, selectNumberOrder);
            } else if (todo == "update") {
                  var hdId = $("#hdId").val();
                  var txtItem = $("#txtItem").val();
                  var selectNumberOrder = $("select[name=selectNumberOrder]").val();
                  var arrParam = new Array(hdId, txtItem, selectNumberOrder);
            } else if (todo == "delete") {
                  var arrParam = new Array(id);
            }
      } else if (obj == "cpm") {
            if (todo == "insert") {
                  var cpmQuota = $("#txtCpmQuota").val();
                  var arrParam = new Array(cpmQuota);
            } else if (todo == "update") {
                  var hdId = $("#hdId").val();
                  var cpmQuota = $("#txtCpmQuota").val();
                  var arrParam = new Array(hdId, cpmQuota);
            } else if (todo == "delete") {
                  var arrParam = new Array(id);
            }
      } else if (obj == "order") {
            if (todo == "insert") {
                  var selectPacketType = $("#selectPacketType").val();
                  //var txtNoPaket = $("#txtNoPaket").val();
                  var txtNo = (selectPacketType == "N") ? $("#txtNoSpace").val() : $("#txtNoBrandcomm").val();
                  var txtAgency = $("#selectAgency").val();
                  var txtClient = $("#selectClient").val();
                  var txtBudget = $("#txtBudget").val();
                  var txtDiskon = $("#txtDiskon").val();
                  var txtBenefit = "";
                  var txtMiscInfo = "";
                  var selectAds = ($("select[name=selectAds]").length > 0) ? $("select[name=selectAds]").serializeArray() : "";
                  var selectKanal = ($("select[name=selectKanal]").length > 0) ? $("select[name=selectKanal]").serializeArray() : "";
                  var selectProductGroup = ($("select[name=selectProductGroup]").length > 0) ? $("select[name=selectProductGroup]").serializeArray() : "";
                  var selectPosition = ($("select[name=selectPosition]").length > 0) ? $("select[name=selectPosition]").serializeArray() : "";
                  var txtStartDate = ($("input[name=txtStartDate]").length > 0) ? $("input[name=txtStartDate]").serializeArray() : "";
                  var txtEndDate = ($("input[name=txtEndDate]").length > 0) ? $("input[name=txtEndDate]").serializeArray() : "";
                  var txtMiscInfoPaket = ($("textarea[name=txtMiscInfoPaket]").length > 0) ? $("textarea[name=txtMiscInfoPaket]").serializeArray() : "";
                  var chkIsRestrict = $("#chkIsRestrict").is(":checked");
                  var selectIndustri = $("#selectIndustry").val();
                  var txtMiscInfoEvent = $("#txtMiscInfoEvent").val();
                  var txtMiscInfoProductionCost = $("#txtMiscInfoProductionCost").val();
                  var cpmQuota = ($("input[name=txtCpmQuota]").length > 0) ? $("input[name=txtCpmQuota]").serializeArray() : "";
                  var selectIndustriCat = $("#selectIndustryCat").val();

				  //TAMBAHAN WILLY
                  var hargaSistem = $("#total").val();
                  var hargaGross = $("#hargaGross").val();
                  var diskonNominal = $("#diskonNominal").val();
				  var addDiskon = $("#txtAddDiskon").val();
				  var addDiskonNominal = $("#addDiskonNominal").val();				  

                  var selectProduction = ($("select[name=selectProduction]").length > 0) ? $("select[name=selectProduction]").serializeArray() : "";
                  var txtQty = ($("input[name=txtQty]").length > 0) ? $("input[name=txtQty]").serializeArray() : "";
                  var txtHargaProd = ($("input[name=txtHargaProd]").length > 0) ? $("input[name=txtHargaProd]").serializeArray() : "";
                  var txtHargaProdTotal = ($("input[name=txtHargaProdTotal]").length > 0) ? $("input[name=txtHargaProdTotal]").serializeArray() : "";
                  var txtInfoProd = ($("textarea[name=txtInfoProd]").length > 0) ? $("textarea[name=txtInfoProd]").serializeArray() : "";
				  
				  var txtEvent = ($("input[name=txtEvent]").length > 0) ? $("input[name=txtEvent]").serializeArray() : "";
				  var txtStartDateEvent = ($("input[name=txtStartDateEvent]").length > 0) ? $("input[name=txtStartDateEvent]").serializeArray() : "";
				  var txtEndDateEvent = ($("input[name=txtEndDateEvent]").length > 0) ? $("input[name=txtEndDateEvent]").serializeArray() : "";
				  var txtHargaEvent = ($("input[name=txtHargaEvent]").length > 0) ? $("input[name=txtHargaEvent]").serializeArray() : "";
                  var txtInfoEvent = ($("textarea[name=txtInfoEvent]").length > 0) ? $("textarea[name=txtInfoEvent]").serializeArray() : "";

                  var totalHarga = $("#totalHarga").val();
                  var totalProduction = $("#totalProduction").val();
                  var totalEvent = $("#totalEvent").val();
                  var pajak = $("#pajak").val();
                  var totalSemua = $("#totalSemua").val();
				  //END TAMBAHAN
                        				  
                  var arrParam = new Array(selectPacketType, txtNo, txtAgency, txtClient, txtBudget, txtDiskon, txtBenefit, selectAds, selectKanal, selectProductGroup, selectPosition, txtStartDate, txtEndDate, chkIsRestrict, selectIndustri, txtMiscInfo, txtMiscInfoPaket, txtMiscInfoEvent, txtMiscInfoProductionCost, cpmQuota, selectIndustriCat, hargaSistem, hargaGross, diskonNominal, addDiskon, addDiskonNominal, selectProduction, txtQty, txtHargaProd, txtHargaProdTotal, txtInfoProd, txtEvent, txtStartDateEvent, txtEndDateEvent, txtHargaEvent, txtInfoEvent, totalHarga, totalProduction, totalEvent, pajak, totalSemua);
				  // alert(arrParam);
            } else if (todo == "update") {
                  var txtNoPaket = $("#txtNoPaket").val();
                  var txtAgency = $("#selectAgency").val();
                  var txtClient = $("#selectClient").val();
                  var txtBudget = $("#txtBudget").val();
                  var txtDiskon = $("#txtDiskon").val();
                  var txtBenefit = "";	
                  var txtMiscInfo = "";		
                  var selectAds = ($("select[name=selectAds]").length > 0) ? $("select[name=selectAds]").serializeArray() : "";
                  var selectKanal = ($("select[name=selectKanal]").length > 0) ? $("select[name=selectKanal]").serializeArray() : "";
                  var selectProductGroup = ($("select[name=selectProductGroup]").length > 0) ? $("select[name=selectProductGroup]").serializeArray() : "";
                  var selectPosition = ($("select[name=selectPosition]").length > 0) ? $("select[name=selectPosition]").serializeArray() : "";
                  var txtStartDate = ($("input[name=txtStartDate]").length > 0) ? $("input[name=txtStartDate]").serializeArray() : "";
                  var txtEndDate = ($("input[name=txtEndDate]").length > 0) ? $("input[name=txtEndDate]").serializeArray() : "";
                  var txtMiscInfoPaket = ($("textarea[name=txtMiscInfoPaket]").length > 0) ? $("textarea[name=txtMiscInfoPaket]").serializeArray() : "";
                  var chkIsRestrict = $("#chkIsRestrict").is(":checked");
                  var selectIndustri = $("#selectIndustry").val();
                  var txtMiscInfoEvent = $("#txtMiscInfoEvent").val();
                  var txtMiscInfoProductionCost = $("#txtMiscInfoProductionCost").val();
                  var cpmQuota = ($("input[name=txtCpmQuota]").length > 0) ? $("input[name=txtCpmQuota]").serializeArray() : "";
                  var hdStartDate = ($("input[name=hdStartDate]").length > 0) ? $("input[name=hdStartDate]").serializeArray() : "";
                  var hdEndDate = ($("input[name=hdEndDate]").length > 0) ? $("input[name=hdEndDate]").serializeArray() : "";
                  var selectIndustriCat = $("#selectIndustryCat").val();
				  
				  //TAMBAHAN WILLY
                  var hargaSistem = $("#total").val();
                  var hargaGross = $("#hargaGross").val();
                  var diskonNominal = $("#diskonNominal").val();
                  var hargaDiskon = $("#hargaDiskon").val();
                  var pajak = $("#pajak").val();
                  var totalHarga = $("#totalHarga").val();
				  // END TAMBAHAN

                  var arrParam = new Array(txtNoPaket, txtAgency, txtClient, txtBudget, txtDiskon, txtBenefit, selectAds, selectKanal, selectProductGroup, selectPosition, txtStartDate, txtEndDate, chkIsRestrict, selectIndustri, txtMiscInfo, txtMiscInfoPaket, txtMiscInfoEvent, txtMiscInfoProductionCost, cpmQuota, hdStartDate, hdEndDate, selectIndustriCat, hargaSistem, hargaGross, diskonNominal, pajak, totalHarga);
            } else if (todo == "progress") {
                  var hdNoPaket = $("#hdNoPaket").val();
                  var txtPercent = $("#percent").text();			
                  var arrParam = new Array(hdNoPaket, txtPercent);
            } else if (todo == "delete") {
                  var arrParam = new Array(id);
            }
      } else if (obj == "orderspace") {
            if (todo == "insert") {
                  //var txtNoSpace = $("#txtNoSpace").val();
                  var txtAgency = $("#selectAgency").val();
                  var txtClient = $("#selectClient").val();	
                  var txtMiscInfo = $("#txtMiscInfo").val();	
                  var selectAds = ($("select[name=selectAds]").length > 0) ? $("select[name=selectAds]").serializeArray() : "";
                  var selectKanal = ($("select[name=selectKanal]").length > 0) ? $("select[name=selectKanal]").serializeArray() : "";
                  var selectProductGroup = ($("select[name=selectProductGroup]").length > 0) ? $("select[name=selectProductGroup]").serializeArray() : "";
                  var selectPosition = ($("select[name=selectPosition]").length > 0) ? $("select[name=selectPosition]").serializeArray() : "";
                  var txtStartDate = ($("input[name=txtStartDate]").length > 0) ? $("input[name=txtStartDate]").serializeArray() : "";
                  var txtEndDate = ($("input[name=txtEndDate]").length > 0) ? $("input[name=txtEndDate]").serializeArray() : "";
                  var txtMiscInfoSpace = ($("textarea[name=txtMiscInfoSpace]").length > 0) ? $("textarea[name=txtMiscInfoSpace]").serializeArray() : "";
                  var chkIsRestrict = $("#chkIsRestrict").is(":checked");
                  var selectIndsutri = $("#selectIndustry").val();
                  var cpmQuota = ($("input[name=txtCpmQuota]").length > 0) ? $("input[name=txtCpmQuota]").serializeArray() : "";
                  var selectIndsutriCat = $("#selectIndustryCat").val();
                  var arrParam = new Array(txtAgency, txtClient, selectAds, selectKanal, selectProductGroup, selectPosition, txtStartDate, txtEndDate, chkIsRestrict, selectIndsutri, txtMiscInfo, txtMiscInfoSpace, cpmQuota, selectIndsutriCat);
            } else if (todo == "update") {
                  var txtNoSpace = $("#txtNoSpace").val();
                  var txtNoPaket = $("#txtNoPaket").val();
                  var txtAgency = $("#selectAgency").val();
                  var txtClient = $("#selectClient").val();	
                  var txtMiscInfo = $("#txtMiscInfo").val();	
                  var selectAds = ($("select[name=selectAds]").length > 0) ? $("select[name=selectAds]").serializeArray() : "";
                  var selectKanal = ($("select[name=selectKanal]").length > 0) ? $("select[name=selectKanal]").serializeArray() : "";
                  var selectProductGroup = ($("select[name=selectProductGroup]").length > 0) ? $("select[name=selectProductGroup]").serializeArray() : "";
                  var selectPosition = ($("select[name=selectPosition]").length > 0) ? $("select[name=selectPosition]").serializeArray() : "";
                  var txtStartDate = ($("input[name=txtStartDate]").length > 0) ? $("input[name=txtStartDate]").serializeArray() : "";
                  var txtEndDate = ($("input[name=txtEndDate]").length > 0) ? $("input[name=txtEndDate]").serializeArray() : "";
                  var txtMiscInfoSpace = ($("textarea[name=txtMiscInfoSpace]").length > 0) ? $("textarea[name=txtMiscInfoSpace]").serializeArray() : "";
                  var chkIsRestrict = $("#chkIsRestrict").is(":checked");
                  var selectIndsutri = $("#selectIndustry").val();
                  var cpmQuota = ($("input[name=txtCpmQuota]").length > 0) ? $("input[name=txtCpmQuota]").serializeArray() : "";
                  var selectIndsutriCat = $("#selectIndustryCat").val();
                  var arrParam = new Array(txtNoSpace, txtAgency, txtClient, selectAds, selectKanal, selectProductGroup, selectPosition, txtStartDate, txtEndDate, chkIsRestrict, selectIndsutri, txtMiscInfo, txtMiscInfoSpace, cpmQuota, selectIndsutriCat);
            } else if (todo == "progress") {
                  var hdNoSpace = $("#hdNoSpace").val();
                  var txtPercent = $("#percent").text();			
                  var arrParam = new Array(hdNoSpace, txtPercent);
            } else if (todo == "delete") {
                  var arrParam = new Array(id);
            }
      } else if (obj == "expired_space") {
            if (todo == "update") {
                  var txtNoSpace = $("#txtNoSpace").val();
                  var txtNoPaket = $("#txtNoPaket").val();
                  var txtAgency = $("#selectAgency").val();
                  var txtClient = $("#selectClient").val();	
                  var txtMiscInfo = $("#txtMiscInfo").val();	
                  var selectAds = ($("select[name=selectAds]").length > 0) ? $("select[name=selectAds]").serializeArray() : "";
                  var selectKanal = ($("select[name=selectKanal]").length > 0) ? $("select[name=selectKanal]").serializeArray() : "";
                  var selectProductGroup = ($("select[name=selectProductGroup]").length > 0) ? $("select[name=selectProductGroup]").serializeArray() : "";
                  var selectPosition = ($("select[name=selectPosition]").length > 0) ? $("select[name=selectPosition]").serializeArray() : "";
                  var txtStartDate = ($("input[name=txtStartDate]").length > 0) ? $("input[name=txtStartDate]").serializeArray() : "";
                  var txtEndDate = ($("input[name=txtEndDate]").length > 0) ? $("input[name=txtEndDate]").serializeArray() : "";
                  var txtMiscInfoSpace = ($("textarea[name=txtMiscInfoSpace]").length > 0) ? $("textarea[name=txtMiscInfoSpace]").serializeArray() : "";
                  var chkIsRestrict = $("#chkIsRestrict").is(":checked");
                  var selectIndsutri = $("#selectIndustry").val();
                  var arrParam = new Array(txtNoSpace, txtAgency, txtClient, selectAds, selectKanal, selectProductGroup, selectPosition, txtStartDate, txtEndDate, chkIsRestrict, selectIndsutri, txtMiscInfo, txtMiscInfoSpace);
            }
      } else if (obj == "request") {
            if (todo == "insert") {
                  var txtNoPaket = $("#txtNoPaket").val();
                  //var txtBrand = $("#txtBrand").val();		
                  var txtOrderType = $("input[name=rdbOrderType]:checked").val();
                  var txtDetail = $("#txtDetail").val();
                  var chkRequest = $("input[name=chkRequest]:checked").serializeArray();
                  chkRequest = (chkRequest.length > 0) ? chkRequest : "";
                  // var txtId = ($("input[name=hdId]").length > 0) ? $("input[name=hdId]").serializeArray() : "";
                  var allRequest = new Array();
                  $("input[name=chkRequest]").each(function() {
                        allRequest.push($(this).val());
                  });
                  allRequest = (allRequest.length > 0) ? allRequest : "";
                  // var arrParam = new Array(txtNoPaket, txtOrderType, txtDetail, chkRequest, allRequest, txtId);
                  var arrParam = new Array(txtNoPaket, txtOrderType, txtDetail, chkRequest, allRequest);
            } else if (todo == "delete") {
                  var arrParam = new Array(id);
            }
      } else if (obj == "backdate_request") {
            if (todo == "insert") {
                  var txtNoPaket = $("#txtNoPaket").val();
                  var txtReason = $("#txtReason").val();
                  var chkRequest = $("input[name=chkRequest]:checked").serializeArray();
                  chkRequest = (chkRequest.length > 0) ? chkRequest : "";
                  var allRequest = new Array();
                  $("input[name=chkRequest]").each(function() {
                        allRequest.push($(this).val());
                  });
                  allRequest = (allRequest.length > 0) ? allRequest : "";
                  var txtStartDate = ($("input[name=txtStartDate]").length > 0) ? $("input[name=txtStartDate]").serializeArray() : "";
                  var txtEndDate = ($("input[name=txtEndDate]").length > 0) ? $("input[name=txtEndDate]").serializeArray() : "";
                  var arrParam = new Array(txtNoPaket, txtReason, chkRequest, allRequest, txtStartDate, txtEndDate);
            } else if (todo == "delete") {
                  var arrParam = new Array(id);
            }
      } else if (obj == "brandcomm") {
            if (todo == "insert") {
                  var txtStartDate = $("input[name=txtStartDate]").val();
                  var txtEndDate = $("input[name=txtEndDate]").val();
                  var txtDetail = ($("textarea[name=txtDetail]").length > 0) ? $("textarea[name=txtDetail]").serializeArray() : "";
                  var hdItemId = ($("input[name=hdItemId]").length > 0) ? $("input[name=hdItemId]").serializeArray() : "";
                  var arrParam = new Array(txtStartDate, txtEndDate, txtDetail, hdItemId);
            } else if (todo == "update") {
                  var txtNoBrandcomm = $("#txtNoBrandcomm").val();
                  var txtStartDate = $("input[name=txtStartDate]").val();
                  var txtEndDate = $("input[name=txtEndDate]").val();
                  var txtDetail = ($("textarea[name=txtDetail]").length > 0) ? $("textarea[name=txtDetail]").serializeArray() : "";
                  var hdItemId = ($("input[name=hdItemId]").length > 0) ? $("input[name=hdItemId]").serializeArray() : "";			
                  var feedback = ($("textarea[name=txtFeedback]").length > 0) ? $("textarea[name=txtFeedback]").val() : null;
                  var hdStartDate = $("input[name=hdStartDate]").val();
                  var hdEndDate = $("input[name=hdEndDate]").val();
                  var arrParam = new Array(txtNoBrandcomm, txtStartDate, txtEndDate, txtDetail, hdItemId, feedback, hdStartDate, hdEndDate);
            } else if (todo == "progress") {
                  var hdNoBrandcomm = $("#hdNoBrandcomm").val();
                  var txtPercent = $("#percent").text();			
                  var arrParam = new Array(hdNoBrandcomm, txtPercent);
            } else if (todo == "delete") {
                  var arrParam = new Array(id);
            }	
      } else if (obj == "approve") {
            if (todo == "update") {
                  var txtNoPaket = $("#txtNoPaket").val();
                  var chkApprove = $("input[name=chkApprove]:checked").serializeArray();
                  chkApprove = (chkApprove.length > 0) ? chkApprove : "";
                  //                  var txtNoPo = ($("input[name=txtNoPo]").length > 0) ? $("input[name=txtNoPo]").serializeArray() : "";
                  var txtNoPo = new Array(10);
                  $("input[name=txtNoPo]").each(function(index) {
                        txtNoPo[index] = new Object();
                        
                        txtNoPo[index]["id"] = $(this).attr("rel");
                        txtNoPo[index]["value"] = $(this).val();
                  });
                  var arrParam = new Array(txtNoPaket, chkApprove, txtNoPo);
            } else if (todo == "unapprove") {
                  var arrParam = new Array(id);
            }
      } else if (obj == "approve_brandcomm") {
            if (todo == "update") {
                  var txtNoBrandcomm = $("#txtNoBrandcomm").val();
                  var arrParam = new Array(txtNoBrandcomm);
            } else if (todo == "unapprove") {
                  var arrParam = new Array(id);
            }
      } /* else if (obj == "order") {
		if (todo == "insert") {
			var selectPacketType = $("#selectPacketType").val();
			//var txtNoPaket = $("#txtNoPaket").val();
			var txtNoSpace = $("#txtNoSpace").val();
			var txtAgency = $("#selectAgency").val();
			var txtClient = $("#selectClient").val();
			var txtBudget = $("#txtBudget").val();
			var txtDiskon = $("#txtDiskon").val();
			var txtBenefit = $("#txtBenefit").val();
			var txtMiscInfo = $("#txtMiscInfo").val();
			var selectAds = ($("select[name=selectAds]").length > 0) ? $("select[name=selectAds]").serializeArray() : "";
			var selectKanal = ($("select[name=selectKanal]").length > 0) ? $("select[name=selectKanal]").serializeArray() : "";
			var selectProductGroup = ($("select[name=selectProductGroup]").length > 0) ? $("select[name=selectProductGroup]").serializeArray() : "";
			var selectPosition = ($("select[name=selectPosition]").length > 0) ? $("select[name=selectPosition]").serializeArray() : "";
			var txtStartDate = ($("input[name=txtStartDate]").length > 0) ? $("input[name=txtStartDate]").serializeArray() : "";
			var txtEndDate = ($("input[name=txtEndDate]").length > 0) ? $("input[name=txtEndDate]").serializeArray() : "";
			var txtMiscInfoPaket = ($("textarea[name=txtMiscInfoPaket]").length > 0) ? $("textarea[name=txtMiscInfoPaket]").serializeArray() : "";
			var chkIsRestrict = $("#chkIsRestrict").is(":checked");
			var selectIndustri = $("#selectIndustry").val();
			var arrParam = new Array(selectPacketType, txtNoSpace, txtAgency, txtClient, txtBudget, txtDiskon, txtBenefit, selectAds, selectKanal, selectProductGroup, selectPosition, txtStartDate, txtEndDate, chkIsRestrict, selectIndustri, txtMiscInfo, txtMiscInfoPaket);
		} else if (todo == "update") {
			var txtNoPaket = $("#txtNoPaket").val();
			var txtAgency = $("#selectAgency").val();
			var txtClient = $("#selectClient").val();
			var txtBudget = $("#txtBudget").val();
			var txtDiskon = $("#txtDiskon").val();
			var txtBenefit = $("#txtBenefit").val();	
			var txtMiscInfo = $("#txtMiscInfo").val();		
			var selectAds = ($("select[name=selectAds]").length > 0) ? $("select[name=selectAds]").serializeArray() : "";
			var selectKanal = ($("select[name=selectKanal]").length > 0) ? $("select[name=selectKanal]").serializeArray() : "";
			var selectProductGroup = ($("select[name=selectProductGroup]").length > 0) ? $("select[name=selectProductGroup]").serializeArray() : "";
			var selectPosition = ($("select[name=selectPosition]").length > 0) ? $("select[name=selectPosition]").serializeArray() : "";
			var txtStartDate = ($("input[name=txtStartDate]").length > 0) ? $("input[name=txtStartDate]").serializeArray() : "";
			var txtEndDate = ($("input[name=txtEndDate]").length > 0) ? $("input[name=txtEndDate]").serializeArray() : "";
			var txtMiscInfoPaket = ($("textarea[name=txtMiscInfoPaket]").length > 0) ? $("textarea[name=txtMiscInfoPaket]").serializeArray() : "";
			var chkIsRestrict = $("#chkIsRestrict").is(":checked");
			var selectIndustri = $("#selectIndustry").val();
			var arrParam = new Array(txtNoPaket, txtAgency, txtClient, txtBudget, txtDiskon, txtBenefit, selectAds, selectKanal, selectProductGroup, selectPosition, txtStartDate, txtEndDate, chkIsRestrict, selectIndustri, txtMiscInfo, txtMiscInfoPaket);
		} else if (todo == "progress") {
			var hdNoPaket = $("#hdNoPaket").val();
			var txtPercent = $("#percent").text();			
			var arrParam = new Array(hdNoPaket, txtPercent);
		} else if (todo == "delete") {
			var arrParam = new Array(id);
		}
	} */ else if (obj == "expired_paket") {
            if (todo == "update") {
                  var txtNoPaket = $("#txtNoPaket").val();
                  var txtAgency = $("#selectAgency").val();
                  var txtClient = $("#selectClient").val();
                  var txtBudget = $("#txtBudget").val();
                  var txtDiskon = $("#txtDiskon").val();
                  var txtBenefit = $("#txtBenefit").val();	
                  var txtMiscInfo = $("#txtMiscInfo").val();		
                  var selectAds = ($("select[name=selectAds]").length > 0) ? $("select[name=selectAds]").serializeArray() : "";
                  var selectKanal = ($("select[name=selectKanal]").length > 0) ? $("select[name=selectKanal]").serializeArray() : "";
                  var selectProductGroup = ($("select[name=selectProductGroup]").length > 0) ? $("select[name=selectProductGroup]").serializeArray() : "";
                  var selectPosition = ($("select[name=selectPosition]").length > 0) ? $("select[name=selectPosition]").serializeArray() : "";
                  var txtStartDate = ($("input[name=txtStartDate]").length > 0) ? $("input[name=txtStartDate]").serializeArray() : "";
                  var txtEndDate = ($("input[name=txtEndDate]").length > 0) ? $("input[name=txtEndDate]").serializeArray() : "";
                  var txtMiscInfoPaket = ($("textarea[name=txtMiscInfoPaket]").length > 0) ? $("textarea[name=txtMiscInfoPaket]").serializeArray() : "";
                  var chkIsRestrict = $("#chkIsRestrict").is(":checked");
                  var selectIndustri = $("#selectIndustry").val();
                  var arrParam = new Array(txtNoPaket, txtAgency, txtClient, txtBudget, txtDiskon, txtBenefit, selectAds, selectKanal, selectProductGroup, selectPosition, txtStartDate, txtEndDate, chkIsRestrict, selectIndustri, txtMiscInfo, txtMiscInfoPaket);
            }
      } else if (obj == "done") {
            if (todo == "update") {
                  var txtNoPaket = $("#txtNoPaket").val();
                  var txtNoPaketUser = $("#txtNoPaketUser").val();
                  var arrParam = new Array(txtNoPaket, txtNoPaketUser);
            } else if (todo == "update_brandcomm") {
                  var txtNoBrandcomm = $("#txtNoBrandcomm").val();
                  var arrParam = new Array(txtNoBrandcomm);
            }
      } else if (obj == "receive") {
            if (todo == "update") {
                  var hdId = $("#hdId").val();
                  var chkBanner = $("input[name=chkBanner]").is(":checked");
                  var chkData = $("input[name=chkData]").is(":checked");
                  var txtNote = $("#txtNote").val();
                  var arrParam = new Array(hdId, chkBanner, chkData, txtNote);
            }
      } else if (obj == "backdate_receive") {
            if (todo == "update") {
                  var hdId = $("#hdId").val();
                  var txtNoPaket = $("#txtNoPaket").val();
                  var chkApprove = $("input[name=chkApprove]:checked").serializeArray();
                  chkApprove = (chkApprove.length > 0) ? chkApprove : "";
                  var arrParam = new Array(hdId, txtNoPaket, chkApprove);
            }
      } else if (obj == "offer_position") {
            if (todo == "insert") {
                  var selectAds = $("#selectAds").val();
                  var selectKanal = $("#selectKanal").val();
                  var selectProductGroup = $("#selectProductGroup").val();
                  var selectPosition = $("#selectPosition").val();
                  var txtDimension = $("#txtDimension").val();
                  var txtSize = $("#txtSize").val();
                  var rdbRatePeriod = $("#rdbRatePeriod").val();
                  var txtGrossRate = $("#txtGrossRate").val();
                  var txtPictureName = $("#status").text();
                  var txtImp = $("#txtImp").val();
                  var txtSov = $("#txtSov").val();
                  var arrParam = new Array(selectAds, selectKanal, selectProductGroup, selectPosition, txtDimension, txtSize, rdbRatePeriod, txtGrossRate, txtPictureName, txtImp, txtSov);
            } else if (todo == "update") {
                  var hdId = $("#hdId").val();
                  var selectAds = $("#selectAds").val();
                  var selectKanal = $("#selectKanal").val();
                  var selectProductGroup = $("#selectProductGroup").val();
                  var selectPosition = $("#selectPosition").val();
                  var txtDimension = $("#txtDimension").val();
                  var txtSize = $("#txtSize").val();
                  var rdbRatePeriod = $("#rdbRatePeriod").val();
                  var txtGrossRate = $("#txtGrossRate").val();
                  var txtPictureName = $("#status").text();
                  var txtImp = $("#txtImp").val();
                  var txtSov = $("#txtSov").val();
                  var arrParam = new Array(hdId, selectAds, selectKanal, selectProductGroup, selectPosition, txtDimension, txtSize, rdbRatePeriod, txtGrossRate, txtPictureName, txtImp, txtSov);
            } else if (todo == "delete") {
                  var arrParam = new Array(id);
            }
      } else if (obj == "invoice") {
            if (todo == "insert") {
            } else if (todo == "update") {
                  var no_paket = $("#hdId").val();
                  var no_invoice = $("#noInvoice").val();
                  var jatuh_tempo = $("#txtTempo").val();
                        
                  var arrParam = new Array(no_paket, no_invoice, jatuh_tempo);
            } else if (todo == "delete") {
            }
      } else if (obj == "po") {
            if (todo == "insert") {
            } else if (todo == "update") {
                  var no_paket = $("#hdId").val();
                  var no_po = $("#noPO").val();
                  var no_so = $("#noSO").val();
                  var bukti = $("#statusBukti").text();
                  var report = $("#statusReport").text();
                        
                  var arrParam = new Array(no_paket, no_po, no_so, bukti, report);
            } else if (todo == "delete") {
            }
      } else if (obj == "production") {
            if (todo == "insert") {
                  var txtName = $("#txtName").val();
                  var txtHarga = $("#txtHarga").val();
                  var arrParam = new Array(txtName, txtHarga);
            } else if (todo == "update") {
                  var hdId = $("#hdId").val();
                  var txtName = $("#txtName").val();
                  var txtHarga = $("#txtHarga").val();
                  var arrParam = new Array(hdId, txtName, txtHarga);
            } else if (todo == "delete") {
                  var arrParam = new Array(id);
            }
      } else if (obj == "harga") {
            if (todo == "insert") {
                  var selectKanal = $("#selectKanal").val();
                  var selectProduk = $("#selectProduk").val();
                  var selectPosition = $("#selectPosition").val();
                  var txtHarga = $("#txtHarga").val();
                  var arrParam = new Array(selectKanal, selectProduk, selectPosition, txtHarga);
           } else if (todo == "update") {
                  var hdId = $("#hdId").val();
                  var selectKanal = $("#selectKanal").val();
                  var selectProduk = $("#selectProduk").val();
                  var selectPosition = $("#selectPosition").val();
                  var txtHarga = $("#txtHarga").val();
                  var arrParam = new Array(hdId, selectKanal, selectProduk, selectPosition, txtHarga);
            } else if (todo == "delete") {
                  var arrParam = new Array(id);
            }
      } else if (obj == "approve_manager") {
            if (todo == "insert") {
            } else if (todo == "update") {
                  var no_paket = $("#hdId").val();
                  var approve_manager = $("input[name=rdbApprove]:checked").val();
                        
                  var arrParam = new Array(no_paket, approve_manager);
            } else if (todo == "delete") {
            }
      }
	  
      show_loading();
      do_process(obj, todo, urlChange, urlContent, urlInsert, arrParam);
}

function do_process(obj, todo, urlChange, urlContent, urlInsert, arrParam) {
      //$("#data").html("loading..");
      var jqxhr = $.post(urlChange, {
            "arrParam" : arrParam
      },
      function(data) {
            hide_loading();
						
            if (data == null) {
                  show_dialog_confirmation("");
            } else if (data.status == true) {
                  loadContent(urlContent);
							
                  // untuk load form insert
                  loadForm(urlInsert);
							
                  // tentukan pesan yang akan ditampilkan
                  if (todo == "insert")
                        show_dialog_confirmation("Data berhasil disimpan!");
                  else if (todo == "update" || todo == "update_brandcomm") {
                        if (obj == "expired_paket")
                              show_dialog_confirmation("Data berhasil diupdate dan dipindahkan ke menu Order Paket!");
                        else if (obj == "expired_space")
                              show_dialog_confirmation("Data berhasil diupdate dan dipindahkan ke menu Order Space!");
                        else
                              show_dialog_confirmation("Data berhasil diupdate!");
                              // show_dialog_confirmation(arrParam);
                  } else if (todo == "progress")
                        show_dialog_confirmation("Progress berhasil diupdate!");
                  else if (todo == "delete")
                        show_dialog_confirmation("Data berhasil dihapus!");
            } else {
                  if (data.error == undefined)
                        show_dialog_confirmation(data.status);
                  else
                        injectError(obj, data.error);
            }
      }
      , "json");
	
      jqxhr.error(function() {
            $.fancybox({
                  "content" : "Error occurred. Try again!"
            });
            hide_loading();
      });

      return false;
}

function loadContent(url, obj) {
      var page = $("#selectPage").val();
      var orderBy = $("#selectOrderBy").val();
      var type = $("#selectType").val();
      //      var month = $("#selectMonth").val();
      //      var year = $("#selectYear").val();
      var startDate = $("#txtStartDate").val();
      var endDate = $("#txtEndDate").val();
	
      // jika undefined atau event dari orderby, kosongkan nilainya
      if (page == undefined || obj == "orderby")
            page = "1";
		
      if (orderBy == undefined)
            orderBy = "ALL";
      else if (orderBy == "nopaket")
            orderBy = $("#txtSearch").val();
	
      //url = url +"/"+page+"/"+orderBy;
	
      // untuk show loading icon
      $("#data").html("<p><div align='center'><div class='loading'>&nbsp;</div>loading..</div></p>");
      var jqxhr = $.post(url, {
            "page" : page, 
            "orderby" : orderBy, 
            "type" : type, 
            //            "month" : month, 
            //            "year" : year
            "start_date" : startDate, 
            "end_date" : endDate
      },
      function(data) {
            $("#data").hide();
            if (data == "")
                  $("#data").html("");
            else 
                  $("#data").html(data);
            $("#data").fadeIn("slow");
      }
      );
	
      jqxhr.error(function() {
            $.fancybox({
                  "content" : "Error occurred. Try again!"
            });
            $("#data").hide();
      });
	
      return false;
}

function do_search(obj, url) {
      if (obj == "order") {
            var selectAe = $("#selectAe").val();
            var arrParam = new Array(selectAe);
      } else if (obj == "request") {
            var selectAgency = $("#selectAgency").val();
            var selectClient = $("#selectClient").val();
            var arrParam = new Array(selectAgency, selectClient);
      }
	
      show_loading();
      var jqxhr = $.post(url, {
            "arrParam" : arrParam
      },
      function(data) {
            hide_loading();
            $("#addme").html(data);
      }
      );
	
      jqxhr.error(function() {
            $.fancybox({
                  "content" : "Error occurred. Try again!"
            });
            hide_loading();
      });

      return false;
}

function loadShow(url, id, kanal_id, product_group_id, position_id, start_date, end_date) {
      if (id == undefined)
            id = "";
      if (kanal_id == undefined)
            kanal_id = "";
      if (product_group_id == undefined)
            product_group_id = "";
      if (position_id == undefined)
            position_id = "";
      if (start_date == undefined)
            start_date = "";
      if (end_date == undefined)
            end_date = "";
	
      // untuk show loading icon dan dialog box
      $("#show").html("<p><div align='center'><div class='loading'>&nbsp;</div>loading..</div></p>");
      $("#show").dialog({
            modal: true,
            width: "auto",
            buttons: {
                  Tutup: function() {
                        $(this).dialog("close");
                  }
            }
      });
	
      var jqxhr = $.post(url, {
            "id" : id,
            "kanal_id" : kanal_id,
            "product_group_id" : product_group_id,
            "position_id" : position_id,
            "start_date" : start_date,
            "end_date" : end_date
      },
      function(data) {
            if (data == "")
                  data = "";
									
            $("#show").html(data);
            $("#show").dialog({
                  position: ['center', 'center']
            });
      }
      );
	
      jqxhr.error(function() {
            $.fancybox({
                  "content" : "Error occurred. Try again!"
            });
            $("#show").dialog("close");
      });

      return false;
}

function loadForm(url, id) {
      if (id == undefined)
            id = "";
	
      //var url = (id != "") ? url+"/"+id : url;
	
      // untuk show loading icon
      $(".box_form").html("<p><div align='center'><div class='loading'>&nbsp;</div>loading..</div></p>");
      var jqxhr = $.post(url, {
            "id" : id
      },
      function(data) {
            $(".box_form").hide();
            if (data == "")
                  $(".box_form").html("");
            else
                  $(".box_form").html(data);
            $(".box_form").fadeIn("slow");
      }
      );
	
      jqxhr.error(function() {
            $.fancybox({
                  "content" : "Error occurred. Try again!"
            });
            $(".box_form").hide();
      });

      return false;
}

function loadListOption2(url, idSource, idDestination) {	
      var id = $("#"+idSource).val();
      var url = url+"/"+id;
	
      var jqxhr = $.get(url,
            function(data) {
                  $("."+idDestination).html(data);
                  if (idDestination == "list_rubrik")
                        $("#selectRubrikDestination").empty();
            }
            );
	
      jqxhr.complete(function() {
            $("."+idDestination).trigger("change");
      });
	
      jqxhr.error(function() {
            $.fancybox({
                  "content" : "Error occurred. Try again!"
            });
      });
	
      return false;
}

function loadListOption3(url, idSource, idDestination) {
      var id = $("#"+idSource).val();
      var url = url+"/"+id;
	
      var jqxhr = $.get(url,
            function(data) {
                  $("#"+idDestination).html(data);
            }
            );
	
      jqxhr.complete(function() {
            $("#"+idDestination).trigger("change");
      });
	
      jqxhr.error(function() {
            $.fancybox({
                  "content" : "Error occurred. Try again!"
            });
      });
	
      return false;
}

function loadDetail(url, id, toreplace) {
      //var url = url+"/"+no_paket;
	
      if (toreplace == undefined)
            toreplace = "#addme";
	
      var jqxhr = $.post(url, {
            "id" : id
      },
      function(data) {
            $(toreplace).html(data);
      }
      );
	
      jqxhr.error(function() {
            $.fancybox({
                  "content" : "Error occurred. Try again!"
            });
      });
	
      return false;
}

function loadListOption(index, url, idSource, idDestination) {
      var id = $("#addme tr").eq(index).children().children("#"+idSource).val();
      var url = url+"/"+id;
	
      var jqxhr = $.get(url,
            function(data) {
                  $("#addme tr").eq(index).children().children("#"+idDestination).html(data);
            }
            );
	
      jqxhr.complete(function() {
            $("#"+idDestination).trigger("change", [index]);
      });
	
      jqxhr.error(function() {
            $.fancybox({
                  "content" : "Error occurred. Try again!"
            });
      });
	
      return false;
}

function injectError(obj, error) {
      if (obj == "client") {
            $("#errTxtName").text("* required");
      } else if (obj == "agency") {
            $("#errTxtName").text("* required");
      } else if (obj == "department") {
            $("#errTxtName").text("* required");
      } else if (obj == "level") {
            $("#errTxtName").text("");
            $("#errTxtAccess").text("");
		
            for (var index in error) {
                  if (error[index] == "txtName")
                        $("#errTxtName").text("* required");
                  if (error[index] == "txtAccess")
                        $("#errTxtAccess").text("* required");
            }
      } else if (obj == "user") {
            $("#errTxtUsername").text("");
            $("#errTxtPassword").text("");
		
            for (var index in error) {
                  if (error[index] == "txtUsername")
                        $("#errTxtUsername").text("* required");
                  if (error[index] == "txtPassword")
                        $("#errTxtPassword").text("* required");
            }
      } else if (obj == "ads") {
            $("#errTxtName").text("* required");
      } else if (obj == "kanal") {
            $("#errTxtName").text("");
            $("#errTxtRubrik").text("");
		
            for (var index in error) {
                  if (error[index] == "txtName")
                        $("#errTxtName").text("* required");
                  if (error[index] == "txtRubrik")
                        $("#errTxtRubrik").text("* some field(s) empty");
            }
      } else if (obj == "position") {
            $("#errTxtName").text("* required");
      } else if (obj == "productgroup") {
            $("#errTxtName").text("");
            $("#errTxtRubrik").text("");
            $("#errTxtPosition").text("");
		
            for (var index in error) {
                  if (error[index] == "txtName")
                        $("#errTxtName").text("* required");
                  if (error[index] == "txtRubrik")
                        $("#errTxtRubrik").text("* required");
                  if (error[index] == "txtPosition")
                        $("#errTxtPosition").text("* required");
            }
      } else if (obj == "industry_cat") {
            $("#errTxtName").text("");
            $("#errTxtSubIndustry").text("");
		
            for (var index in error) {
                  if (error[index] == "txtName")
                        $("#errTxtName").text("* required");
                  if (error[index] == "txtSubIndustry")
                        $("#errTxtSubIndustry").text("* required");
            }
      } else if (obj == "industry") {
            $("#errTxtName").text("* required");
      } else if (obj == "conflictbrand") {
            for (var index in error) {
                  if (error[index] == "txtRule")
                        $("#errTxtRule").text("* rule(s) have not been added");
                  if (error[index] == "txtEmpty")
                        $("#errTxtRule").text("* some rule(s) empty");
            }
      } else if (obj == "masterbrandcomm") {
            //            $("#errTxtItem").text("* required");
            for (var index in error) {
                  if (error[index] == "txtItem")
                        $("#errTxtItem").text("* required");
                  if (error[index] == "selectNumberOrder")
                        $("#errSelectNumberOrder").text("* required");
            }
      } else if (obj == "cpm") {
            $("#errTxtCpmQuota").text("* required");
      } else if (obj == "order" || obj == "expired_paket") {
            $("#errTxtAgency").text("");
            $("#errTxtClient").text("");
            $("#errTxtBudget").text("");
            $("#errTxtCampaign").text("");
            $("#errTxtDiskon").text("");
            $("#errTxtBenefit").text("");
            $("#errPaket").text("");
            //$("#errTxtNoPaket").text("");
            $("#errTxtNo").text("");
            $("#errSelectIndustryCat").text("* required");
            $("#errSelectIndustry").text("* required");
            for (var n=0; n<error["tot_row"]; n++)
                  $("#addme tr").eq(n).children().children("#errConflict").text("");
		
            for (var index in error) {
                  if (error[index] == "txtNo")
                        $("#errTxtNo").text("* required");
                  if (error[index] == "txtValidNo")
                        $("#errTxtNo").text("* number not valid");
                  /*if (error[index] == "txtNoPaket")
				$("#errTxtNoPaket").text("* required");*/
                  if (error[index] == "txtAgency")
                        $("#errTxtAgency").text("* required");
                  if (error[index] == "txtClient")
                        $("#errTxtClient").text("* required");
                  // if (error[index] == "txtDiskon")
                        // $("#errTxtDiskon").text("* required");
                  if (error[index] == "txtCampaign")
                        $("#errTxtCampaign").text("* required");
                  if (error[index] == "txtDate")
                        $("#errPaket").text("* some field(s) empty");
                  if (error[index] == "txtConflict") {
                        var idConflict = error["idConflict"].split(",");
                        for (var n in idConflict)				
                              $("#addme tr").eq(idConflict[n]).children().children("#errConflict").text("* packet conflict");
                  }
                  if (error[index] == "txtInUse") {
                        var idInUse = error["idInUse"].split(",");
                        for (var n in idInUse)				
                              $("#addme tr").eq(idInUse[n]).children().children("#errConflict").text("* packet in use");
                  }
                  if (error[index] == "txtCpmEmpty") {
                        var idInCpmQuotaEmpty = error["idCpmQuotaEmpty"].split(",");
                        for (var n in idInCpmQuotaEmpty)
                              $("#addme tr").eq(idInCpmQuotaEmpty[n]).children().children("#errConflict").text("* quota can not be empty");
                  }
                  if (error[index] == "txtCpm") {
                        var idInCpmQuota = error["idCpmQuota"].split(",");
                        for (var n in idInCpmQuota)
                              $("#addme tr").eq(idInCpmQuota[n]).children().children("#errConflict").text("* exceeded quota");
                  }
                  if (error[index] == "txtDateWrong") {
                        var idDateWrong = error["idDateWrong"].split(",");
                        for (var n in idDateWrong)				
                              $("#addme tr").eq(idDateWrong[n]).children().children("#errConflict").text("* wrong date range");
                  }
            }
      } else if (obj == "orderspace" || obj == "expired_space") {
            //$("#errNoSpace").text("");
            $("#errTxtAgency").text("");
            $("#errTxtClient").text("");
            $("#errSpace").text("");
            for (var n=0; n<error["tot_row"]; n++)
                  $("#addme tr").eq(n).children().children("#errConflict").text("");
		
            for (var index in error) {
                  /*if (error[index] == "txtNoSpace")
				$("#errNoSpace").text("* required");*/
                  if (error[index] == "txtAgency")
                        $("#errTxtAgency").text("* required");
                  if (error[index] == "txtClient")
                        $("#errTxtClient").text("* required");
                  if (error[index] == "txtDate")
                        $("#errSpace").text("* some field(s) empty");
                  if (error[index] == "txtConflict") {
                        var idConflict = error["idConflict"].split(",");
                        for (var n in idConflict)
                              $("#addme tr").eq(idConflict[n]).children().children("#errConflict").text("* packet conflict");
                  }
                  if (error[index] == "txtInUse") {
                        var idInUse = error["idInUse"].split(",");
                        for (var n in idInUse)				
                              $("#addme tr").eq(idInUse[n]).children().children("#errConflict").text("* packet in use");
                  }
                  if (error[index] == "txtCpmEmpty") {
                        var idInCpmQuotaEmpty = error["idCpmQuotaEmpty"].split(",");
                        for (var n in idInCpmQuotaEmpty)
                              $("#addme tr").eq(idInCpmQuotaEmpty[n]).children().children("#errConflict").text("* quota can not be empty");
                  }
                  if (error[index] == "txtCpm") {
                        var idInCpmQuota = error["idCpmQuota"].split(",");
                        for (var n in idInCpmQuota)
                              $("#addme tr").eq(idInCpmQuota[n]).children().children("#errConflict").text("* exceeded quota");
                  }
                  if (error[index] == "txtDateWrong") {
                        var idDateWrong = error["idDateWrong"].split(",");
                        for (var n in idDateWrong)
                              $("#addme tr").eq(idDateWrong[n]).children().children("#errConflict").text("* wrong date range");
                  }
            }
      } else if (obj == "brandcomm") {
            $("#errTxtStartDate").text("");
            $("#errTxtEndDate").text("");
            $("#errTxtWrongDateRange").text("");
            $("#errTxtFeedback").text("");
            for (var n=0; n<error["tot_row"]; n++)
                  $("#addme tr").eq(n).children().children("#errTxtDetail").text("");
		
            for (var index in error) {
                  if (error[index] == "txtStartDate")
                        $("#errTxtStartDate").text("* required");
                  if (error[index] == "txtEndDate")
                        $("#errTxtEndDate").text("* required");
                  if (error[index] == "txtWrongDateRange")
                        $("#errTxtWrongDateRange").text("* wrong date range");
                  if (error[index] == "txtDetail") {
                        var idItem = error["idItem"].split(",");
                        for (var n in idItem)				
                              $("#addme tr").eq(idItem[n]).children().children("#errTxtDetail").text("* required");
                  }
                  if (error[index] == "txtNotFeedback")
                        $("#errTxtWrongDateRange").text("* there are brandcomm that has not been feedback");
                  if (error[index] == "txtFeedback")
                        $("#errTxtFeedback").text("* required");
            }
      } else if (obj == "request") {
            $("#errTxtNoPaket").text("");
            //            $("#errTxtBrand").text("");
            $("#errTxtOrderType").text("");
            $("#errPaket").text("");
            //            for (var n=0; n<error["tot_row"]; n++)
            //                  $("#addme tr").eq(n).children().children("#errConflict").text("");
		
            for (var index in error) {
                  if (error[index] == "txtNoPaket")
                        $("#errTxtNoPaket").text("* required");
                  if (error[index] == "txtValidPaket")
                        $("#errTxtNoPaket").text("* paket not valid");
                  /*if (error[index] == "txtBrand")
				$("#errTxtBrand").text("* required");*/
                  if (error[index] == "txtRequestType")
                        $("#errTxtOrderType").text("* required");
                  //                  if (error[index] == "txtDate")
                  //                        $("#errPaket").text("* some field(s) empty");
                  if (error[index] == "txtTotalRequest")
                        $("#errPaket").text("* some field(s) empty");
            //                  if (error[index] == "txtConflict") {
            //                        var idConflict = error["idConflict"].split(",");
            //                        for (var n in idConflict)				
            //                              $("#addme tr").eq(idConflict[n]).children().children("#errConflict").text("* packet conflict");
            //                  }
            //                  if (error[index] == "txtInUse") {
            //                        var idInUse = error["idInUse"].split(",");
            //                        for (var n in idInUse)				
            //                              $("#addme tr").eq(idInUse[n]).children().children("#errConflict").text("* packet in use");
            //                  }
            //                  if (error[index] == "txtDateWrong") {
            //                        var idDateWrong = error["idDateWrong"].split(",");
            //                        for (var n in idDateWrong)
            //                              $("#addme tr").eq(idDateWrong[n]).children().children("#errConflict").text("* wrong date range");
            //                  }
            }
      } else if (obj == "backdate_request") {
            $("#errTxtNoPaket").text("");
            $("#errPaket").text("");
            $("#errReason").text("");
            for (var n=0; n<error["tot_row"]; n++)
                  $("#listpaket tr").eq(n).children().children("#errConflict").text("");
		
            for (var index in error) {
                  if (error[index] == "txtNoPaket")
                        $("#errTxtNoPaket").text("* required");
                  if (error[index] == "txtValidPaket")
                        $("#errTxtNoPaket").text("* paket not valid");
                  if (error[index] == "txtTotalRequest")
                        $("#errPaket").text("* some field(s) empty");
                  if (error[index] == "txtConflict") {
                        var idConflict = error["idConflict"].split(",");
                        for (var n in idConflict)				
                              $("#listpaket tr").eq(idConflict[n]).children().children("#errConflict").text("* packet conflict");
                  }
                  if (error[index] == "txtInUse") {
                        var idInUse = error["idInUse"].split(",");
                        for (var n in idInUse)				
                              $("#listpaket tr").eq(idInUse[n]).children().children("#errConflict").text("* packet in use");
                  }
                  if (error[index] == "txtCpm") {
                        var idInCpmQuota = error["idCpmQuota"].split(",");
                        for (var n in idInCpmQuota)
                              $("#listpaket tr").eq(idInCpmQuota[n]).children().children("#errConflict").text("* exceeded quota");
                  }
                  if (error[index] == "txtDateWrong") {
                        var idDateWrong = error["idDateWrong"].split(",");
                        for (var n in idDateWrong)
                              $("#listpaket tr").eq(idDateWrong[n]).children().children("#errConflict").text("* wrong date range");
                  }
                  if (error[index] == "txtReason")
                        $("#errReason").text("* required");
            }
      } else if (obj == "backdate_receive") {
            $("#errPaket").text("");
            
            for (var index in error) {
                  if (error[index] == "txtPaketAds")
                        $("#errPaket").text("* no selected");
                  if (error[index] == "txtApprove")
                        $("#errPaket").text("* packet was approved");
            }
      } else if (obj == "approve") {
            $("#errPaket").text("");
            $("#errNotFeedback").text("");
            for (var n=0; n<error["tot_row"]; n++)
                  $("#addme tr").eq(n).children().children("#errConflict").text("");
		
            for (var index in error) {
                  if (error[index] == "txtPaket")
                        $("#errPaket").text("* no selected");
                  if (error[index] == "txtNoPo")
                        $("#errNoPo").text("* required");
                  if (error[index] == "txtConflict") {
                        var idConflict = error["idConflict"].split(",");
                        for (var n in idConflict)				
                              $("#addme tr").eq(idConflict[n]).children().children("#errConflict").text("* packet conflict");
                  }
                  if (error[index] == "txtInUse") {
                        var idInUse = error["idInUse"].split(",");
                        for (var n in idInUse)				
                              $("#addme tr").eq(idInUse[n]).children().children("#errConflict").text("* packet in use");
                  }
                  if (error[index] == "txtCpm") {
                        var idInCpmQuota = error["idCpmQuota"].split(",");
                        for (var n in idInCpmQuota)
                              $("#addme tr").eq(idInCpmQuota[n]).children().children("#errConflict").text("* exceeded quota");
                  }
                  if (error[index] == "txtPassApprove")
                        $("#errPassApprove").text("* this brandcomm has not been feedback");
                  if (error[index] == "txtPassDone")
                        $("#errPassApprove").text("* this brandcomm has not been done");
            }
      } else if (obj == "approve_brandcomm") {
            $("#errApproveBrandcomm").text("* this brandcomm has not been feedback");
      } else if (obj == "done") {
            $("#errTxtNoPaket").text("");
            $("#errTxtNoPaketUser").text("");
		
            for (var index in error) {
                  if (error[index] == "txtNoPaket")
                        $("#errTxtNoPaket").text("* required");
                  if (error[index] == "txtNoPaketUser")
                        $("#errTxtNoPaketUser").text("* required");
            }
      } else if (obj == "production") {
            $("#errTxtName").text("* required");
            $("#errTxtHarga").text("* required");
      } else if (obj == "harga") {
            $("#errSelectKanal").text("* required");
            $("#errSelectPosition").text("* required");
	  }
}

function loadHargaProd(index, url, idSource, idDestination) {
      var id = $("#addmeProduction tr").eq(index).children().children("#"+idSource).val();
      var url = url+"/"+id;
	
      var jqxhr = $.get(url,
            function(data) {
                  $("#addmeProduction tr").eq(index).children().children("#"+idDestination).html(data);
            }
            );
	
      jqxhr.complete(function() {
            $("#"+idDestination).trigger("change", [index]);
      });
	
      jqxhr.error(function() {
            $.fancybox({
                  "content" : "Error occurred. Try again!"
            });
      });
	
      return "Changed";
}

function loadHargaPaket(index, url, idKanal, idProduct, idPosition, idDestination) {
      var kanal = $("#addme tr").eq(index).children().children("#"+idKanal).val();
      var product = $("#addme tr").eq(index).children().children("#"+idProduct).val();
      var position = $("#addme tr").eq(index).children().children("#"+idPosition).val();
      var url = url+"/"+kanal+"/"+product+"/"+position;
	
      var jqxhr = $.get(url,
            function(data) {
                  $("#addme tr").eq(index).children().children("#"+idDestination).html(data);
            }
            );
	
      jqxhr.complete(function() {
            $("#"+idDestination).trigger("change", [index]);
      });
	
      jqxhr.error(function() {
            $.fancybox({
                  "content" : "Error occurred. Try again!"
            });
      });
	  
      return "Changed";
}