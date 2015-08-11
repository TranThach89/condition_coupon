<!-- Theme sampler -->
<div id="pm_theme_color_selector">
    <a class="pm_theme_color_selector_btn"><i class="typcn typcn-cog"></i></a>
    <p class="pm_theme_color_selector_title">Style Sampler</p>

    <div class="pm_theme_color_selector_container">
        <p>Layout Style</p>
        <select name="pm_theme_color_selector_mode" id="pm_theme_color_selector_mode">
          <option value="pm-full-mode" selected><?php _e('Fullscreen', 'viennatheme'); ?></option>
          <option value="pm-boxed-mode"><?php _e('Boxed Mode', 'viennatheme'); ?></option>
        </select>
    </div>
    <div class="pm_theme_color_selector_container">
        <p>Patterns for Boxed Mode</p>
        <ul class="pm_theme_img_selector" id="pm_theme_pattern_selector">
            <li><a href="#" id="pattern1"><img src="<?php echo get_template_directory_uri(); ?>/img/boxed-patterns/pattern1.png" alt="pattern1"></a></li>
            <li><a href="#" id="pattern2"><img src="<?php echo get_template_directory_uri(); ?>/img/boxed-patterns/pattern2.png" alt="pattern2"></a></li>
            <li><a href="#" id="pattern3"><img src="<?php echo get_template_directory_uri(); ?>/img/boxed-patterns/pattern3.png" alt="pattern3"></a></li>
            <li><a href="#" id="pattern4"><img src="<?php echo get_template_directory_uri(); ?>/img/boxed-patterns/pattern4.png" alt="pattern4"></a></li>
            <li><a href="#" id="pattern5"><img src="<?php echo get_template_directory_uri(); ?>/img/boxed-patterns/pattern5.png" alt="pattern5"></a></li>
            <li><a href="#" id="pattern6"><img src="<?php echo get_template_directory_uri(); ?>/img/boxed-patterns/pattern6.png" alt="pattern6"></a></li>
        </ul>
    </div>
    
    <div class="pm_theme_color_selector_container">
        <p>Backgrounds for Boxed Mode</p>
        <ul class="pm_theme_img_selector" id="pm_theme_background_selector">
            <li><a href="#" id="1a"><img src="<?php echo get_template_directory_uri(); ?>/img/boxed-bgs/1.jpg" alt="bg1"></a></li>
            <li><a href="#" id="2a"><img src="<?php echo get_template_directory_uri(); ?>/img/boxed-bgs/2.jpg" alt="bg2"></a></li>
            <li><a href="#" id="3a"><img src="<?php echo get_template_directory_uri(); ?>/img/boxed-bgs/3.jpg" alt="bg3"></a></li>
            <li><a href="#" id="4a"><img src="<?php echo get_template_directory_uri(); ?>/img/boxed-bgs/4.jpg" alt="bg4"></a></li>
            <li><a href="#" id="5a"><img src="<?php echo get_template_directory_uri(); ?>/img/boxed-bgs/5.jpg" alt="bg5"></a></li>
        </ul>
    </div>

</div>
<!-- Theme sampler -->