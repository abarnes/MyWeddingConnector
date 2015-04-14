<?php
/*------------------------------------------------
config.php - LeadCarrier

Configure your API here
-------------------------------------------------*/

$company_name='MyWeddingConnector';                                                            //your company name (capitalization matters!)
$apitoken = 'ao3f9t6wz9gpvq5ghy';                                                               //your company's API token
$site_url = 'http://myweddingconnector.com';                                                  //your own website URL (not your lead carrier access URL)        
$leadcarrier_url = 'http://mwc.leadcarrier.com';                                                  //your company's Lead Carrier access url (e.g. company.leadcarrier.com)
$submit_type = 'separate';                                                            //If you are submitting client information AND industry selections at once, set this to 'together'
// If $submit_type is set to separate:                                                //For separate information and industry selection submissions, set this to 'separate'
    $selection_url = 'http://myweddingconnector.com/pages/select';                      //if using separate pages for information and selections, specify the URL of the selections page

    
$redirect_url = 'http://myweddingconnector.com/pages/thankyou';                 //URL to redirect to when information and selections are submitted (end page)
                                                    
                                                    
/*------------------------Style variables-------------------------------*/

//Classes (set these variables to class names that you can style in your own CSS files)
$select_label_class = '';                           //class applied to the form's <label> tags
$submit_button_class = '';                          //class applied to the submit button <input type="submit">
$input_text_class = '';                             //class applied to text input boxes <input type="text">
$input_check_class = '';                            //class applied to check box inputs <input type="checkbox">
$input_textarea_class = '';                         //class applied to the form's <textarea> tag


/*------------------------Do not edit below this line-------------------------------*/

$post = array(
    'api_token' => $apitoken,
    'company_name'=>$company_name
);
if ($submit_type=='separate') {
    $parse_url = 'parse_info';
} else {
    $parse_url = 'parse_all';
}
?>