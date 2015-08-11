<?php

	//retrieve recipient email from $vienna_options
	global $vienna_options;
	
	$opt_catering_form_email = $vienna_options['opt-catering-form-email'];
	$opt_send_catering_confirmation = $vienna_options['opt_send_catering_confirmation'];

?>

<div class="row" id="catering-form">
    <div class="col-lg-12 pm-column-spacing">
    
        <form action="#" method="post" id="pm-catering-form">
                    
            <div class="row">
            
                <div class="col-lg-4 col-md-4 col-sm-12">
                
                    <input name="pm-first-name-field" class="pm-textfield" type="text" placeholder="<?php _e('First name','viennatheme') ?> *" id="catering-form-first-name">	
                    
                    <input name="pm-last-name-field" class="pm-textfield" type="text" placeholder="<?php _e('Last name','viennatheme') ?> *" id="catering-form-last-name">	
                    
                    <input name="pm-email-field" class="pm-textfield" type="text" placeholder="<?php _e('Email address','viennatheme') ?> *" id="catering-form-email-address">	
                
                </div><!-- /.col-lg-4 -->
                
                <div class="col-lg-4 col-md-4 col-sm-12">
                
                    <input name="pm-phone-field" class="pm-textfield" type="text" placeholder="<?php _e('Phone Number','viennatheme') ?>">	
                    
                    <select name="pm-event-inquiry-field" id="catering-form-event-type">
                        <option value="default"><?php _e('','viennatheme'); ?><?php _e('Event Type','viennatheme'); ?> *</option>
                        <option value="<?php _e('Wedding','viennatheme'); ?>"><?php _e('Wedding','viennatheme'); ?></option>
                        <option value="<?php _e('Corporate','viennatheme'); ?>"><?php _e('Corporate','viennatheme'); ?></option>
                        <option value="<?php _e('School Function','viennatheme'); ?>"><?php _e('School Function','viennatheme'); ?></option>
                        <option value="<?php _e('Banquet','viennatheme'); ?>"><?php _e('Banquet','viennatheme'); ?></option>
                        <option value="<?php _e('Stag','viennatheme'); ?>"><?php _e('Stag','viennatheme'); ?></option>
                        <option value="<?php _e('Engagement','viennatheme'); ?>"><?php _e('Engagement','viennatheme'); ?></option>
                        <option value="<?php _e('Backyard party','viennatheme'); ?>"><?php _e('Backyard party','viennatheme'); ?></option>
                        <option value="<?php _e('Other','viennatheme'); ?>"><?php _e('Other','viennatheme'); ?></option>
                    </select>
                    
                    <input name="pm-date-of-event-field" class="pm-textfield catering-form-datepicker" type="text" placeholder="<?php _e('','viennatheme') ?>Date of Event *" id="datepicker">
                
                </div><!-- /.col-lg-4 -->
                
                <div class="col-lg-4 col-md-4 col-sm-12">
                    
                    <input name="pm-num-of-guests-field" class="pm-textfield" type="text" placeholder="<?php _e('Number of Guests','viennatheme') ?> *" id="catering-form-guests-field">
                    
                    <input name="pm-event-location-field" class="pm-textfield" type="text" placeholder="<?php _e('Event Location','viennatheme') ?> *" id="catering-form-location-field">	
                    
                    <input name="pm-time-of-event-field" class="pm-textfield" type="text" placeholder="<?php _e('Time of Event (ex. 7:00pm - 9:00pm)','viennatheme') ?> *" id="catering-form-time-field">	
                    
                </div>
                                        
            </div>

            <div class="row">
            
                <div class="col-lg-12">
                    <textarea name="pm-additional-info-field" cols="20" rows="10" placeholder="<?php _e('Additional Information','viennatheme') ?>" class="pm-form-textarea"></textarea>
                </div>
            
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    
                    <div class="pm_captcha_box">
                        <p>Security Code:</p>
                        <img src="<?php echo get_template_directory_uri(); ?>/js/ajax-cateringform/CaptchaSecurityImages.php?width=100&amp;height=40&amp;characters=5" alt="Security image" /><br />
                        <div style="width:96px;">
                            <div style="padding-top:2px; width:86px;">
                                <input class="pm_s_security_code pm-form-textfield" name="security_code" type="text" id="security_code" maxlength="5" />
                            </div>
                        </div>
                    </div>
                    <div id="pm-catering-form-response"></div>
                
                    <input type="submit" class="pm-rounded-submit-btn" value="<?php _e('Send Request','viennatheme') ?>" id="pm-catering-form-btn" />
                    
                    <input type="hidden" name="pm_event_email_address_contact" value="<?php echo $opt_catering_form_email; ?>" />
                    <input type="hidden" name="pm_send_catering_confirmation" value="<?php echo $opt_send_catering_confirmation; ?>" />
                    
                </div>
            </div>
          
        </form>
    
    </div>
</div>