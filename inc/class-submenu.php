<?php
 /**
 * Creates the Sub menu on WP admin Settings
 *
 * @category Submenu
 * @package  Euperia_Google_Analytics
 * @author   Andrew McCombe <euperia@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.euperia.com/wordpress-plugins/google-analytics
 */

/**
 * Creates a sub Page for the plugin
 *
 * @category Class
 * @package  Euperia_Google_Analytics
 * @author   Andrew McCombe <euperia@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://www.euperia.com/wordpress-plugins/google-analytics
 */
class Submenu 
{
    /** @var Submenu_Page object */
    public $subMenuPage;

    /**
     * Constructor simpy sets the subMenuPage property
     */
    public function __construct($subMenuPage)
    {
        $this->subMenuPage = $subMenuPage;
    }

    /**
     * Init
     * sets up the action to set up the menu item
     * @return void
     */
    public function init()
    {
        add_action('admin_menu', [$this, 'addOptionsPage']);
    }

    /**
     * Set up the menu option
     * @return void
     */
    public function addOptionsPage()
    {
        add_action('admin_notices', ['Messages', 'get_admin_message']);
        add_options_page(
            'Euperia Google Analytics Admin',
            'Google Analytics ID',
            'manage_options',
            'euperia-google-analytics-page',
            [
                $this->subMenuPage, 'render'
            ]
        );
    }
}