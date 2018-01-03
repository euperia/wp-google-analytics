<?php
/**
 * Performs all sanitisation functionality required to
 * save the option values to the database
 *
 * @category Serializer
 * @package  Euperia_Google_Analytics
 * @author   Andrew McCombe <euperia@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.euperia.com/wordpress-plugins/google-analytics
 */

/**
 * Performs all sanitisation functionality required to
 * save the option values to the database
 *
 * @category Class
 * @package  Euperia_Google_Analytics
 * @author   Andrew McCombe <euperia@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.euperia.com/wordpress-plugins/google-analytics
 */
class Serializer
{

    /**
     * Initialisation
     *
     * @return void
     */ 
    public function init()
    {
        add_action('admin_post', [$this, 'save']);
    }

    /**
     * Save the data to storage
     *
     * @return void
     */
    public function save()
    {       
        $errors = [];
        $update = [];
        
        // validate
        if (!($this->_hasValidNonce())) {
            Messages::set_message('Invalid Nonce', 'error');
            $this->_redirect();
        }

        if (! current_user_can('manage_options')) {
            Messages::set_message('User permissions wrong', 'error');
            $this->_redirect();
        }

        if (false === $this->_isValidFormat()) {
            Messages::set_message('Tracking ID has an invalid format', 'error');
            $this->_redirect();
        }

        // sanitize
        if (null !== wp_unslash($_POST['euperia-google-analytics-id-message'])) {
            $value = sanitize_text_field($_POST['euperia-google-analytics-id']);
            update_option('euperia-google-analytics-id', $value);
            Messages::set_message('Your Google Analytics tracking ID has been updated.', 'success');
            $this->_redirect();
        } else {
            Messages::set_message('Problem with POSTed variables', 'error');
            $this->_redirect();
        }
    }

    /**
     * Does the tracking ID match the Google Analytics format?
     * @see https://support.google.com/analytics/answer/7372977?hl=en
     * @return boolean
     */
    private function _isValidFormat()
    {
        $value = sanitize_text_field($_POST['euperia-google-analytics-id']);
        $result =  preg_match('/^ua-\d{4,9}-\d{1,4}$/i', $value, $matches);
        return ($result === 1);
    }

    /**
     * Determines if the nonce variable is associated with the options page
     * and is valid
     *
     * @return boolean
     */ 
    private function _hasValidNonce()
    {
        if (false === isset($_POST['euperia-google-analytics-id-message'])) {
            return false;
        }

        $field = wp_unslash($_POST['euperia-google-analytics-id-message']);
        $action = 'euperia-google-analytics-id-save';

        return wp_verify_nonce($field, $action);
    }

    /**
     * Perform HTTP Redirect
     *
     * @return void
     */ 
    private function _redirect()
    {
        if (!isset($_POST['_wp_http_referer'])) {
            $_POST['_wp_http_referer'] = wp_login_url();
        }

        $url = sanitize_text_field(
            wp_unslash($_POST['_wp_http_referer'])
        );

        wp_safe_redirect(urldecode($url));
        exit();
    }
}
