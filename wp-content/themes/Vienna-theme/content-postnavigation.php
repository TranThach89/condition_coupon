<?php
/**
 * The default template for displaying post navigation
 */
?>

<div class="pm-sub-header-post-pagination">
    <ul class="pm-sub-header-post-pagination-ul">
        <li class="prev pm_tip_static_top" title="Previous post"><?php previous_post_link('%link', '<i class="fa fa-angle-left"></i>'); ?></li>
        <li class="next pm_tip_static_top" title="Next post"><?php next_post_link('%link', '<i class="fa fa-angle-right"></i>'); ?></li>
    </ul>
</div>
