<?php

/**
 * Fired during plugin activation
 *
 * @link       none
 * @since      1.0.0
 *
 * @package    Bor_Plugin
 * @subpackage Bor_Plugin/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Bor_Plugin
 * @subpackage Bor_Plugin/includes
 * @author     Todor Valkov <todorv1@gmail.com>
 */
class Bor_Plugin_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public function activate() {

		//dynamic table generating code... 
		require_once (ABSPATH.'wp-admin/includes/upgrade.php');
		
		global $wpdb;

		if($wpdb->get_var("SHOW tables like '".$this->wp_bor_projects()."'") != $this->wp_bor_projects()){

			$table_query = "CREATE TABLE `".$this->wp_bor_projects()."` (
							`id` int(11) NOT NULL AUTO_INCREMENT,
							`name` varchar(150) DEFAULT NULL,
							`description` text,
							`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
							`end_date` timestamp NOT NULL,
							PRIMARY KEY (`id`)
						   ) ENGINE=MyISAM DEFAULT CHARSET=latin1"; // table create query

			dbDelta($table_query);
		}

		//create page on plugin activation
		$get_data = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT * from ".$wpdb->prefix."posts WHERE post_name = %s",
				"bor_tool"
			)
		);

		if(empty($get_data)){
			//create page
			$post_arr_data = array(
				"post_title" => "Create Bor Project",
				"post_name" => "bor_tool",
				"post_status" => "publish",
				"post_autoh" => 1,
				"post_content" => "Simple page content of Bor Tool",
				"post_type" => "page"
			);
			wp_insert_post( $post_arr_data);
		}


		//create page on plugin activation
		$hasProjectList = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT * from ".$wpdb->prefix."posts WHERE post_name = %s",
				"bor_projects_list"
			)
		);

		if(empty($hasProjectList)){
			//create page
			$post_arr_data = array(
				"post_title" => "Project List",
				"post_name" => "bor_projects_list",
				"post_status" => "publish",
				"post_autoh" => 1,
				"post_content" => "Simple page content of Bor Project List",
				"post_type" => "page"
			);
			wp_insert_post( $post_arr_data);
		}


	}
	public function wp_bor_projects(){

		global $wpdb;
		return $wpdb->prefix."bor_projects"; // $wpdb->prefix => wp_
	}

	//public function wp_bor_tbl_book_shelf(){
	//	global $wpdb;
	//	return $wpdb->prefix."owt_tbl_book_shelf";
	//}

}
