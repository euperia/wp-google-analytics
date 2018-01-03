<?php
/**
 * Retrieves data from the database
 *
 * @category Deserializer
 * @package  Euperia_Google_Analytics
 * @author   Andrew McCombe <euperia@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.euperia.com/wordpress-plugins/google-analytics/1855
 */

/**
 * Retrieves data from the database
 *
 * @category Class
 * @package  Euperia_Google_Analytics
 * @author   Andrew McCombe <euperia@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.euperia.com/wordpress-plugins/google-analytics/1855
 */
class Deserializer
{

    public function get_value($optionKey)
    {
        return get_option($optionKey, ''); 
    }   

}
