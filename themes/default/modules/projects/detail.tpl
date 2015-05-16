<!-- BEGIN: main -->


<div itemscope itemtype="http://schema.org/Product" style="display: none">
	<span itemprop="name">{TITLE}</span>
	<img itemprop="image" src="{SRC_PRO_FULL}" alt="{TITLE}" />
	<span itemprop="description">{hometext}</span>
	<span itemprop="mpn">{PRODUCT_CODE}</span>
	<!-- BEGIN: allowed_rating_snippets -->
	<span itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating"> <span itemprop="ratingValue">{RATE_VALUE}</span> {LANG.trong} <span itemprop="reviewCount">{RATE_TOTAL} </span> {LANG.dg} </span>
	<!-- END: allowed_rating_snippets -->
	<span itemprop="offers" itemscope itemtype="http://schema.org/Offer"> <span itemprop="category">{CAT_TITLE}</span> <!-- BEGIN: price1 --> <span itemprop="price">{PRICE.sale_format}</span> <span itemprop="priceCurrency">{PRICE.unit}</span> <!-- END: price1 --> <span itemprop="availability">{LANG.detail_pro_number}: {PRODUCT_NUMBER} {pro_unit}</span> </span>
</div>

<div id="detail">

	<h2>{TITLE}</h2>
	<hr />
	<div class="intro">
		<img src="{SRC_DETAIL_INTRO}"   title="{hometext}" alt="{hometext}" >
	</div>
	<hr />
	<div class="detail" >
		{DETAIL}
	</div>
	<hr />
	
	<!-- BEGIN: othersimg -->
	<section id="section-2">
		<!-- BEGIN: loop -->
		<div class="col-xs-12 col-md-8">
			<a href="{IMG_SRC_OTHER}" class="thumbnail" rel="shadowbox[miss]"><img src="{IMG_SRC_OTHER}"  /></a>
		</div>
		<!-- END: loop -->
		<div class="clear">
			&nbsp;
		</div>
	</section>
	<!-- END: othersimg -->		
	
	<hr />			


	<!-- BEGIN: other -->
	<div class="panel panel-default">
		<div class="panel-heading">
			{LANG.detail_others}
		</div>
		<div class="panel-body">
			{OTHER}
		</div>
	</div>
	<!-- END: other -->

	<!-- BEGIN: other_view -->
	<div class="panel panel-default">
		<div class="panel-heading">
			{LANG.detail_others_view}
		</div>
		<div class="panel-body">
			{OTHER_VIEW}
		</div>
	</div>
	<!-- END: other_view -->
</div>
<div class="msgshow" id="msgshow"></div>
<script type="text/javascript" src="{NV_BASE_SITEURL}modules/{MODULE_FILE}/js/tabresponsive.js"></script>
<!-- BEGIN: allowed_rating_js -->
<script type="text/javascript">
	$("#rate_list").load('{LINK_REVIEW}&showdata=1');
	var rating = 0;
	$('.rate-btn').hover(function() {
		$('.rate-btn').removeClass('rate-btn-hover');
		rating = $(this).attr('id');
		for (var i = rating; i >= 0; i--) {
			$('.rate-btn-' + i).addClass('rate-btn-hover');
		};
	});

	$('#review_form').submit(function() {
		var sender = $(this).find('input[name="sender"]').val();
		var comment = $(this).find('textarea[name="comment"]').val();
		var fcode = $(this).find('input[name="fcode"]').val();
		$.ajax({
			type : "POST",
			url : '{LINK_REVIEW}' + '&nocache=' + new Date().getTime(),
			data : 'sender=' + sender + '&rating=' + rating + '&comment=' + comment + '&fcode=' + fcode,
			success : function(data) {
				var s = data.split('_');
				if (s[0] == 'OK') {
					$('#review_form input[name="sender"], #review_form input[name="fcode"], #review_form textarea').val('');
					$('.rate-btn').removeClass('rate-btn-hover');
					$("#rate_list").load('{LINK_REVIEW}&showdata=1');
				}
				alert(s[1]);
			}
		});
		return false;
	});
</script>
<!-- END: allowed_rating_js -->

<!-- BEGIN: allowed_print_js -->
<script type="text/javascript">
	$(function() {
		$('#click_print').click(function(event) {
			var href = $(this).attr("href");
			event.preventDefault();
			nv_open_browse(href, '', 640, 500, 'resizable=no,scrollbars=yes,toolbar=no,location=no,status=no');
			return false;
		});
	});
</script>
<!-- END: allowed_print_js -->

<script type="text/javascript">
	var detail_error_group = '{LANG.detail_error_group}';
	new CBPFWTabs(document.getElementById('tabs'));

	$('.groupid').click(function() {
		var _this = $('input[name="'+$(this).attr('name')+'"]');
		$('input[name="'+$(this).attr('name')+'"]').parent().css('border-color', '#ccc');
		if( $(this).is(':checked') )
		{
		    $(this).parent().css('border-color', 'blue');
		}
		$('#group_error').css( 'display', 'none' );
		check_price( '{proid}', '{pro_unit}' );
	});

	
</script>

<!-- END: main -->