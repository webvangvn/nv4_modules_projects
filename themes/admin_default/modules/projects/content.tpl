<!-- BEGIN: main -->
<!-- BEGIN: error -->
<div class="alert alert-danger">
	{error}
</div>
<!-- END: error -->

<link rel="stylesheet" href="{NV_BASE_SITEURL}js/select2/select2.min.css">
<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.core.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.theme.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.menu.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.autocomplete.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.datepicker.css" rel="stylesheet" />

<script type="text/javascript">var inrow = '{inrow}';</script>
<form class="form-inline" action="" enctype="multipart/form-data" method="post">
	<input type="hidden" value="1" name="save">
	<input type="hidden" value="{rowcontent.id}" name="id">
	<div class="row">
		<div class="col-sm-24 col-md-18">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover">
					<tbody>
						<tr>
							<th class="150px">{LANG.name} <span class="require">(*)</span></th>
							<td colspan="3"><input type="text" maxlength="255" value="{rowcontent.title}" name="title" id="idtitle" class="form-control" style="width: 400px" /></td>
						</tr>
						<tr>
							<th>{LANG.alias}: </th>
							<td colspan="3"><input class="form-control" name="alias" type="text" id="idalias" value="{rowcontent.alias}" maxlength="255" style="width: 400px" /> &nbsp; <i class="fa fa-refresh fa-lg" onclick="get_alias();">&nbsp;</i></td>
						</tr>
								<input type="hidden" name="product_number" value="0">
						<tr>
							<th>{LANG.content_cat} <span class="require">(*)</span></th>
							<td>
								<select class="form-control" name="catid" id="catid" style="width:300px" onchange="nv_change_catid(this, {rowcontent.id})">
									<option value="0" data-label="1"> --- </option>
									<!-- BEGIN: rowscat -->
									<option value="{ROWSCAT.catid}" {ROWSCAT.selected} data-label="{ROWSCAT.typeprice}">{ROWSCAT.title}</option>
									<!-- END: rowscat -->
								</select></td>
							<th>{LANG.content_product_code}: </th>
							<td><input class="form-control" name="product_code" type="text" value="{rowcontent.product_code}" maxlength="255"/></td>
						</tr>
							<input type="hidden" name="product_unit" value="0">
								<input class="form-control" type="hidden"  name="product_weight" style="width: 80px;" onkeyup="this.value=FormatNumber(this.value);" id="f_weight"/>
								<input type="hidden" name="weight_unit" value="0">
							<!-- BEGIN: typeprice2 -->
													<input type="button" value="{LANG.price_config_add}" onclick="nv_price_config_add_item();" class="btn btn-info" />
											<!-- BEGIN: loop -->
													<input class="form-control" type="hidden" name="price_config[{PRICE_CONFIG.id}][number_to]" value="1"/>
													<input class="form-control" type="hidden" name="price_config[{PRICE_CONFIG.id}][price]" value="1" onkeyup="this.value=FormatNumber(this.value);" style="text-align: right"/></td>
											</tr>
											<!-- END: loop -->
							<!-- END: typeprice2 -->
							<!-- BEGIN: product_price -->
							<input class="form-control" type="hidden" maxlength="50" value="1" name="product_price" onkeyup="this.value=FormatNumber(this.value);" id="f_money" style="text-align: right"/>
							<!-- END: product_price -->
								<input type="hidden" name="money_unit" value="VND">
							<!-- BEGIN: typeprice1 -->
								<input type="hidden" name="discount_id" value="0">
							<!-- END: typeprice1 -->
					</tbody>
				</table>
			</div>

			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover">
					<tbody>
						<tr>
							<th>{LANG.content_homeintro}</th>
						</tr>
						<tr>
							<td><input class="form-control" style="width:400px; margin-right: 5px" type="text" name="detailintro" id="detailintro" value="{rowcontent.detailintro}"/><input type="button" value="{LANG.browse_image}" name="selectimg1" class="btn btn-info" style="margin-right: 5px" /></td>
						</tr>
					</tbody>
					<tbody>
						<tr>
							<th>{LANG.content_homeimg}</th>
						</tr>
						<tr>
							<td><input class="form-control" style="width:400px; margin-right: 5px" type="text" name="homeimg" id="homeimg" value="{rowcontent.homeimgfile}"/><input type="button" value="{LANG.browse_image}" name="selectimg" class="btn btn-info" style="margin-right: 5px" /><input type="button" class="btn btn-info" onclick="nv_add_otherimage();" value="{LANG.add_otherimage}"></td>
						</tr>
					</tbody>
					
					<tbody id="otherimage">
						<!-- BEGIN: otherimage -->
						<tr>
							<td><input value="{DATAOTHERIMAGE.value}" name="otherimage[]" id="otherimage_{DATAOTHERIMAGE.id}" class="form-control" maxlength="255"><input value="{LANG.browse_image}" name="selectfile" onclick="nv_open_browse( '{NV_BASE_ADMINURL}index.php?{NV_NAME_VARIABLE}=upload&popup=1&area=otherimage_{DATAOTHERIMAGE.id}&path={NV_UPLOADS_DIR}/{module_name}&currentpath={CURRENT}&type=file', 'NVImg', 850, 500, 'resizable=no,scrollbars=no,toolbar=no,location=no,status=no' ); return false; " type="button"></td>
						</tr>
						<!-- END: otherimage -->
						<tr>
							<td> {LANG.content_homeimgalt} </td>
						</tr>
						<tr>
							<td><input class="form-control" type="text" maxlength="255" value="{rowcontent.homeimgalt}" name="homeimgalt" style="width:100%" /></td>
						</tr>
					</tbody>
				</table>
			</div>
			<table class="table table-striped table-bordered table-hover">
				<tbody>
					<tr>
						<th>{LANG.content_hometext} <span class="require">(*)</span> {LANG.content_notehome}</th>
					</tr>
					<tr>
						<td>						<textarea class="form-control" rows="4" name="hometext" style="width:98%">{rowcontent.hometext}</textarea></td>
					</tr>
					<tr>
						<th>{LANG.content_bodytext} <span class="require">(*)</span> {LANG.content_bodytext_note}</th>
					</tr>
					<tr>
						<td>
						<div style="padding:2px; background:#CCCCCC; margin:0; display:block; position:relative">
							{edit_bodytext}
						</div></td>
					</tr>

				</tbody>
			</table>
			<div id="custom_form">
				{DATACUSTOM_FORM}
			</div>
		</div>
		<div class="col-sm-24 col-md-6">
			<!-- BEGIN:block_cat -->
			<table class="table table-striped table-bordered table-hover">
				<tbody>
					<tr>
						<th>{LANG.content_block}</th>
					</tr>
					<tr>
						<td>
						<div style="padding:4px; background:#FFFFFF; text-align:left; border: 1px solid #CCCCCC">
							{row_block}
						</div></td>
					</tr>
				</tbody>
			</table>
			<!-- END:block_cat -->
			<table class="table table-striped table-bordered table-hover">
				<tbody>
					<tr>
						<td style="line-height:16px"><strong>{LANG.content_keywords}</strong>
					</tr>
					<tr>
						<td>
						<div class="message_body" style="overflow: auto">
							<div class="clearfix uiTokenizer uiInlineTokenizer">
								<div id="keywords" class="tokenarea">
									<!-- BEGIN: keywords -->
									<span class="uiToken removable" title="{KEYWORDS}"> {KEYWORDS} <input type="hidden" autocomplete="off" name="keywords[]" value="{KEYWORDS}" /> <a onclick="$(this).parent().remove();" class="remove uiCloseButton uiCloseButtonSmall" href="javascript:void(0);"></a> </span>
									<!-- END: keywords -->
								</div>
								<div class="uiTypeahead">
									<div class="wrap">
										<input type="hidden" class="hiddenInput" autocomplete="off" value="" />
										<div class="innerWrap">
											<input id="keywords-search" type="text" placeholder="{LANG.input_keyword_tags}" class="form-control textInput" style="width: 100%;" />
										</div>
									</div>
								</div>
							</div>
						</div></td>
					</tr>
				</tbody>
			</table>
			<table class="table table-striped table-bordered table-hover">
				<tbody>
					<tr>
						<th>{LANG.content_publ_date} <span class="timestamp">{LANG.content_notetime}</span></th>
					</tr>
					<tr>
						<td>
						<div class="row">
							<input class="form-control" name="publ_date" id="publ_date" value="{publ_date}" style="width: 90px;" maxlength="10" type="text" />
							<select class="form-control" name="phour">
								{phour}
							</select>
							:
							<select class="form-control" name="pmin">
								{pmin}
							</select>
						</div></td>
					</tr>
				</tbody>
			</table>
			<table class="table table-striped table-bordered table-hover">
				<tbody>
					<tr>
						<th>{LANG.content_exp_date} <span class="timestamp">{LANG.content_notetime}</span></th>
					</tr>
					<tr>
						<td>
						<div class="row">
							<input class="form-control" name="exp_date" id="exp_date" value="{exp_date}" style="width: 90px;" maxlength="10" type="text" />
							<select class="form-control" name="ehour">
								{ehour}
							</select>
							:
							<select class="form-control" name="emin">
								{emin}
							</select>
						</div>
						<div style="margin-top: 5px;">
							<input type="checkbox" value="1" name="archive" {archive_checked} />
							<label>{LANG.content_archive}</label>
						</div></td>
					</tr>
				</tbody>
			</table>
			<table class="table table-striped table-bordered table-hover">
				<tbody>
					<tr>
						<th>{LANG.content_extra}</th>
					</tr>
					<tr>
						<td>
						<div style="margin-bottom: 2px;">
							<input type="checkbox" value="1" name="inhome" {inhome_checked}/>
							<label>{LANG.content_inhome}</label>
						</div>
						<div style="margin-bottom: 2px;">
							<input type="checkbox" value="1" name="allowed_rating" {allowed_rating_checked}/>
							<label>{LANG.content_allowed_rating}</label>
						</div>
						<div style="margin-bottom: 2px;">
							<input type="checkbox" value="1" name="allowed_send" {allowed_send_checked}/>
							<label>{LANG.content_allowed_send}</label>
						</div>
						<div style="margin-bottom: 2px;">
							<input type="checkbox" value="1" name="allowed_print" {allowed_print_checked} />
							<label>{LANG.content_allowed_print}</label>
						</div>
						<div style="margin-bottom: 2px;">
							<input type="checkbox" value="1" name="allowed_save" {allowed_save_checked} />
							<label>{LANG.content_allowed_save}</label>
						</div>
						<div style="margin-bottom: 2px;">
							<input type="checkbox" name="showprice" value="1" {ck_showprice}/>{LANG.content_showprice}
						</div></td>
					</tr>
				</tbody>
			</table>
			<table class="table table-striped table-bordered table-hover">
				<tbody>
					<tr>
						<th>{LANG.content_allowed_comm}</th>
					</tr>
					<tr>
						<td><!-- BEGIN: allowed_comm -->
						<div class="row">
							<label><input name="allowed_comm[]" type="checkbox" value="{ALLOWED_COMM.value}" {ALLOWED_COMM.checked} />{ALLOWED_COMM.title}</label>
						</div><!-- END: allowed_comm --></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>


	<div class="text-center" style="margin-top: 10px">
		<!-- BEGIN:status -->
		<input class="btn btn-primary" name="statussave" type="submit" value="{LANG.save}" />
		<!-- END:status -->
		<!-- BEGIN:status0 -->
		<input class="btn btn-primary" name="status0" type="submit" value="{LANG.save_temp}" />
		<input class="btn btn-primary" name="status1" type="submit" value="{LANG.publtime}" />
		<!-- END:status0 -->
	</div>
