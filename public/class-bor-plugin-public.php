<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       none
 * @since      1.0.0
 *
 * @package    Bor_Plugin
 * @subpackage Bor_Plugin/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Bor_Plugin
 * @subpackage Bor_Plugin/public
 * @author     Todor Valkov <todorv1@gmail.com>
 */
class Bor_Plugin_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;
	private $table_activator;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		require_once plugin_dir_path( __DIR__ ) . "includes/class-bor-plugin-activator.php";
		$activator = new Bor_Plugin_Activator();

		$this->table_activator = $activator;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( 'bootstrap_css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' );
		wp_enqueue_style( "owt-datatable", TESTOV_PLUGIN_URL . 'assets/css/jquery.dataTables.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( "owt-sweetalert", TESTOV_PLUGIN_URL . 'assets/css/sweetalert.css', array(), $this->version, 'all' );
		

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script("jquery");
		wp_enqueue_script( 'owt-bootstrap-js', TESTOV_PLUGIN_URL . 'assets/js/bootstrap.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'owt-datatables-js', TESTOV_PLUGIN_URL . 'assets/js/jquery.dataTables.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'owt-sweetalert-js', TESTOV_PLUGIN_URL . 'assets/js/sweetalert.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'owt-validate-js', TESTOV_PLUGIN_URL . 'assets/js/jquery.validate.min.js', array( 'jquery' ), $this->version, false );
			

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/bor-plugin-public.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( $this->plugin_name, "todor_bor", array(
			"name" => "bor-pl",
			"author" => "Todor Valkov",
			"ajaxurl" => admin_url("admin-ajax.php")
		));
	}

	public function edit_bor_project(){
		
		ob_start();

		include_once TESTOV_PLUGIN_DIR_PATH."public/partials/bor-edit-project-content.php";

		$template = ob_Get_contents();

		ob_end_clean();

		echo $template;
	}

	// projects list shrotcode
	public function load_bor_projects(){

		global $wpdb;

		$projects = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT * from ".$this->table_activator->wp_bor_projects(), ""
			)
		);

		ob_start();

		include_once TESTOV_PLUGIN_DIR_PATH."public/partials/bor-projects-list-content.php";

		$template = ob_Get_contents();

		ob_end_clean();

		echo $template;
	}

	public function our_own_custom_page_template(){
		global $post;

		if($post->post_name == "bor_tool"){
			$page_template = TESTOV_PLUGIN_DIR_PATH."public/partials/bor-tool-layout.php";
		}elseif ($post->post_name == "bor_projects_list"){

			$page_template = TESTOV_PLUGIN_DIR_PATH."public/partials/bor-projects-list-layout.php";

		}
		return $page_template;
	}
	// create project shortcode
	public function load_bor_tool_content(){

		ob_start();

		include_once TESTOV_PLUGIN_DIR_PATH."public/partials/bor-tool-content.php";

		$template = ob_Get_contents();

		ob_end_clean();

		echo $template;
	}

	public function handle_ajax_request_public(){
		$param = isset($_REQUEST['param']) ? $_REQUEST['param'] : "";

		if(!empty($param)){
			if($param == "first_ajax_request"){
				echo json_encode(array(
					"status" => 1,
					"message" => "success"
				));
			}
			elseif($param == "create_project"){
				global $wpdb;
				//print_r($_REQUEST);

				//$shelf_id = isset($_REQUEST['dd_book_shelf']) ? intval($_REQUEST['dd_book_shelf']) : 0;
				

				$txt_name = isset($_REQUEST['txt_name']) ? $_REQUEST['txt_name'] : "";
				
				//$txt_email = isset($_REQUEST['txt_email']) ? $_REQUEST['txt_email'] : "";
				//$txt_publication = isset($_REQUEST['txt_publication']) ? $_REQUEST['txt_publication'] : "";
				
				$txt_description = isset($_REQUEST['txt_description']) ? $_REQUEST['txt_description'] : "";

				$txt_date = isset($_REQUEST['end_date']) ? $_REQUEST['end_date'] : "";

				//$image = isset($_REQUEST['book_cover_image']) ? $_REQUEST['book_cover_image'] : "";
				//$txt_cost = isset($_REQUEST['txt_cost']) ? intval($_REQUEST['txt_cost']) : 0;
				//$dd_status = isset($_REQUEST['dd_status']) ? intval($_REQUEST['dd_status']) : 0;
				
				$wpdb->insert(
					$this->table_activator->wp_bor_projects(),
						array(
							"name" => $txt_name,
							"description" => $txt_description,
							'end_date' => $txt_date,
						)
					);
				if($wpdb->insert_id > 0){
					echo json_encode(array(
						"status" => 1,
						"message" => "Book created successfully",
					));
				}else{
					echo json_encode(array(
						"status" => 0,
						"message" => "Book was not created successfully"
					));
				}
				
			}elseif($param == 'delete_project'){
				global $wpdb;
				$project_id = isset($_REQUEST['project_id']) ? intval($_REQUEST['project_id']) : 0;

				if($project_id > 0){
					$wpdb->delete($this->table_activator->wp_bor_projects(), array(
						"id" => $project_id
					));
					echo json_encode(array(
						"status" => 1,
						"message" => "Project #".$project_id. " was deleted.",
					));
				}else{
					echo json_encode(array(
						"status" => 0,
						"message" => "Project Id is not valid.",
					));
				}
			}elseif($param == 'edit_project'){
				global $wpdb;
				$project_id = isset($_REQUEST['project_id']) ? intval($_REQUEST['project_id']) : 0;

				if($project_id > 0){

					$project = $wpdb->get_results(
						$wpdb->prepare("
						SELECT * FROM wp_database.wp_bor_projects WHERE id = ".$project_id, ""
						)
					);

					echo json_encode(array(
						"status" => 1,
						"message" => "About to edit ".($project[0]->end_date),
						"name" => ($project[0]->name),
						"description" => ($project[0]->description),
						"end_date" => ($project[0]->end_date),
						"project_id" => $project_id,
					));
	
				}else{
					echo json_encode(array(
						"status" => 0,
						"message" => "Project Id is not valid.",
					));
				}
			}elseif($param =='update_project'){
				global $wpdb;
				$project_id = isset($_REQUEST['project_id']) ? intval($_REQUEST['project_id']) : 0;
				if($project_id>0){
				
					$txt_name = isset($_REQUEST['txt_name']) ? $_REQUEST['txt_name'] : "";
					$txt_description = isset($_REQUEST['txt_description']) ? $_REQUEST['txt_description'] : "";
					$txt_date = isset($_REQUEST['end_date']) ? $_REQUEST['end_date'] : "";
	
					$wpdb->update("wp_bor_projects",  array("name" => $txt_name, "description" => $txt_description, "end_date" => $txt_date), array("id" =>  $project_id));
					
					echo json_encode(
						array("status" => 1,
						"message" => "Successful update",
						)
					);
				}else{
					echo json_encode(
						array(
							"status" => 0,
							"message" => "Some kind of error",
						));
				}
			}
		}

		wp_die();
	}


}
