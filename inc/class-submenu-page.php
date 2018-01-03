<?php
 /**
 * Creates a sub Page for the plugin
 *
 * @category Submenu_Page
 * @package  Euperia_Google_Analytics
 * @author   Andrew McCombe <euperia@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.euperia.com/wordpress-plugins/google-analytics/1855
 */

/**
 * Creates a sub Page for the plugin
 *
 * @category Class
 * @package  Euperia_Google_Analytics
 * @author   Andrew McCombe <euperia@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.euperia.com/wordpress-plugins/google-analytics/1855
 */
class Submenu_Page
{

    /** @var Deserializer object */
    public $deserializer;

    /**
     * constructor simply sets the deserializer object
     */
    public function __construct($deserializer)
    {
        $this->deserializer = $deserializer;
    }

    /**
     * Output the settings page
     */
    public function render()
    {
        include_once  __DIR__ . '/../views/settings.php';
    }
}
