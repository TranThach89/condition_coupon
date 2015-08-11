<?php

	//retrieve recipient email from $vienna_options
	global $vienna_options;
	
	$opt_event_form_email = $vienna_options['opt-event-form-email'];
	$opt_send_event_confirmation = $vienna_options['opt_send_event_confirmation'];

?>

<div class="row" id="event-form">
    <div class="col-lg-12 pm-column-spacing">
    
        <form action="#" method="post" id="pm-event-form">
                
            <div class="row">
            
                <div class="col-lg-4 col-md-4 col-sm-12">
                
                    <input name="pm-first-name-field" class="pm-textfield" type="text" placeholder="<?php _e('First name','viennatheme') ?> *" id="event-form-first-name">	
                    
                    <input name="pm-last-name-field" class="pm-textfield" type="text" placeholder="<?php _e('Last name','viennatheme') ?> *" id="event-form-last-name">	
                    
                    <input name="pm-email-field" class="pm-textfield" type="text" placeholder="<?php _e('Email address','viennatheme') ?> *" id="event-form-email-address">	
                
                </div><!-- /.col-lg-4 -->
                
                <div class="col-lg-4 col-md-4 col-sm-12">
                
                    <input name="pm-phone-field" class="pm-textfield" type="text" placeholder="<?php _e('Phone Number','viennatheme') ?>">	
                    
                    <select name="pm-event-inquiry-field" id="event-form-event-type">
                        <option value="default"><?php _e('Event Type','viennatheme'); ?> *</option>
                        <option value="<?php _e('Corporate Party','viennatheme'); ?>"><?php _e('Corporate Party','viennatheme'); ?></option>
                        <option value="<?php _e('School Function','viennatheme'); ?>"><?php _e('School Function','viennatheme'); ?></option>
                        <option value="<?php _e('Engagement','viennatheme'); ?>"><?php _e('Engagement','viennatheme'); ?></option>
                        <option value="<?php _e('Baby Shower','viennatheme'); ?>"><?php _e('Baby Shower','viennatheme'); ?></option>
                        <option value="<?php _e('Birthday Party','viennatheme'); ?>"><?php _e('Birthday Party','viennatheme'); ?></option>
                        <option value="<?php _e('Social Gathering','viennatheme'); ?>"><?php _e('Social Gathering','viennatheme'); ?></option>
                        <option value="<?php _e('Other','viennatheme'); ?>"><?php _e('Other','viennatheme'); ?></option>
                    </select>
                    
                    <input name="pm-date-of-event-field" class="pm-textfield event-form-datepicker" type="text" placeholder="<?php _e('Date of Event','viennatheme') ?> *" id="datepicker">	
                
                </div><!-- /.col-lg-4 -->
                
                <div class="col-lg-4 col-md-4 col-sm-12">
                    
                    <input name="pm-num-of-guests-field" class="pm-textfield" type="text" placeholder="<?php _e('Number of Guests','viennatheme') ?> *" id="event-form-guests-field">
                                                    
                    <input name="pm-time-of-event-field" class="pm-textfield" type="text" placeholder="<?php _e('Time of Event (ex. 7:00pm - 9:00pm)','viennatheme') ?> *" id="event-form-time-field">	
                    
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
                        <img src="<?php echo get_template_directory_uri(); ?>/js/ajax-eventform/CaptchaSecurityImages.php?width=100&amp;height=40&amp;characters=5" alt="Security Image" /><br />
                        <?php echo $_SESSION['security_code'] . 'thach';?>
                        <div style="width:96px;">
                            <div style="padding-top:2px; width:86px;">
                                <input class="pm_s_security_code pm-form-textfield" name="security_code" type="text" id="security_code" maxlength="5" />
                            </div>
                        </div>
                    </div>
                    <div id="pm-event-form-response"></div>
                
                     <input type="submit" class="pm-rounded-submit-btn" value="<?php _e('Send Request','viennatheme') ?>" id="pm-event-form-btn" />
                </div>
            </div>
            
            <input type="hidden" name="pm_event_email_address_contact" value="<?php echo $opt_event_form_email; ?>" />
            <input type="hidden" name="pm_send_event_confirmation" value="<?php echo $opt_send_event_confirmation; ?>" />
          
        </form>
    
    </div>
</div>