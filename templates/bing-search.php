<?php
/* 
Template Name: bing-search
*/

if(!get_query_var('q')){
	wp_redirect(home_url());
	exit();
}
?>
<style>
	.emptyPlaceholder:empty {
		margin-top: 1em;
		max-width: 500px;
		width: 80%;
		height: 100vh !important; /* change height to see repeat-y behavior */
    	
		background-image:
			linear-gradient( 100deg, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.5) 50%, rgba(255, 255, 255, 0) 80% ),
			linear-gradient( lightgray 20px, transparent 0 ),
			linear-gradient( lightgray 20px, transparent 0 ),
			linear-gradient( lightgray 20px, transparent 0 ),
			linear-gradient( lightgray 20px, transparent 0 );

		background-repeat: repeat-y;

		background-size:
			50px 200px, /* highlight */
			150px 200px,
			350px 200px,
			300px 200px,
			250px 200px;

		background-position:
			0 0, /* highlight */
			0px 0,
			0px 40px,
			0px 80px,
			0px 120px;
		
		  background-clip: border-box;
 		  

		animation: shine 1s infinite;
	}

	@keyframes shine {
		to {
			background-position:
				100% 0, /* move highlight to right */
				0px 0,
				0px 40px,
				0px 80px,
				0px 120px;
		}
	}
</style>
<?php get_header(); ?>
<div class="search-page container-fluid" id="search__page">
	
	<div class="scrollable d-none d-md-flex invisible align-items-center " id="tabsarea" style=" overflow-x:auto;"> <!-- remove invisible class when we have authorization -->
		<div class="scrollable__content d-flex position-relative mw-656 h-auto justify-content-start btn-group">
				<?php 
				$categories = array(web, images, video, news);
				foreach ($categories as $category){ 
				?>
					<button class="btn btn-light w-100 <?php if($category == get_query_var('searchCategoryTab')){echo "active";} ?>">
						<?php echo $category; ?>
					</button>
				<?php } ?>
		</div>
	</div>

<div class="search-results d-flex flex-column position-relative mw-656 w-100 float-left" id="search__page__inner">
	
	<div id="totalResults" class="emptyPlaceholder"></div>
	<div id="topResults" ></div>

	<div id="mainResults"></div>
	<div id="bottomResults" ></div>
	<div id="relatedResults" ></div>
	<div id="pagination-SearchResults" class="scrollable d-flex align-items-center mb-5" >
		<!-- Value comes from javascript api -->
	</div>
</div>
</div>
</div>
<style>
	.adResult .resultTitlePane::before{
    content: 'Ads from our partners -';
    position: relative;
    left: 0;
    display: block;
    color: #1a0dab;
}


	.resultTitlePane {
    position: relative;
}</style>

