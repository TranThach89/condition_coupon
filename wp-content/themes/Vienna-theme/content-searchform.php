<?php 
	$searchFieldText = get_theme_mod('searchFieldText'); 
?>

<!-- Search overlay -->
<div class="pm-search-container" id="pm-search-container">
    
    <div class="container">
        <div class="row">
            
            <div class="col-lg-10 col-md-10 col-sm-10">
                <form action="<?php echo home_url( '/' ); ?>" method="get" id="pm-desktop-searchform" name="searchform">
                    <input name="s" type="text" class="pm-search-field-header" placeholder="<?php echo __($searchFieldText,'viennatheme'); ?>">
                </form>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2">
                <ul class="pm-search-controls">
                    <li><a href="#" id="pm-desktop-search-btn"><i class="fa fa-search"></i></a></li>
                    <li><a href="#" id="pm-search-collapse"><i class="fa fa-times"></i></a></li>
                </ul>
            </div>
            
        </div>
    </div>
    
</div>
<!-- Search overlay end -->