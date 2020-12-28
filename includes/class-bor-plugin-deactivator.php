<?php

/**
 * Fired during plugin deactivation
 *
 * @link       none
 * @since      1.0.0
 *
 * @package    Bor_Plugin
 * @subpackage Bor_Plugin/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Bor_Plugin
 * @subpackage Bor_Plugin/includes
 * @author     Todor Valkov <todorv1@gmail.com>
 */
class Bor_Plugin_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		global $wpdb;
		$wpdb->query("DROP TABLE IF EXISTS wp_bor_projects");
		//$wpdb->query("DROP TABLE IF EXISTS wp_owt_tbl_book_shelf");
		

		//delete page when plugin deactivate 
		$get_data = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT ID from ".$wpdb->prefix."posts WHERE post_name = %s",
				"bor_tool"
			)
		);

		$page_id = $get_data->ID;

		if($page_id > 0){
			//delete
			wp_delete_post($page_id, true);
		}
	}

}