<script type="text/javascript">

		  /**
		 * Get the value of a querystring
 		 * @param  {String} field The field to get the value of
 		 * @param  {String} url   The URL to get the value from (optional)
 		 * @return {String}       The field value
 	  */
	var getQueryString = function ( field, url ) {
    var href = url ? url : window.location.href;
    var reg = new RegExp( '[?&]' + field + '=([^&#]*)', 'i' );
    var string = reg.exec(href);
    return string ? string[1] : null;
	};
	
	<?php $queryValue = esc_html(stripslashes(get_query_var('q', ''))); ?>
	<?php if(!empty($queryValue)): ?>
   	let topResults;
	let mainResults;
	let bottomResults;
	let rightResults;
	let relatedResults;	
	insp.search.doSearch({
						 query: '<?php echo stripslashes($queryValue) ?>',  // take care to encode the query term properly, refer to Best Practices Tip #7
						 accessId: 'solarvillage.solarvillage001',
						 signature: '<?php echo svlg_signature(stripslashes($queryValue));?>',
						 category: 'web',
						 page: '<?php echo get_query_var('pageNo', 1); ?>',
						 containers: {
						   'top': {id: 'topResults',
								   styles:{
											'fontFamily': 'Roboto',
											//'titleColor': '1a0dab',
											'titleUnderline': false,
											'titleFontSize': 18,
											'textColor'	: '545454',
											'textFontSize' : 12,
											'urlFontSize' : 14
								  }
								  },
						   'main': {id:'mainResults',
									styles:{
											'fontFamily': 'Roboto',
											//'titleColor': '1a0dab',
											'titleUnderline': false,
											'titleFontSize': 18,
											'textColor'	: '545454',
											'textFontSize' : 12,
											'urlFontSize' : 14,
											//'rolloverLinkColor' : '551A8B'
									}
								   },
						   'bottom': {id:'bottomResults'},
						   'right': {id:'rightResults'},
						   'related': {id:'relatedResults'},
						   'spelling': {id:'spellSuggestResults'}
						 },


						 onComplete: handleOnComplete, 
						 onError: handleOnError,
						 siteLinks:'oneLine',
						 searchUrlFormat: '/search/?q={searchTerm}',
						 linkTarget: '_top',
						 adultFilter: "on",

					   });
	
	// On Error 
	function handleOnError(details){
		console.log(`there is some error. Please check error code = ${details.error}`);
	}
	
	// On Complete function
	
	function handleOnComplete(details) {
		topResults = document.getElementById('topResults');
	   if (details && details.maxAlgoResultCount > 0) {
		   
			createPageLinks(details);
	   }
		else {
			showNoResult(details);
		}
		 
    }
	
	function showNoResult(details){
		var pageLevelDiv = document.getElementById('search__page');
        var noResultsDiv = document.getElementById('search__page__inner');
		var query = '<?php echo stripslashes($queryValue) ?>';
        noResultsDiv.innerHTML = `<div class="d-block" style="overflow-x:auto;"><p style="padding-top:1.85rem; font-size:18px;">Your search <strong>${query}</strong> did not match any documents. </p> <p style="margin-top:.5em">Suggestions:</p> <ul style="margin-left:1.3em;margin-bottom:2em"><li>Make sure that all words are spelled correctly.</li><li>Try different keywords.</li><li>Try more general keywords.</li><li>Try fewer keywords.</li></ul></div>`;
        pageLevelDiv.appendChild(noResultsDiv);
	}
	
	function createPageLinks(details){
		var TotalResultsGenerated = `<span class="totalResultsGenerated">About ${details.maxAlgoPage.toLocaleString()} results </span>`;
	   jQuery('#totalResults').html(TotalResultsGenerated);

	  var pageNoPrev = parseInt(getQueryString('pageNo'),10);
	  
	  var pageNo = parseInt(getQueryString('pageNo'),10);
	  if (isNaN(pageNo)){
    	var pageNo = 1;
		var pageNoNext = 1;
					 }
	   else {
    	pageNo = pageNo;
		pageNoNext = pageNo;	   
			} 
	   let iStartPosition = 1;
	   while( pageNo >= iStartPosition + 3){
		 	++iStartPosition
		  }
	  var maxPagesToShow = iStartPosition + 4;
	  
      var paginationHtml = '<div class="pagination__list" role="group">';
	  var paginationQuery = '<?php echo stripslashes($queryValue) ?>';
	  var nextButton = '';
	  var prevButton = '';

	  if( pageNo >=2 ){
		prevButton = `<a class="pagination__num pagination__num--next-prev pagination__num--prev" href="<?php echo  esc_html(stripslashes( home_url( '/search?q=').get_query_var('q', '') )); ?>&pageNo=${pageNoPrev - 1} " data-page-number ="${pageNoPrev}"> Prev </a> </li>`
	  }
	   
	  
	   nextButton = `<a class="pagination__num pagination__num--next-prev pagination__num--next" href="<?php echo  esc_html(stripslashes( home_url( '/search?q=').get_query_var('q', '') )); ?>&pageNo=${pageNoNext + 1} " data-page-number =" ${pageNoNext}"> Next </a> </li>` 
	  
	   paginationHtml = paginationHtml + prevButton;

      for (var i = iStartPosition; i <= Math.min(maxPagesToShow, details.maxAlgoPage); ++i) {
          
		  if( pageNo === i){var activeClass = "active";}else{ activeClass = ''}

		   var link = '<a class="pagination__num ' + activeClass +' " href="/search/?q=' + paginationQuery + '&pageNo=' + i + '" data-page-number =' + i + '">' + i + '</a>';
		  
		   paginationHtml =  paginationHtml + link;
      }
	   	  paginationHtml = paginationHtml + nextButton;
	   
	   	
	   
     // document.getElementById('pagination-SearchResults').html(paginationHtml);
		 jQuery('#pagination-SearchResults').html(paginationHtml);
	}
	
	<?php endif;?>
</script>
<?php get_footer(); ?>