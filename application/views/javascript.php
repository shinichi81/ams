<?php

if ($this->uri->segment(1) == "order") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("order/content") . "');
				loadForm('" . site_url("order/insert_page") . "');
								
				function gantiHarga()	{
					var harga = parseInt(document.getElementById('hargaGross').value);
					var diskon = parseInt(document.getElementById('txtDiskon').value);
					var diskonLain = parseInt(document.getElementById('txtAddDiskon').value);
					var diskonNominal = (diskon / 100) * harga;
					var hargaDiskon = harga - diskonNominal;
					var diskonLainNominal = (diskonLain / 100) * hargaDiskon;
					var hargaTotal = hargaDiskon - diskonLainNominal;
					document.getElementById('diskonNominal').value = diskonNominal.formatMoney(0);
					document.getElementById('addDiskonNominal').value = diskonLainNominal.formatMoney(0);
					document.getElementById('totalHarga').value = hargaTotal.formatMoney(0);
				}
				
				function hitungTotal() {
					var totalPaket = document.getElementById('totalHarga').value;
					totalPaket = parseInt(totalPaket.toString().split('.').join(''));
					var totalProduction = document.getElementById('totalProduction').value;
					totalProduction = parseInt(totalProduction.toString().split('.').join(''));
					var totalEvent = document.getElementById('totalEvent').value;
					totalEvent = parseInt(totalEvent.toString().split('.').join(''));
					var total = (totalPaket + totalProduction + totalEvent);
					var pajak = total * 10 / 100;
					var akhir = total + pajak;
					document.getElementById('pajak').value = pajak.formatMoney(0);
					document.getElementById('akhir').value = akhir.formatMoney(0);
				}

				$(document).ready(function() {
					$('#selectPage').live('change', function() {
						loadContent('" . site_url("order/content") . "');
					});
					$('#selectOrderBy').live('change', function() {
						if ($(this).val() == 'nopaket')
							$('#txtSearch').show();
						else {
							$('#txtSearch').hide();
							loadContent('" . site_url("order/content") . "', 'orderby');
						}
					});
					$('#txtSearch').live('keypress', function(e) {
						if (e.keyCode == 13 || e.charCode == 13)
							loadContent('" . site_url("order/content") . "', 'orderby');
					});
                                        
                                                                              $('#show_cpm').die('click').live('click', function() {
                                                                                    var kanal_id = $(this).parents('.remove').find('#selectKanal').val();
                                                                                    var product_group_id = $(this).parents('.remove').find('#selectProductGroup').val();
                                                                                    var position_id = $(this).parents('.remove').find('#selectPosition').val();
                                                                                    var start_date = $(this).parents('.remove').find('.txtStartDate').val();
                                                                                    var end_date = $(this).parents('.remove').find('.txtEndDate').val();

                                                                                    loadShow('" . site_url("order/cpm_page") . "', '', kanal_id, product_group_id, position_id, start_date, end_date); 
                                                                              });

				});
			</script>";
} else if ($this->uri->segment(1) == "approve") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("approve/content") . "');
				loadForm('" . site_url("approve/insert_page") . "');
				
				$(document).ready(function() {
					$('select[name=selectPage]').live('change', function() {
						loadContent('" . site_url("approve/content") . "');
					});
                                                                                $('select[name=selectPageBrandcomm]').live('change', function() {
						loadContent('" . site_url("approve/content_brandcomm") . "');
					});
					$('#selectOrderBy').live('change', function() {
						if ($(this).val() == 'nopaket')
							$('#txtSearch').show();
						else {
							$('#txtSearch').hide();
							loadContent('" . site_url("approve/content") . "', 'orderby');
						}
					});
					$('#txtSearch').live('keypress', function(e) {
						if (e.keyCode == 13 || e.charCode == 13)
							loadContent('" . site_url("approve/content") . "', 'orderby');
					});
					$('#selectType').change(function() {
						if ($(this).val() == 'paket')
							loadContent('" . site_url("approve/content") . "');
						else
							loadContent('" . site_url("approve/content_brandcomm") . "');
						
						loadForm('" . site_url("approve/insert_page") . "');
					});
				});
			</script>";
} else if ($this->uri->segment(1) == "done") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("done/content") . "');
				loadForm('" . site_url("done/insert_page") . "');
				
				$(document).ready(function() {
					$('select[name=selectPage]').live('change', function() {
						loadContent('" . site_url("done/content") . "');
					});
                                                                                $('select[name=selectPageBrandcomm]').live('change', function() {
						loadContent('" . site_url("done/content_brandcomm") . "');
					});
					$('#selectOrderBy').live('change', function() {
						if ($(this).val() == 'nopaket')
							$('#txtSearch').show();
						else {
							$('#txtSearch').hide();
							loadContent('" . site_url("done/content") . "', 'orderby');
						}
					});
					$('#txtSearch').live('keypress', function(e) {
						if (e.keyCode == 13 || e.charCode == 13)
							loadContent('" . site_url("done/content") . "', 'orderby');
					});
					$('#selectType').change(function() {
						if ($(this).val() == 'paket')
							loadContent('" . site_url("done/content") . "');
						else
							loadContent('" . site_url("done/content_brandcomm") . "');
						
						loadForm('" . site_url("done/insert_page") . "');
					});
				});
			</script>";
} else if ($this->uri->segment(1) == "brandcomm") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("brandcomm/content") . "');
				loadForm('" . site_url("brandcomm/insert_page") . "');
				
				$(document).ready(function() {
					$('#selectPage').live('change', function() {
						loadContent('" . site_url("brandcomm/content") . "');
					});
					$('#selectOrderBy').live('change', function() {
						if ($(this).val() == 'nopaket')
							$('#txtSearch').show();
						else {
							$('#txtSearch').hide();
							loadContent('" . site_url("brandcomm/content") . "', 'orderby');
						}
					});
					$('#txtSearch').live('keypress', function(e) {
						if (e.keyCode == 13 || e.charCode == 13)
							loadContent('" . site_url("brandcomm/content") . "', 'orderby');
					});
				});
			</script>";
} else if ($this->uri->segment(1) == "request") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("request/content") . "');
				loadForm('" . site_url("request/insert_page") . "');
				
				$(document).ready(function() {
					$('#selectPage').live('change', function() {
						loadContent('" . site_url("request/content") . "');
					});
					$('#selectOrderBy').live('change', function() {
						if ($(this).val() == 'nopaket')
							$('#txtSearch').show();
						else {
							$('#txtSearch').hide();
							loadContent('" . site_url("request/content") . "', 'orderby');
						}
					});
					$('#txtSearch').live('keypress', function(e) {
						if (e.keyCode == 13 || e.charCode == 13)
							loadContent('" . site_url("request/content") . "', 'orderby');
					});
				});
			</script>";
} else if ($this->uri->segment(1) == "backdate_request") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("backdate_request/content") . "');
				loadForm('" . site_url("backdate_request/insert_page") . "');
				
				$(document).ready(function() {
					$('#selectPage').live('change', function() {
						loadContent('" . site_url("backdate_request/content") . "');
					});
					$('#selectOrderBy').live('change', function() {
						if ($(this).val() == 'nopaket')
							$('#txtSearch').show();
						else {
							$('#txtSearch').hide();
							loadContent('" . site_url("backdate_request/content") . "', 'orderby');
						}
					});
					$('#txtSearch').live('keypress', function(e) {
						if (e.keyCode == 13 || e.charCode == 13)
							loadContent('" . site_url("backdate_request/content") . "', 'orderby');
					});
				});
			</script>";
} else if ($this->uri->segment(1) == "receive") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("receive/content") . "');
				loadForm('" . site_url("receive/insert_page") . "');
				
				$(document).ready(function() {
					$('#selectPage').live('change', function() {
						loadContent('" . site_url("receive/content") . "');
					});
					$('#selectOrderBy').live('change', function() {
						if ($(this).val() == 'nopaket')
							$('#txtSearch').show();
						else {
							$('#txtSearch').hide();
							loadContent('" . site_url("receive/content") . "', 'orderby');
						}
					});
					$('#txtSearch').live('keypress', function(e) {
						if (e.keyCode == 13 || e.charCode == 13)
							loadContent('" . site_url("receive/content") . "', 'orderby');
					});
				});
			</script>";
} else if ($this->uri->segment(1) == "backdate_receive") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("backdate_receive/content") . "');
				loadForm('" . site_url("backdate_receive/insert_page") . "');
				
				$(document).ready(function() {
					$('#selectPage').live('change', function() {
						loadContent('" . site_url("backdate_receive/content") . "');
					});
					$('#selectOrderBy').live('change', function() {
						if ($(this).val() == 'nopaket')
							$('#txtSearch').show();
						else {
							$('#txtSearch').hide();
							loadContent('" . site_url("backdate_receive/content") . "', 'orderby');
						}
					});
					$('#txtSearch').live('keypress', function(e) {
						if (e.keyCode == 13 || e.charCode == 13)
							loadContent('" . site_url("backdate_receive/content") . "', 'orderby');
					});
				});
			</script>";
} else if ($this->uri->segment(1) == "order_space") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("order_space/content") . "');
				loadForm('" . site_url("order_space/insert_page") . "');
				
				$(document).ready(function() {
					$('#selectPage').live('change', function() {
						loadContent('" . site_url("order_space/content") . "');
					});
					$('#selectOrderBy').live('change', function() {
						if ($(this).val() == 'nopaket')
							$('#txtSearch').show();
						else {
							$('#txtSearch').hide();
							loadContent('" . site_url("order_space/content") . "', 'orderby');
						}
					});
					$('#txtSearch').live('keypress', function(e) {
						if (e.keyCode == 13 || e.charCode == 13)
							loadContent('" . site_url("order_space/content") . "', 'orderby');
					});
                                        
                                                                              $('#show_cpm').die('click').live('click', function() {
                                                                                    var kanal_id = $(this).parents('.remove').find('#selectKanal').val();
                                                                                    var product_group_id = $(this).parents('.remove').find('#selectProductGroup').val();
                                                                                    var position_id = $(this).parents('.remove').find('#selectPosition').val();
                                                                                    var start_date = $(this).parents('.remove').find('.txtStartDate').val();
                                                                                    var end_date = $(this).parents('.remove').find('.txtEndDate').val();

                                                                                    loadShow('" . site_url("order/cpm_page") . "', '', kanal_id, product_group_id, position_id, start_date, end_date); 
                                                                              });
				});
			</script>";
} else if ($this->uri->segment(1) == "expired_paket") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("expired_paket/content") . "');
				loadForm('" . site_url("expired_paket/insert_page") . "');
				
				$(document).ready(function() {
					$('#selectPage').live('change', function() {
						loadContent('" . site_url("expired_paket/content") . "');
					});
					$('#txtSearch').live('keypress', function(e) {
						if (e.keyCode == 13 || e.charCode == 13)
							loadContent('" . site_url("expired_paket/content") . "');
					});
				});
			</script>";
} else if ($this->uri->segment(1) == "expired_space") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("expired_space/content") . "');
				loadForm('" . site_url("expired_space/insert_page") . "');
				
				$(document).ready(function() {
					$('#selectPage').live('change', function() {
						loadContent('" . site_url("expired_space/content") . "');
					});
					$('#txtSearch').live('keypress', function(e) {
						if (e.keyCode == 13 || e.charCode == 13)
							loadContent('" . site_url("expired_space/content") . "');
					});
				});
			</script>";
} else if ($this->uri->segment(1) == "master_ads") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("master_ads/content") . "');
				loadForm('" . site_url("master_ads/insert_page") . "');
				
				$(document).ready(function() {
					$('#selectPage').live('change', function() {
						loadContent('" . site_url("master_ads/content") . "');
					});
				});
			</script>";
} else if ($this->uri->segment(1) == "master_agency") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("master_agency/content") . "');
				loadForm('" . site_url("master_agency/insert_page") . "');
				
				$(document).ready(function() {
					$('#selectPage').live('change', function() {
						loadContent('" . site_url("master_agency/content") . "');
					});
					$('#selectOrderBy').live('change', function() {
						if ($(this).val() == 'nopaket')
							$('#txtSearch').show();
						else {
							$('#txtSearch').hide();
							loadContent('" . site_url("master_agency/content") . "', 'orderby');
						}
					});
					$('#txtSearch').live('keypress', function(e) {
						if (e.keyCode == 13 || e.charCode == 13)
							loadContent('" . site_url("master_agency/content") . "', 'orderby');
					});
				});
			</script>";
} else if ($this->uri->segment(1) == "master_client") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("master_client/content") . "');
				loadForm('" . site_url("master_client/insert_page") . "');
				
				$(document).ready(function() {
					$('#selectPage').live('change', function() {
						loadContent('" . site_url("master_client/content") . "');
					});
					$('#selectOrderBy').live('change', function() {
						if ($(this).val() == 'nopaket')
							$('#txtSearch').show();
						else {
							$('#txtSearch').hide();
							loadContent('" . site_url("master_client/content") . "', 'orderby');
						}
					});
					$('#txtSearch').live('keypress', function(e) {
						if (e.keyCode == 13 || e.charCode == 13)
							loadContent('" . site_url("master_client/content") . "', 'orderby');
					});
				});
			</script>";
} else if ($this->uri->segment(1) == "master_conflictbrand") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("master_conflictbrand/content") . "');
				loadForm('" . site_url("master_conflictbrand/insert_page") . "');
				
				$(document).ready(function() {
					$('#selectPage').live('change', function() {
						loadContent('" . site_url("master_conflictbrand/content") . "');
					});
					$('#selectOrderBy').live('change', function() {
						if ($(this).val() == 'nopaket')
							$('#txtSearch').show();
						else {
							$('#txtSearch').hide();
							loadContent('" . site_url("master_conflictbrand/content") . "', 'orderby');
						}
					});
					$('#txtSearch').live('keypress', function(e) {
						if (e.keyCode == 13 || e.charCode == 13)
							loadContent('" . site_url("master_conflictbrand/content") . "', 'orderby');
					});
				});
			</script>";
} else if ($this->uri->segment(1) == "master_brandcomm") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("master_brandcomm/content") . "');
				loadForm('" . site_url("master_brandcomm/insert_page") . "');
				
				$(document).ready(function() {
					$('#selectPage').live('change', function() {
						loadContent('" . site_url("master_brandcomm/content") . "');
					});
				});
			</script>";
} else if ($this->uri->segment(1) == "master_cpm") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("master_cpm/content") . "');
				loadForm('" . site_url("master_cpm/insert_page") . "');
				
				$(document).ready(function() {
					$('#selectPage').live('change', function() {
						loadContent('" . site_url("master_cpm/content") . "');
					});
					$('#selectOrderBy').live('change', function() {
						if ($(this).val() == 'nopaket')
							$('#txtSearch').show();
						else {
							$('#txtSearch').hide();
							loadContent('" . site_url("master_cpm/content") . "', 'orderby');
						}
					});
					$('#txtSearch').live('keypress', function(e) {
						if (e.keyCode == 13 || e.charCode == 13)
							loadContent('" . site_url("master_cpm/content") . "', 'orderby');
					});
				});
			</script>";
} else if ($this->uri->segment(1) == "master_department") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("master_department/content") . "');
				loadForm('" . site_url("master_department/insert_page") . "');
				
				$(document).ready(function() {
					$('#selectPage').live('change', function() {
						loadContent('" . site_url("master_department/content") . "');
					});
				});
			</script>";
} else if ($this->uri->segment(1) == "master_industry") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("master_industry/content") . "');
				loadForm('" . site_url("master_industry/insert_page") . "');
				
				$(document).ready(function() {
					$('#selectPage').live('change', function() {
						loadContent('" . site_url("master_industry/content") . "');
					});
					$('#selectOrderBy').live('change', function() {
						if ($(this).val() == 'nopaket')
							$('#txtSearch').show();
						else {
							$('#txtSearch').hide();
							loadContent('" . site_url("master_industry/content") . "', 'orderby');
						}
					});
					$('#txtSearch').live('keypress', function(e) {
						if (e.keyCode == 13 || e.charCode == 13)
							loadContent('" . site_url("master_industry/content") . "', 'orderby');
					});
				});
			</script>";
} else if ($this->uri->segment(1) == "master_kanal") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("master_kanal/content") . "');
				loadForm('" . site_url("master_kanal/insert_page") . "');
				
				$(document).ready(function() {
					$('#selectPage').live('change', function() {
						loadContent('" . site_url("master_kanal/content") . "');
					});
					$('#selectOrderBy').live('change', function() {
						if ($(this).val() == 'nopaket')
							$('#txtSearch').show();
						else {
							$('#txtSearch').hide();
							loadContent('" . site_url("master_kanal/content") . "', 'orderby');
						}
					});
					$('#txtSearch').live('keypress', function(e) {
						if (e.keyCode == 13 || e.charCode == 13)
							loadContent('" . site_url("master_kanal/content") . "', 'orderby');
					});
				});
			</script>";
} else if ($this->uri->segment(1) == "master_level") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("master_level/content") . "');
				loadForm('" . site_url("master_level/insert_page") . "');
				
				$(document).ready(function() {
					$('#selectPage').live('change', function() {
						loadContent('" . site_url("master_level/content") . "');
					});
				});
			</script>";
} else if ($this->uri->segment(1) == "master_position") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("master_position/content") . "');
				loadForm('" . site_url("master_position/insert_page") . "');
				
				$(document).ready(function() {
					$('#selectPage').live('change', function() {
						loadContent('" . site_url("master_position/content") . "');
					});
					$('#selectOrderBy').live('change', function() {
						if ($(this).val() == 'nopaket')
							$('#txtSearch').show();
						else {
							$('#txtSearch').hide();
							loadContent('" . site_url("master_position/content") . "', 'orderby');
						}
					});
					$('#txtSearch').live('keypress', function(e) {
						if (e.keyCode == 13 || e.charCode == 13)
							loadContent('" . site_url("master_position/content") . "', 'orderby');
					});
				});
			</script>";
} else if ($this->uri->segment(1) == "master_productgroup") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("master_productgroup/content") . "');
				loadForm('" . site_url("master_productgroup/insert_page") . "');
				
				$(document).ready(function() {
					$('#selectPage').live('change', function() {
						loadContent('" . site_url("master_productgroup/content") . "');
					});
					$('#selectOrderBy').live('change', function() {
						if ($(this).val() == 'nopaket')
							$('#txtSearch').show();
						else {
							$('#txtSearch').hide();
							loadContent('" . site_url("master_productgroup/content") . "', 'orderby');
						}
					});
					$('#txtSearch').live('keypress', function(e) {
						if (e.keyCode == 13 || e.charCode == 13)
							loadContent('" . site_url("master_productgroup/content") . "', 'orderby');
					});
				});
			</script>";
}else if ($this->uri->segment(1) == "master_industry_cat") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("master_industry_cat/content") . "');
				loadForm('" . site_url("master_industry_cat/insert_page") . "');
				
				$(document).ready(function() {
					$('#selectPage').live('change', function() {
						loadContent('" . site_url("master_industry_cat/content") . "');
					});
					$('#selectOrderBy').live('change', function() {
						if ($(this).val() == 'nopaket')
							$('#txtSearch').show();
						else {
							$('#txtSearch').hide();
							loadContent('" . site_url("master_industry_cat/content") . "', 'orderby');
						}
					});
					$('#txtSearch').live('keypress', function(e) {
						if (e.keyCode == 13 || e.charCode == 13)
							loadContent('" . site_url("master_industry_cat/content") . "', 'orderby');
					});
				});
			</script>";
} else if ($this->uri->segment(1) == "master_user") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("master_user/content") . "');
				loadForm('" . site_url("master_user/insert_page") . "');
				
				$(document).ready(function() {
					$('#selectPage').live('change', function() {
						loadContent('" . site_url("master_user/content") . "');
					});
					$('#selectOrderBy').live('change', function() {
						if ($(this).val() == 'nopaket')
							$('#txtSearch').show();
						else {
							$('#txtSearch').hide();
							loadContent('" . site_url("master_user/content") . "', 'orderby');
						}
					});
					$('#txtSearch').live('keypress', function(e) {
						if (e.keyCode == 13 || e.charCode == 13)
							loadContent('" . site_url("master_user/content") . "', 'orderby');
					});
				});
			</script>";
} else if ($this->uri->segment(1) == "report_occupancy") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("report_occupancy/content") . "');
				
				$(document).ready(function() {
					$('#btnSearch').click(function() {
						loadContent('" . site_url("report_occupancy/content") . "');
					});
				});
			</script>";
} else if ($this->uri->segment(1) == "report_order_ae") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("report_order_ae/content") . "');
				
				$(document).ready(function() {
					$('#selectPage').live('change', function() {
						loadContent('" . site_url("report_order_ae/content") . "');
					});
					
					$('#btnSearch').click(function() {
						loadContent('" . site_url("report_order_ae/content") . "');
					});
				});
			</script>";
} else if ($this->uri->segment(1) == "report_closing_ae") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("report_closing_ae/content") . "');
				
				$(document).ready(function() {
					$('#selectPage').live('change', function() {
						loadContent('" . site_url("report_closing_ae/content") . "');
					});
					
					$('#btnSearch').click(function() {
						loadContent('" . site_url("report_closing_ae/content") . "');
					});
				});
			</script>";
} else if ($this->uri->segment(1) == "report_expired_ae") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("report_expired_ae/content") . "');
				
				$(document).ready(function() {
					$('#selectPage').live('change', function() {
						loadContent('" . site_url("report_expired_ae/content") . "');
					});
					
					$('#btnSearch').click(function() {
						loadContent('" . site_url("report_expired_ae/content") . "');
					});
				});
			</script>";
} else if ($this->uri->segment(1) == "report_unapprove") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("report_unapprove/content") . "');
				
				$(document).ready(function() {
					$('#selectPage').live('change', function() {
						loadContent('" . site_url("report_unapprove/content") . "');
					});
					
					$('#btnSearch').click(function() {
						loadContent('" . site_url("report_unapprove/content") . "');
					});
				});
			</script>";
} else if ($this->uri->segment(1) == "offer_position") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("offer_position/content") . "');
				loadForm('" . site_url("offer_position/insert_page") . "');
				
				$(document).ready(function() {
					$('#selectPage').live('change', function() {
						loadContent('" . site_url("offer_position/content") . "');
					});
				});
			</script>";
}	else if ($this->uri->segment(1) == "invoice") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("invoice/content") . "');
				
				$(document).ready(function() {
					$('#selectPage').live('change', function() {
						loadContent('" . site_url("invoice/content") . "');
					});
					$('#selectOrderBy').live('change', function() {
						if ($(this).val() == 'nopaket')
							$('#txtSearch').show();
						else {
							$('#txtSearch').hide();
							loadContent('" . site_url("invoice/content") . "', 'orderby');
						}
					});
					$('#txtSearch').live('keypress', function(e) {
						if (e.keyCode == 13 || e.charCode == 13)
							loadContent('" . site_url("invoice/content") . "', 'orderby');
					});
				});
			</script>";
}	else if ($this->uri->segment(1) == "po") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("po/content") . "');
				
				$(document).ready(function() {
					$('#selectPage').live('change', function() {
						loadContent('" . site_url("po/content") . "');
					});
					$('#selectOrderBy').live('change', function() {
						if ($(this).val() == 'nopaket')
							$('#txtSearch').show();
						else {
							$('#txtSearch').hide();
							loadContent('" . site_url("po/content") . "', 'orderby');
						}
					});
					$('#txtSearch').live('keypress', function(e) {
						if (e.keyCode == 13 || e.charCode == 13)
							loadContent('" . site_url("po/content") . "', 'orderby');
					});
				});				
			</script>";
}	else if ($this->uri->segment(1) == "master_production") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("master_production/content") . "');
				loadForm('" . site_url("master_production/insert_page") . "');
				
				$(document).ready(function() {
					$('#selectPage').live('change', function() {
						loadContent('" . site_url("master_production/content") . "');
					});
					$('#selectOrderBy').live('change', function() {
						if ($(this).val() == 'nopaket')
							$('#txtSearch').show();
						else {
							$('#txtSearch').hide();
							loadContent('" . site_url("master_production/content") . "', 'orderby');
						}
					});
					$('#txtSearch').live('keypress', function(e) {
						if (e.keyCode == 13 || e.charCode == 13)
							loadContent('" . site_url("master_production/content") . "', 'orderby');
					});
				});				
			</script>";
}	else if ($this->uri->segment(1) == "master_harga") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("master_harga/content") . "');
				loadForm('" . site_url("master_harga/insert_page") . "');
				
				$(document).ready(function() {
					$('#selectPage').live('change', function() {
						loadContent('" . site_url("master_harga/content") . "');
					});
					$('#selectOrderBy').live('change', function() {
						if ($(this).val() == 'nopaket')
							$('#txtSearch').show();
						else {
							$('#txtSearch').hide();
							loadContent('" . site_url("master_harga/content") . "', 'orderby');
						}
					});
					$('#txtSearch').live('keypress', function(e) {
						if (e.keyCode == 13 || e.charCode == 13)
							loadContent('" . site_url("master_harga/content") . "', 'orderby');
					});
				});				
			</script>";
}	else if ($this->uri->segment(1) == "approve_manager") {
      echo "	<script type='text/javascript'>
				loadContent('" . site_url("approve_manager/content") . "');
				loadForm('" . site_url("approve_manager/insert_page") . "');
				
				$(document).ready(function() {
					$('#selectPage').live('change', function() {
						loadContent('" . site_url("approve_manager/content") . "');
					});
					$('#selectOrderBy').live('change', function() {
						if ($(this).val() == 'nopaket')
							$('#txtSearch').show();
						else {
							$('#txtSearch').hide();
							loadContent('" . site_url("approve_manager/content") . "', 'orderby');
						}
					});
					$('#txtSearch').live('keypress', function(e) {
						if (e.keyCode == 13 || e.charCode == 13)
							loadContent('" . site_url("approve_manager/content") . "', 'orderby');
					});
				});				
			</script>";
}