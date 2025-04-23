Mail
====================

This module is for sending email, specifically 
using zepto mail API
=========================================

Question regarding this please post at trongate.io/help_bar
Put phpMailer in the title.
=========================================

Important!

These 2 lines of code are to call in the function to send the email.

    $this->module('mail');
    $this->mail->send_mail($data)


Below is the code from the members module controller file.
Add the code after //NB!! to existing code
===Code is same for _send_activate_account_email also.===

    function _send_password_reset_email($member_obj, $reset_url) {
        //send an email inviting the user to goto the $reset url
        $data['subject'] = 'Password Reset';
        $data['target_name'] = $member_obj->first_name.' '.$member_obj->last_name;
        $data['target_email'] = $member_obj->email_address;
        $data['member_obj'] = $member_obj;
        $data['reset_url'] = $reset_url;
        $data['msg_html'] = $this->view('msg_password_reset_invite', $data, true);
        $msg_plain = str_replace('</p>', '\\n\\n', $data['msg_html']);
        $data['msg_plain'] = strip_tags($msg_plain);

        // NB!! new code for sending email: see module 'mail' 
        
        $this->module('mail');
        $this->mail->send_mail($data);
    }

