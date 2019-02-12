<div class="header-search">
	<form action="<?php echo esc_url( home_url( '/search' ) ); ?>" method="get">
		<div class="input-group">
			<input type="text" autocomplete="off" class="form-control" name="q" value='<?php echo esc_html(stripslashes(get_query_param('q'))); ?>' id="searchTermPreActive">
			<div class="input-group-append">
				<button name="search" type="submit" class="input-group-text bg-white btn border-left-0"><i class="fa fa-search"></i></button>
			</div>
		</div>
	</form>
</div>