</form>

<div id="message"></div>

<script type="text/javascript" src="{NV_BASE_SITEURL}js/select2/select2.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}js/ui/jquery.ui.core.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}js/ui/jquery.ui.menu.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}js/ui/jquery.ui.autocomplete.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}js/ui/jquery.ui.datepicker.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}modules/shops/js/content.js"></script>

<script type="text/javascript">
	var file_items = '{FILE_ITEMS}';
	var file_selectfile = '{LANG.file_selectfile}';
	var nv_base_adminurl = '{NV_BASE_ADMINURL}';
	var inputnumber = '{LANG.error_inputnumber}';
	var file_dir = '{NV_UPLOADS_DIR}/{module_name}';
	var currentpath = "{CURRENT}";

	$(document).ready(function() {
		$("#catid").select2();
	});

	$("input[name=selectimg]").click(function() {
		var area = "homeimg";
		var path = "{NV_UPLOADS_DIR}/{module_name}";
		var currentpath = "{CURRENT}";
		var type = "image";
		nv_open_browse("{NV_BASE_ADMINURL}index.php?{NV_NAME_VARIABLE}=upload&popup=1&area=" + area + "&path=" + path + "&type=" + type + "&currentpath=" + currentpath, "NVImg", 850, 500, "resizable=no,scrollbars=no,toolbar=no,location=no,status=no");
		return false;
	});
	$("input[name=selectimg1]").click(function() {
		var area = "detailintro";
		var path = "{NV_UPLOADS_DIR}/{module_name}";
		var currentpath = "{CURRENT}";
		var type = "image";
		nv_open_browse("{NV_BASE_ADMINURL}index.php?{NV_NAME_VARIABLE}=upload&popup=1&area=" + area + "&path=" + path + "&type=" + type + "&currentpath=" + currentpath, "NVImg", 850, 500, "resizable=no,scrollbars=no,toolbar=no,location=no,status=no");
		return false;
	});
	$('[type="submit"]').hover(function() {
		if ($('[name="keywords[]"]').length == 0) {
			if ($('#message-tags').length == 0) {
				$('#message').html('<div style="margin-top: 10px" id="message-tags" class="alert alert-danger">{LANG.content_tags_empty}.<!-- BEGIN: auto_tags --> {LANG.content_tags_empty_auto}.<!-- END: auto_tags --></div>');
			}
		} else {
			$('#message-tags').remove();
		}
	});

	$("#listgroupid").load('{url_load}');

</script>

<!-- BEGIN:getalias -->
<script type="text/javascript">
	$("#idtitle").change(function() {
		get_alias();
	});
</script>
<!-- END:getalias -->
<!-- END:main -->