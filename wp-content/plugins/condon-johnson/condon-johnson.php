<?php
/**
 * Plugin Name: Condon Johnson
 * Plugin URI: http://condon-johnson.com/
 * Description: Business logic
 * Version: 1.0.0
 * Author: Condon Johnson
 * Author URI: http://condon-johnson.com/
 * Requires at least: 4.6.1
 * Tested up to: 4.6.1
 * Copyright (c) 2016 Condon Johnson
 */

if ( !function_exists( 'add_action' ) ) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists( 'WP_List_Table' ) ) {
   require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class CJ_List extends WP_List_Table {
    /** Class constructor */
    public $columns = [];
    private $options = [];
    public function __construct($table_name, $columns = [], $options = []) {
        $this->options = array_merge([
          'edit' => false,
        ], $options);
        self::$select_sql = '';
        $this->columns = $columns;
        parent::__construct([
         //   'singular' => __('Type'),  // Singular name of the listed records
         //   'plural'   => __('Types'), // Plural name of the listed records
           'ajax'     => false           // Should this table support ajax?
        ]);
        self::$table_name = $table_name;
        if (!empty($options['select_sql'])) {
          self::$select_sql = $options['select_sql'];
        }
        $this->prepare_items();
    }
    public static $table_name = "";
    public static $select_sql = '';
    public static function get_records($per_page = 5, $page_number = 1) {
        global $wpdb;
        $sql = ((empty(self::$select_sql))?"SELECT * FROM ".self::$table_name:self::$select_sql);
        // CondonJohnson::log($sql);
        // CondonJohnson::log(self::$select_sql);
        if (!empty($_REQUEST['orderby'])) {
          $sql .= ' ORDER BY ' . esc_sql( $_REQUEST['orderby'] );
          $sql .= ! empty( $_REQUEST['order'] ) ? ' ' . esc_sql( $_REQUEST['order'] ) : ' ASC';
        }
        $sql .= " LIMIT $per_page";
        $sql .= ' OFFSET '.($page_number - 1)*$per_page;
        $result = $wpdb->get_results($sql, 'ARRAY_A');
        return $result;
    }

    public static function record_count() {
        global $wpdb;
        $sql = "SELECT * FROM ".self::$table_name;
        $result = $wpdb->get_results($sql, 'ARRAY_A');
        return count($result);                          // $wpdb->get_var($sql);
    }

    public function process_bulk_action() {
        global $wpdb;

        //CondonJohnson::log('process_bulk_action');
       /* if ('edit' === $this->current_action()) {
           $nonce = esc_attr($_REQUEST['_wpnonce']);
           if (!wp_verify_nonce($nonce, self::$table_name)) {
             die('Go get a life script kiddies');
           }
        }*/

        //Detect when a bulk action is being triggered...
        if ('delete' === $this->current_action()) {
            // In our file that handles the request, verify the nonce.
            $nonce = esc_attr($_REQUEST['_wpnonce']);
            //CondonJohnson::log($nonce);
            if (!wp_verify_nonce($nonce, self::$table_name)) {
              die('Go get a life script kiddies');
            } else {
                $wpdb->delete(
                    self::$table_name,
                    ['ID' => absint($_GET['id'])],
                    ['%d']
                );
            }
        }

        // If the delete bulk action is triggered
        if ((isset($_POST['action']) && $_POST['action'] == 'bulk-delete')
            || (isset($_POST['action2']) && $_POST['action2'] == 'bulk-delete')
        ) {
            $delete_ids = esc_sql($_POST['bulk-delete']);
            // loop over the array of record IDs and delete them
            foreach ($delete_ids as $id) {
                $wpdb->delete(
                    self::$table_name,
                    ['ID' => absint($id)],
                    ['%d']
                );
            }
        }
        //*/
    }

    function extra_tablenav( $which ) {
        if ($which == "top") {
            //The code that goes before the table is here
            //echo"Hello, I'm before the table";
        }
        if ($which == "bottom") {
            //The code that goes after the table is there
            //echo"Hi, I'm after the table";
        }
    }


    public function get_bulk_actions() {
        $actions = [
            'bulk-delete' => 'Delete'
        ];
        return $actions;
    }
    public function get_sortable_columns() {
        $sortable_columns = array(
            //'name' => array('name', true)
        );
        foreach ($this->columns as $c) {
            if (is_string($c)) {
              $sortable_columns[$c] = [$c, true];
            }
            // ((!empty($c['sort']) && $c['sort'] == false)?false:true)
            //CondonJohnson::log($c);
            if (is_array($c) && (!isset($c['no_sort']))) {
              $sortable_columns[$c['name']] = [$c['name'], true];
            }
        }
        return $sortable_columns;
    }

    function get_columns() {
        $columns = [
            'cb'      => '<input type="checkbox" />',
     //     'name'    => __('Name'),
        ];
        // CondonJohnson::log($this->columns);
        foreach ($this->columns as $c) {
          if (is_string($c)) {
            $columns[$c] = ucfirst($c);
          }
          if (is_array($c)) {
            $columns[$c['name']] = ((!empty($c['label']))?$c['label']:ucfirst($c['name']));
          }
        }
        return $columns;
    }

    public function no_items() {
        _e('No records', 'sp');
    }

    function column_cb( $item ) {
        return sprintf(
            '<input type="checkbox" name="bulk-delete[]" value="%s" />', $item['id']
        );
    }

    function column_name( $item ) {
        // create a nonce
        $nonce = wp_create_nonce(self::$table_name);
        $title = '<strong>'.$item['name'].'</strong>';
        $actions = [
            'delete' => sprintf('<a href="?page=%s&action=%s&id=%s&_wpnonce=%s">Delete</a>', esc_attr($_REQUEST['page']), 'delete', absint($item['id']), $nonce),
        ];
        if ($this->options['edit']) {
          $actions['edit'] = sprintf('<a href="?page=%s&action=%s&id=%s&_wpnonce=%s">Edit</a>', esc_attr($_REQUEST['page']), 'edit', absint($item['id']), $nonce);
        }
        return $title . $this->row_actions( $actions );
    }

    public function column_default($item, $column_name) {
        if (!empty($item[$column_name])) {
            return $item[$column_name];
        } else {
            return '';
          //  return print_r($item, true);
        }
    }

    public function prepare_items() {
        global $_wp_column_headers;
        $screen   = get_current_screen();
        $columns  = $this->get_columns();
        $hidden   = array();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array($columns, $hidden, $sortable);

        /** Process bulk action */
        $this->process_bulk_action();
        $per_page     = $this->get_items_per_page('types_project_per_page', 20);
        $current_page = $this->get_pagenum();
        $total_items  = self::record_count();

        $this->set_pagination_args([
            'total_items' => $total_items, // WE have to calculate the total number of items
            'per_page'    => $per_page     // WE have to determine how many items to show on a page
        ]);

        /* -- Register the Columns -- */
        $columns = $this->get_columns();
        $_wp_column_headers[$screen->id] = $columns;

        /* -- Fetch the items -- */
        $this->items = $this->get_records($per_page, $current_page);
    }

    /*
    public function display_rows() {
       $records = $this->items;
       $columns = $this->get_columns();

       //CondonJohnson::log($records);
       foreach($records as $rec) {
          echo '<tr id="record_'.$rec['id'].'">';
           //CondonJohnson::log($columns);

          foreach ($columns as $column_name => $column_display_name) {
            $class      = "class='$column_name column-$column_name'";
            $style      = "";
            $attributes = $class.$style;
            echo '<td '.$attributes.'>'.stripslashes($rec[$column_name]).'</td>';
          }

          echo '</tr>';
       }
   }
   //*/
}


if (!class_exists('CondonJohnson')) {
    final class CondonJohnson {
        protected static $_instance = null;
        protected static $uploaddir  = '/../../uploads/';

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }
        public static function xlog($tag, $msg, $timestamp = true) {
            $path =  __DIR__.'/../../../logs';
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $msg = print_r($msg, true);
            $today = date("d.m.Y");
            $filename = $path."/{$tag}_{$today}.txt";
            if (!file_exists($filename)) {
                //chmod($filename, 0777);
            }
            $fd = fopen($filename, "a+");
            $str = ($timestamp)?"[" . date("d/m/Y h:i:s", time()) . "] " . $msg:$msg;
            fwrite($fd, $str . PHP_EOL);
            fclose($fd);
            //chmod($filename, 0644);
        }
        public static function log($msg, $timestamp = true) {
            self::xlog('xlog', $msg, $timestamp);
        }

        public static function install () {
          require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
          global $wpdb;
          // self::log('Install plugin is good');

          $charset_collate = $wpdb->get_charset_collate();
          $sql = "CREATE TABLE cj_projects (
		    id int NOT NULL AUTO_INCREMENT,
		    type int NOT NULL,
		    photo varchar(255) NOT NULL,
		    name tinytext NOT NULL,
            description text,
            city varchar(255) NOT NULL,
            adress varchar(255) NOT NULL,
            position varchar(255),
            created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            feature int,
		    PRIMARY KEY  (id)
	      ) $charset_collate;";
          // self::log($sql);
          $result = dbDelta($sql);

          $sql = "
            CREATE TABLE cj_types_project (
		       id int NOT NULL AUTO_INCREMENT,
		       name tinytext NOT NULL,
		       PRIMARY KEY  (id)
	      ) $charset_collate;
          ";
          $result = dbDelta($sql);

          $sql = "
            CREATE TABLE cj_photos_project (
		       id         int NOT NULL AUTO_INCREMENT,
		       project_id int NOT NULL,
		       photo      varchar(255) NOT NULL,
		       PRIMARY KEY  (id)
	      ) $charset_collate;
          ";
          $result = dbDelta($sql);

          $sql = "
            CREATE TABLE cj_contacts (
		       id         int NOT NULL AUTO_INCREMENT,
		       name       varchar(255) NOT NULL,
		       phone      varchar(32) NOT NULL,
		       email      varchar(255) NOT NULL,
		       subject    varchar(255) NOT NULL,
               message    text,
		       created    TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
		       PRIMARY KEY  (id)
	      ) $charset_collate;
          ";
          $result = dbDelta($sql);

          $sql = "
            CREATE TABLE cj_team (
		       id          int NOT NULL AUTO_INCREMENT,
		       name        varchar(255) NOT NULL,
		       position    varchar(255) NOT NULL,
		       photo       varchar(255) NOT NULL,
               description text,
		       created     TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
		       feature int,
		       PRIMARY KEY  (id)
	      ) $charset_collate;
          ";
          $result = dbDelta($sql);

          $sql = "
            CREATE TABLE cj_jobs (
		       id          int NOT NULL AUTO_INCREMENT,
		       name        varchar(255) NOT NULL,
		       location    varchar(255) NOT NULL,
               description text,
               url         varchar(255) NOT NULL,
		       created     TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
		       PRIMARY KEY  (id)
	      ) $charset_collate;
          ";
            $result = dbDelta($sql);


            $sql = "
            CREATE TABLE cj_publications (
		       id          int NOT NULL AUTO_INCREMENT,
		       photo       varchar(255) NOT NULL,
		       type        int NOT NULL,

		       name        varchar(255),
		       donwload    varchar(255),

		       created     TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
		       PRIMARY KEY  (id)
	      ) $charset_collate;
          ";
            $result = dbDelta($sql);

            $sql = "
            CREATE TABLE cj_affiliated_organizations (
		       id          int NOT NULL AUTO_INCREMENT,
		       photo       varchar(255) NOT NULL,
		       url         varchar(255),
		       created     TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
		       PRIMARY KEY  (id)
	      ) $charset_collate;
          ";
            $result = dbDelta($sql);

            $sql = "
            CREATE TABLE cj_social_media (
		       id          int NOT NULL AUTO_INCREMENT,
		       photo       varchar(255) NOT NULL,
		       url         varchar(255),
		       created     TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
		       PRIMARY KEY  (id)
	      ) $charset_collate;
          ";
            $result = dbDelta($sql);

          // self::log($result);
        }
        public static function loadResources () {
          /*wp_register_style('angular-material.min.css', plugins_url('monthlygift/assets/angular/angular-material.min.css'));
            wp_enqueue_style('angular-material.min.css');

            wp_register_script('angular.js', plugins_url('monthlygift/assets/angular/angular.js'));
            wp_enqueue_script('angular.js');

            wp_register_script('angular-animate.min.js', plugins_url('monthlygift/assets/angular/angular-animate.min.js'));
            wp_enqueue_script('angular-animate.min.js');

            wp_register_script('angular-aria.min.js', plugins_url('monthlygift/assets/angular/angular-aria.min.js'));
            wp_enqueue_script('angular-aria.min.js');

            wp_register_script('svg-assets-cache.js', plugins_url('monthlygift/assets/angular/svg-assets-cache.js'));
            wp_enqueue_script('svg-assets-cache.js');

            wp_register_script('angular-material.min.js', plugins_url('monthlygift/assets/angular/angular-material.min.js'));
            wp_enqueue_script('angular-material.min.js');

            wp_register_script('angular-messages.min.js', plugins_url('monthlygift/assets/angular/angular-messages.min.js'));
            wp_enqueue_script('angular-messages.min.js');

            wp_register_script('angular-ui-router.min.js', plugins_url('monthlygift/assets/angular/angular-ui-router.min.js'));
            wp_enqueue_script('angular-ui-router.min.js');

            wp_register_script('angular-local-storage.min.js', plugins_url('monthlygift/assets/angular/angular-local-storage.min.js'));
            wp_enqueue_script('angular-local-storage.min.js');

            wp_register_script('global.js', plugins_url('monthlygift/app/global.js'));
            wp_enqueue_script('global.js');*/
          // wp_register_script('wp-mediaelement.js', '/wp-includes/js/mediaelement/wp-mediaelement.js');
          // wp_enqueue_script('wp-mediaelement.js');
        }
        public static function initMenu() {
            add_menu_page('Condon Johnson', 'Condon Johnson', 'manage_options', 'condonjohnson-projects-m', ['CondonJohnson', 'projectsPage'], null, 0);
            add_submenu_page('condonjohnson-projects-m', 'Projects', 'Projects', 'manage_options', 'condonjohnson-projects', ['CondonJohnson', 'projectsPage']);
            add_submenu_page(
                'condonjohnson-projects-m-hide',
                'Add New Project',
                'Add New Project',
                'manage_options',
                'condonjohnson-project-create',
                array('CondonJohnson', 'projectCreatePage')
            );

            add_submenu_page('condonjohnson-projects-m', 'Types project', 'Types project', 'manage_options', 'condonjohnson-type-project', ['CondonJohnson', 'typesProjectPage']);
            add_submenu_page(
                'condonjohnson-projects-m-hide',
                'Add New Type Project',
                'Add New Type Project',
                'manage_options',
                'condonjohnson-type-project-create',
                array('CondonJohnson', 'typeProjectCreatePage')
            );

            add_submenu_page('condonjohnson-projects-m', 'Contacts', 'Contacts', 'manage_options', 'condonjohnson-contacts', ['CondonJohnson', 'contactsPage']);

            add_submenu_page('condonjohnson-projects-m', 'Condon Johnson TEAM', 'Condon Johnson TEAM', 'manage_options', 'condonjohnson-team', ['CondonJohnson', 'teamPage']);
            add_submenu_page(
                'condonjohnson-projects-m-hide',
                'Add New Member of Condon Johnson TEAM',
                'Add New Member of Condon Johnson TEAM',
                'manage_options',
                'condonjohnson-team-create',
                array('CondonJohnson', 'memberCreatePage')
            );

            add_submenu_page('condonjohnson-projects-m', 'Jobs', 'Jobs', 'manage_options', 'condonjohnson-jobs', ['CondonJohnson', 'jobsPage']);
            add_submenu_page(
                'condonjohnson-projects-m-hide',
                'Add New Job',
                'Add New Job',
                'manage_options',
                'condonjohnson-job-create',
                array('CondonJohnson', 'jobCreatePage')
            );

            add_submenu_page('condonjohnson-projects-m', 'Publications', 'Publications', 'manage_options', 'condonjohnson-publications', ['CondonJohnson', 'publicationsPage']);
            add_submenu_page(
                'condonjohnson-projects-m-hide',
                'Add New publication',
                'Add New publication',
                'manage_options',
                'condonjohnson-publication-create',
                array('CondonJohnson', 'publicationCreatePage')
            );

            add_submenu_page('condonjohnson-projects-m', 'Affiliated organizations', 'Affiliated organizations', 'manage_options', 'condonjohnson-affiliated-organizations', ['CondonJohnson', 'affiliatedOrganizationsPage']);
            add_submenu_page(
                'condonjohnson-projects-m-hide',
                'Add New affiliated organization',
                'Add New affiliated organization',
                'manage_options',
                'condonjohnson-affiliated-organization-create',
                array('CondonJohnson', 'affiliatedOrganizationCreatePage')
            );

            add_submenu_page('condonjohnson-projects-m', 'Social medias', 'Social medias', 'manage_options', 'condonjohnson-social-medias', ['CondonJohnson', 'socialMediaPage']);
            add_submenu_page(
                'condonjohnson-projects-m-hide',
                'Add New social media',
                'Add New social media',
                'manage_options',
                'condonjohnson-social-media-create',
                array('CondonJohnson', 'socialMediaCreatePage')
            );

        }
        public static function init_hooks() {
            add_action('admin_enqueue_scripts', ['CondonJohnson', 'loadResources']);
            add_action('wp_ajax_condonjohnson_ajax', array('CondonJohnson', 'ajax'));
            add_action('wp_ajax_nopriv_condonjohnson_ajax', array('CondonJohnson', 'ajax'));
            add_action('admin_menu', ['CondonJohnson', 'initMenu']);
        }
        public static function dummyPage() {
          include_once __DIR__.'/pages/dummy.php';
        }
        public static function projectsPage() {
          if (isset($_GET['action']) && $_GET['action'] == 'edit' && !empty($_GET['id'])) {
              $nonce = esc_attr($_GET['_wpnonce']);
              if (!wp_verify_nonce($nonce, 'cj_projects')) {
                die('Go get a life script kiddies');
              }
              $sql = "select * from cj_projects WHERE cj_projects.id = ".intval($_GET['id']);
              //self::log($sql);
              global $wpdb;
              $project = $wpdb->get_results($sql, 'ARRAY_A');
              //self::log($project);
              if (!empty($project)) {
                $project = $project[0];
                self::projectCreatePage($project);
                exit;
              }
          }
          include_once __DIR__.'/pages/projects.php';
        }
        public static function projectCreatePage($project) {
          global $wpdb;

            // self::log($project);

            // self::log($_POST);

            $photos = [];

            if (!empty($_POST)) {

              $filename = '';
              $filenames = [];
              if (!empty($_FILES['photo']['name'])) {
                  for($i = 0; $i < count($_FILES['photo']['name']); $i++) {
                      $fi = pathinfo($_FILES['photo']['name'][$i]);
                      $fname = md5($fi['basename'].time()).'.'.$fi['extension'];
                      $filenames[] = $fname;
                      $uploadfile = __DIR__.self::$uploaddir.$fname;
                      if (move_uploaded_file($_FILES['photo']['tmp_name'][$i], $uploadfile)) { }
                  }

                  /*
                  $fi = pathinfo($_FILES['photo']['name']);
                  $filename = md5($fi['basename'].time()).'.'.$fi['extension'];
                  $uploadfile = __DIR__.$uploaddir.$filename;
                  if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) { }
                  */
              }

              if (empty($_POST['id'])) {



               // self::log('try create a new project');
               // self::log($_POST);
                $wpdb->insert(
                  'cj_projects',
                   array(
                     'name'        => $_POST['name'],
                     'type'        => $_POST['type'],
                     'description' => $_POST['description'],
                     'photo'       => !empty($filename)?$filename:'',
                     'adress'      => !empty($_POST['adress'])?$_POST['adress']:'',
                     'position'    => str_replace('"', "'", $_POST['position']),
                     'city'        => !empty($_POST['city'])?$_POST['city']:'',
                     'feature'     => !empty($_POST['feature'])?$_POST['feature']:null,
                   )
                );

                $project_id = $wpdb->insert_id;

               // self::log($project_id);
                for ($j = 0; $j < count($filenames); $j++) {
                      $wpdb->insert(
                          'cj_photos_project',
                          array(
                              'project_id'  => $project_id,
                              'photo'       => $filenames[$j],
                          )
                      );
                }


              } else {
                  $data = [
                      'name'        => $_POST['name'],
                      'type'        => $_POST['type'],
                      'description' => $_POST['description'],
                      'adress'      => $_POST['adress'],
                      'position'    => str_replace('"', "'", $_POST['position']),
                      'city'        => $_POST['city'],
                      'feature'     => $_POST['feature'],
                  ];

                  if (!empty($filename)) {
                     $data['photo'] = $filename;
                  }

                  $wpdb->update(
                      'cj_projects',
                      $data,
                      array(
                        'id' => $_POST['id'],
                      )
                  );

                  for ($j = 0; $j < count($filenames); $j++) {
                      $wpdb->insert(
                          'cj_photos_project',
                          array(
                              'project_id'  => $_POST['id'],
                              'photo'       => $filenames[$j],
                          )
                      );
                  }

              }




              $redirect = '/wp-admin/admin.php?page=condonjohnson-projects';
            }
            $types_project = $wpdb->get_results("select * from cj_types_project", 'ARRAY_A');
            if (!empty($project) && !empty($project['id'])) {
                $photos = $wpdb->get_results("select * from cj_photos_project where cj_photos_project.project_id = ".$project['id'], 'ARRAY_A');
            }
            // self::log($photos);

            include_once __DIR__.'/pages/project-create.php';
        }
        public static function typesProjectPage() {
            if (isset($_GET['action']) && $_GET['action'] == 'edit' && !empty($_GET['id'])) {
                $nonce = esc_attr($_GET['_wpnonce']);
                if (!wp_verify_nonce($nonce, 'cj_types_project')) {
                    die('Go get a life script kiddies');
                }
                $sql = "select * from cj_types_project WHERE cj_types_project.id = ".intval($_GET['id']);
                //self::log($sql);
                global $wpdb;
                $type_project = $wpdb->get_results($sql, 'ARRAY_A');
                //self::log($project);
                if (!empty($type_project)) {
                    $type_project = $type_project[0];
                    self::typeProjectCreatePage($type_project);
                    exit;
                }
            }
            include_once __DIR__.'/pages/types-project.php';
        }
        public static function typeProjectCreatePage($type_project) {
          global $wpdb;
          //self::log($_POST);
          if (!empty($_POST)) {
            if (empty($_POST['id'])) {
              $wpdb->insert(
                  'cj_types_project',
                  array(
                    'name' => $_POST['name']
                  )
              );
            } else {
                $wpdb->update(
                    'cj_types_project',
                    array(
                      'name' => $_POST['name']
                    ),
                    array(
                      'id' => $_POST['id'],
                    )
                );
            }
            $redirect = '/wp-admin/admin.php?page=condonjohnson-type-project';
          }
          include_once __DIR__.'/pages/type-project-create.php';
        }
        public static function contactsPage() {
            include_once __DIR__.'/pages/contacts.php';
        }
        public static function teamPage() {
            if (isset($_GET['action']) && $_GET['action'] == 'edit' && !empty($_GET['id'])) {
                $nonce = esc_attr($_GET['_wpnonce']);
                if (!wp_verify_nonce($nonce, 'cj_team')) {
                    die('Go get a life script kiddies');
                }
                $sql = "select * from cj_team WHERE cj_team.id = ".intval($_GET['id']);
                //self::log($sql);
                global $wpdb;
                $member = $wpdb->get_results($sql, 'ARRAY_A');
                //self::log($project);
                if (!empty($member)) {
                    $member = $member[0];
                    self::memberCreatePage($member);
                    exit;
                }
            }


            include_once __DIR__.'/pages/team.php';
        }
        public static function memberCreatePage($member) {
            global $wpdb;
            if (!empty($_POST)) {
                $filename = '';
                if (!empty($_FILES['photo']['name'])) {
                     $fi = pathinfo($_FILES['photo']['name']);
                     $filename = md5($fi['basename'].time()).'.'.$fi['extension'];
                     $uploadfile = __DIR__.self::$uploaddir.$filename;
                     if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) { }
                }
                if (empty($_POST['id'])) {
                    $wpdb->insert(
                        'cj_team',
                        array(
                            'name'        => $_POST['name'],
                            'position'    => $_POST['position'],
                            'description' => $_POST['description'],
                            'photo'       => !empty($filename)?$filename:'',
                            'feature'     => !empty($_POST['feature'])?$_POST['feature']:null,
                        )
                    );
                    $member_id = $wpdb->insert_id;
                } else {
                    $data = [
                        'name'        => $_POST['name'],
                        'position'    => $_POST['position'],
                        'description' => $_POST['description'],
                        'feature'     => $_POST['feature'],
                    ];
                    if (!empty($filename)) {
                        $data['photo'] = $filename;
                    }
                    $wpdb->update(
                        'cj_team',
                        $data,
                        array(
                            'id' => $_POST['id'],
                        )
                    );
                }
                $redirect = '/wp-admin/admin.php?page=condonjohnson-team';
            }
            include_once __DIR__.'/pages/team-create.php';
        }

        public static function jobsPage() {
            if (isset($_GET['action']) && $_GET['action'] == 'edit' && !empty($_GET['id'])) {
                $nonce = esc_attr($_GET['_wpnonce']);
                if (!wp_verify_nonce($nonce, 'cj_jobs')) {
                    die('Go get a life script kiddies');
                }
                $sql = "select * from cj_jobs WHERE cj_jobs.id = ".intval($_GET['id']);
                //self::log($sql);
                global $wpdb;
                $job = $wpdb->get_results($sql, 'ARRAY_A');
                //self::log($project);
                if (!empty($job)) {
                    $job = $job[0];
                    self::jobCreatePage($job);
                    exit;
                }
            }
            include_once __DIR__.'/pages/jobs.php';
        }
        public static function jobCreatePage($job) {
            global $wpdb;
            if (!empty($_POST)) {
                if (empty($_POST['id'])) {
                  $wpdb->query("
                      INSERT INTO `cj_jobs` (`name`, `location`, `description`, `url`) VALUES ('".$_POST['name']."', '".$_POST['location']."', '".$_POST['description']."', '".$_POST['url']."');
                  ");
                } else {
                    $data = [
                        'name'        => $_POST['name'],
                        'location'    => $_POST['location'],
                        'description' => $_POST['description'],
                        'url'         => $_POST['url'],
                    ];
                    $wpdb->update(
                        'cj_jobs',
                        $data,
                        array(
                            'id' => $_POST['id'],
                        )
                    );
                }
                $redirect = '/wp-admin/admin.php?page=condonjohnson-jobs';
            }
            include_once __DIR__.'/pages/job-create.php';
        }

        public static function publicationsPage() {
            if (isset($_GET['action']) && $_GET['action'] == 'edit' && !empty($_GET['id'])) {
                $nonce = esc_attr($_GET['_wpnonce']);
                if (!wp_verify_nonce($nonce, 'cj_publications')) {
                    die('Go get a life script kiddies');
                }
                $sql = "select * from cj_publications WHERE cj_publications.id = ".intval($_GET['id']);
                //self::log($sql);
                global $wpdb;
                $publication = $wpdb->get_results($sql, 'ARRAY_A');
                //self::log($project);
                if (!empty($publication)) {
                    $publication = $publication[0];
                    self::publicationCreatePage($publication);
                    exit;
                }
            }
            include_once __DIR__.'/pages/publications.php';
        }
        public static function publicationCreatePage($publication) {
            global $wpdb;
            if (!empty($_POST)) {

                $filename = '';
                if (!empty($_FILES['photo']['name'])) {
                    $fi = pathinfo($_FILES['photo']['name']);
                    $filename = md5($fi['basename'].time()).'.'.$fi['extension'];
                    $uploadfile = __DIR__.self::$uploaddir.$filename;
                    if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) { }
                }

                $filename2 = '';
                if (!empty($_FILES['donwload']['name'])) {
                    $fi = pathinfo($_FILES['donwload']['name']);
                    $filename2 = md5($fi['basename'].time()).'.'.$fi['extension'];
                    $uploadfile = __DIR__.self::$uploaddir.$filename2;
                    if (move_uploaded_file($_FILES['donwload']['tmp_name'], $uploadfile)) { }
                }


                if (empty($_POST['id'])) {
                  $sql = "
                    INSERT INTO `cj_publications` (`name`, `type`, `photo`, `donwload`) VALUES ('".$_POST['name']."', '".$_POST['type']."', '".(!empty($filename)?$filename:'')."', '".(!empty($filename2)?$filename2:'')."');
                  ";
                  $wpdb->query($sql);
                } else {
                    $data = [
                        'name'        => $_POST['name'],
                        'type'        => $_POST['type'],
                    ];
                    if (!empty($filename)) {
                        $data['photo'] = $filename;
                    }
                    if (!empty($filename2)) {
                        $data['donwload'] = $filename2;
                    }

                    $wpdb->update(
                        'cj_publications',
                        $data,
                        array(
                            'id' => $_POST['id'],
                        )
                    );
                }
                $redirect = '/wp-admin/admin.php?page=condonjohnson-publications';
            }
            include_once __DIR__.'/pages/publication-create.php';
        }

        // affiliated organizations
        public static function affiliatedOrganizationsPage() {
            if (isset($_GET['action']) && $_GET['action'] == 'edit' && !empty($_GET['id'])) {
                $nonce = esc_attr($_GET['_wpnonce']);
               /* if (!wp_verify_nonce($nonce, 'cj_publications')) {
                    die('Go get a life script kiddies');
                }*/
                $sql = "select * from cj_affiliated_organizations WHERE cj_affiliated_organizations.id = ".intval($_GET['id']);
                //self::log($sql);
                global $wpdb;
                $affiliatedOrganization = $wpdb->get_results($sql, 'ARRAY_A');
                //self::log($project);
                if (!empty($affiliatedOrganization)) {
                    $affiliatedOrganization = $affiliatedOrganization[0];
                    self::affiliatedOrganizationCreatePage($affiliatedOrganization);
                    exit;
                }
            }
            include_once __DIR__.'/pages/affiliated-organizations.php';
        }
        public static function affiliatedOrganizationCreatePage($affiliatedOrganization) {
            global $wpdb;
            if (!empty($_POST)) {
                $filename = '';
                if (!empty($_FILES['photo']['name'])) {
                    $fi = pathinfo($_FILES['photo']['name']);
                    $filename = md5($fi['basename'].time()).'.'.$fi['extension'];
                    $uploadfile = __DIR__.self::$uploaddir.$filename;
                    if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) { }
                }

                if (empty($_POST['id'])) {
                  $sql = "
                    INSERT INTO `cj_affiliated_organizations` (`url`, `photo`) VALUES ('".$_POST['url']."', '".(!empty($filename)?$filename:'')."');
                  ";
                   $wpdb->query($sql);
                } else {
                    $data = [
                        'url'        => $_POST['url'],
                    ];
                    if (!empty($filename)) {
                        $data['photo'] = $filename;
                    }

                    $wpdb->update(
                        'cj_affiliated_organizations',
                        $data,
                        array(
                            'id' => $_POST['id'],
                        )
                    );
                }
                $redirect = '/wp-admin/admin.php?page=condonjohnson-affiliated-organizations';
            }
            include_once __DIR__.'/pages/affiliated-organization-create.php';
        }

        // social media
        public static function socialMediaPage() {
            if (isset($_GET['action']) && $_GET['action'] == 'edit' && !empty($_GET['id'])) {
                $nonce = esc_attr($_GET['_wpnonce']);
                /* if (!wp_verify_nonce($nonce, 'cj_publications')) {
                     die('Go get a life script kiddies');
                 }*/
                $sql = "select * from cj_social_media WHERE cj_social_media.id = ".intval($_GET['id']);
                //self::log($sql);
                global $wpdb;
                $socialMedia = $wpdb->get_results($sql, 'ARRAY_A');
                //self::log($project);
                if (!empty($socialMedia)) {
                    $socialMedia = $socialMedia[0];
                    self::socialMediaCreatePage($socialMedia);
                    exit;
                }
            }
            include_once __DIR__.'/pages/social-medias.php';
        }
        public static function socialMediaCreatePage($socialMedia) {
            global $wpdb;
            if (!empty($_POST)) {
                $filename = '';
                if (!empty($_FILES['photo']['name'])) {
                    $fi = pathinfo($_FILES['photo']['name']);
                    $filename = md5($fi['basename'].time()).'.'.$fi['extension'];
                    $uploadfile = __DIR__.self::$uploaddir.$filename;
                    if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) { }
                }

                if (empty($_POST['id'])) {
                    $sql = "
                    INSERT INTO `cj_social_media` (`url`, `photo`) VALUES ('".$_POST['url']."', '".(!empty($filename)?$filename:'')."');
                  ";
                    $wpdb->query($sql);
                } else {
                    $data = [
                        'url'        => $_POST['url'],
                    ];
                    if (!empty($filename)) {
                        $data['photo'] = $filename;
                    }

                    $wpdb->update(
                        'cj_social_media',
                        $data,
                        array(
                            'id' => $_POST['id'],
                        )
                    );
                }
                $redirect = '/wp-admin/admin.php?page=condonjohnson-social-medias';
            }
            include_once __DIR__.'/pages/social-media-create.php';
        }





        public function __construct() {
           self::init_hooks();
            //self::log('try init MonthlyGift plugin');
        }

        private static function postHttpUrl($url, $params = []) {
            $result = null;


           /* $options = array(
                'http' => array(
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => http_build_query($params)
                )
            );
            $context  = stream_context_create($options);
            $result = file_get_contents($url, false, $context);*/


            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch,CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
            // curl_setopt($ch, CURLOPT_POSTFIELDS,  $params);


            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
            //*/

            return $result;
        }
        public static function ajax() {
            global $wpdb; // this is how you get access to the database
            // self::log($wpdb);

            $params = $_POST;
            //self::log($params);
            $result = [
                'ok' => false,
            ];
            switch ($params['ajaxAction']) {
                case 'getProjects': {
                 // self::log('try getProjects ... ');
                  $pageSize = 6;
                  $page = $params['page'];
                  $type = intval($params['type']);
                  $city = $params['city'];

                  $where = '';
                  if ($type !== -1) {
                    if (!empty($where)) {
                      $where .= ' and ';
                    }
                    $where .= " type = ".$type;
                  }

                  if (!empty($city)) {
                      if (!empty($where)) {
                        $where .= ' and ';
                      }
                      $where .= " city = '".$city."'";
                  }

                  if (!empty($where)) {
                    $where = ' where '.$where;
                  }
                  $sql = "
                     select * from cj_projects
                     ".$where." order by feature desc
                     limit ".($pageSize*($page-1)).", ".$pageSize;
                 // self::log($sql);
                  $projects = $wpdb->get_results($sql,
                  'ARRAY_A');

                  $result['pageSize'] = $pageSize;
                  $result['page'] = $page;
                  foreach ($projects as &$project) {
                    $project['photos'] = $wpdb->get_results("select * from cj_photos_project where cj_photos_project.project_id = ".$project['id'], 'ARRAY_A');
                  }

                  $result['projects'] = $projects;

                  $types = $wpdb->get_results("
                     select * from cj_types_project",
                        'ARRAY_A');
                  $result['types'] = $types;

                  $where = '';
                  if ($type !== -1) {
                     $where .= " type = ".$type;
                  }
                  if (!empty($where)) {
                    $where = ' where '.$where;
                  }

                  $cities = [];
                  /*$cities = $wpdb->get_results("
                     select DISTINCT city from cj_projects ".$where." order by city",
                      'ARRAY_A');
                  $result['cities'] = $cities;*/

                  $result['ok'] = true;
                  break;
                }
                case 'deleteProjectPhoto': {
                  $photo = $wpdb->get_results("select * from cj_photos_project where id = ".$params['photoId'], 'ARRAY_A');
                  if (!empty($photo)) {
                    $photo = $photo[0];
                    unlink(__DIR__.self::$uploaddir.$photo['photo']);
                    $wpdb->query("DELETE FROM `cj_photos_project` WHERE `id`= ".$params['photoId']);
                    $result['ok'] = true;
                  }

                  break;
                }
                case 'contact': {
                  $result['ok'] = false;
                  $check_result = self::postHttpUrl('https://www.google.com/recaptcha/api/siteverify', [
                     'response'  => $params['response'],
                     'secret'    => '6LdG9jUUAAAAADBMG7Wz5QBM8k9KNc5T8PIMeFOj',
                  ]);
                  if (!empty($check_result) && $check_result !== false) {
                    $check_result = json_decode($check_result, true);
                    if ($check_result['success']) {
                        $wpdb->insert(
                            'cj_contacts',
                            array(
                                'name'        => $params['name'],
                                'phone'       => $params['phone'],
                                'email'       => $params['email'],
                                'subject'     => $params['subject'],
                                'message'     => $params['message'],
                            )
                        );

                       wp_mail(
                            'kcondon@condon-johnson.com',
                            $params['subject'],
                            'Name: '.$params['name']."\n".
                            'Phone: '.$params['phone']."\n".
                            'Email: '.$params['email']."\n".
                            $params['message']
                        );

                        $result['ok'] = true;
                    }
                  }
                  //$result['check_result'] = $check_result;
                  //$result['params']       = $params;

                  break;
                }
                default: {
                    $result['msg'] = 'Unknown action';
                    break;
                }
            }
            header('Content-Type: application/json');
            echo json_encode($result);
            wp_die();
        }
    }
}

if (is_admin()) {
  CondonJohnson::instance();
  register_activation_hook( __FILE__, ['CondonJohnson', 'install']);
} else {
  // Frontend backend logic



}





