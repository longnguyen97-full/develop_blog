<?php
class CountPostView
{
    public $page_name   = 'Count Post View';
    public $page_slug   = 'cybridge-count-postview';
    public $parent_slug = 'cybridge-helper';

    /**
     * Start up
     */
    public function __construct()
    {
        global $wp_query, $wpdb;
        $this->wp_query = $wp_query;
        $this->wpdb     = $wpdb;
    	$this->post_id  = get_the_ID() ?? 0;
    	$this->table    = "{$wpdb->prefix}count_post_view";
    }

    public function setData( $get_by_date = '' )
    {
    	$this->get_by_date = $get_by_date;
    }

    public function count()
    {
    	$view  = $this->getPostView( $this->post_id ) ?? 0;
    	$data  = array( 'view' => $view + 1 );
    	$where = array( 'post_ID' => $this->post_id );
    	$this->updateOrInsert( $this->table, $data, $where );
    }

    public function getPostView( $post_id = 0 )
    {
        return $this->wpdb->get_row($this->wpdb->prepare("SELECT view FROM wp_count_post_view WHERE post_ID = %d", $post_id))->view;
    }

    public function updateOrInsert( $table = '', $data = array(), $where = array() )
    {
		$updated = $this->wpdb->update( $table, $data, $where );
		// If nothing found to update, it will try and create the record.
		if ( false === $updated || $updated < 1 ) {
			$data = array_merge( $data, $where );
			$this->wpdb->insert( $table, $data );
		}
    }

    public function getPostsView()
    {
        $results  = $this->wpdb->get_results($this->wpdb->prepare("SELECT post_ID FROM wp_count_post_view ORDER BY view DESC"));
        $post_ids = extractValueFromObjectArray( $results, 'post_ID' );
        $args = array(
            'post_type' => 'post',
            'post__in'  => $post_ids,
            'orderby'   => 'post__in',
        	'posts_per_page' => 10,
		    'date_query' => array(
		        array(
		            'after' => $this->get_by_date,
		        )
		    )
        );
        return get_posts( $args ) ?? array();
    }
}
$CountPostView = new CountPostView();
