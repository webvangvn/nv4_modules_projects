<!-- BEGIN: main -->
<div id="products" class="clearfix">
    <!-- BEGIN: displays -->
    <div class="form-group form-inline pull-right">
        <label class="control-label">{LANG.displays_product}</label>
        <select name="sort" id="sort" class="form-control input-sm" onchange="nv_chang_price();">
            <!-- BEGIN: sorts -->
                <option value="{key}" {se}> {value}</option>
            <!-- END: sorts -->
        </select>
    </div>
    <div class="clearfix">&nbsp;</div>
    <!-- END: displays -->

    <!-- BEGIN: items -->
    <div class="col-sm-12 col-md-{num}">
        <div class="thumbnail">
            <div style="height: {height}px">
                <a href="{LINK}" title="{TITLE}"><img src="{IMG_SRC}" alt="{TITLE}" data-content="{hometext}" data-rel="tooltip" class="img-thumbnail" style="max-width:{width}px;"></a>
            </div>
        </div>
    </div>
    <!-- END: items -->
</div>
<!-- BEGIN: pages -->
<div class="text-center">
    {generate_page}
</div>
<!-- END: pages -->
<div class="msgshow" id="msgshow">&nbsp;</div>
<!-- BEGIN: tooltip_js -->
<script type="text/javascript">
	$(document).ready(function() {$("[data-rel='tooltip']").tooltip({
		placement: "bottom",
		html: true,
		title: function(){return '<p class="text-justify">' + $(this).data('content') + '</p><div class="clearfix"></div>';}
	});});
</script>
<!-- END: tooltip_js -->
<!-- END: main -->