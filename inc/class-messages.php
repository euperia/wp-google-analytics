<?php
/**
 * Stores and Retrieves messages from WP's transients
 *
 * @category Messages
 * @package  Euperia_Google_Analytics
 * @author   Andrew McCombe <euperia@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.euperia.com/wordpress-plugins/google-analytics
 * 
 * @see https://codex.wordpress.org/Transients_API
 */

/**
 * Stores and Retrieves messages from WP's transients
 *
 * @category Class
 * @package  Euperia_Google_Analytics
 * @author   Andrew McCombe <euperia@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.euperia.com/wordpress-plugins/google-analytics
 */
class Messages
{

    /**
     * Returns a key for this message
     * @return string
     */
    public static function get_key() {
        return get_current_user_id() . '_euperia-google-analyics-id-update-message';
    }

    /**
     * Gets the stored message
     * @return string|array
     */
    public static function get_message($delete = true)
    {
        $key = self::get_key();
        $message = get_transient($key); 
        if ($delete) {
            delete_transient($key);
        }
        return $message;
    }   

    /**
     * Stores the message using WP's transients API
     * @return void
     */
    public static function set_message($value, $type, $timeout = MINUTE_IN_SECONDS)
    {
        set_transient(self::get_key(), ['msg' => $value, 'type' => $type], $timeout);
    }

    /**
     * Gets any messages and echo's them
     * 
     * @return html
     */
    public static function get_admin_message() {
        $message = self::get_message();

        if (!$message) {
            return false;
        }
        echo sprintf(
            '<div class="notice notice-%s"><p>%s</p></div>',
            $message['type'],
            $message['msg']
        ); 
    }

}
