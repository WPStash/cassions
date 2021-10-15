<?php
/**
 * Block 1 - Slider Widget
 */
// Register the widget
register_widget( 'Cassions_Widget_Block4' );
// The widget class
class Cassions_Widget_Block4 extends WP_Widget {
	public function __construct() {
		$widget_ops = array('classname' => 'block4_widget', 'description' => esc_html__( "Display posts use on homepage.", 'cassions') );
		parent::__construct('cs_block4', esc_html__('WPS Block 4', 'cassions'), $widget_ops);
		$this->alt_option_name = 'widget_block4';
		add_action( 'save_post', array($this, 'remove_cache') );
		add_action( 'deleted_post', array($this, 'remove_cache') );
		add_action( 'switch_theme', array($this, 'remove_cache') );
	}
	/**
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		//extract( $args );
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'widget_block4', 'widget' );
		}
		if ( ! is_array( $cache ) ) {
			$cache = array();
		}
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}
		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}
		ob_start();
        // Get values from the widget settings.
		$title               = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$title               = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$block_category      = ( ! empty( $instance['block_category'] ) ) ? $instance['block_category'] : '';
		$ignore_sticky 		 = isset($instance['ignore_sticky']) ? $instance['ignore_sticky'] : 1;
		$orderby			 = ( ! empty( $instance['orderby'] ) ) ? $instance['orderby'] : 'date';
		$order			     = ( ! empty( $instance['order'] ) ) ? $instance['order'] : 'DESC';
		$number_posts        = ( ! empty( $instance['number_posts'] ) ) ? absint( $instance['number_posts'] ) : 3;
		if ( ! $number_posts ) $number_posts = 3;

        $custom_query_args = array(
			'post_type'           => 'post',
			'posts_per_page'      => $number_posts,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => $ignore_sticky,
			'category__in'        => $block_category,
			'order'               => $order,
			'orderby'             => $orderby,
		);
		$custom_query = new WP_Query( apply_filters( 'widget_block3_posts_args', $custom_query_args ) );
        if ($custom_query->have_posts()) :?>
		<?php $count = 0; ?>
		<?php echo $args['before_widget']; ?>

		<?php
		if ( $title && $block_category == '' ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} else {
			if ( $block_category ) {
				echo $args['before_title'];
	            ?>
	            <a href="<?php echo esc_url( get_category_link( $block_category ) ); ?>"><?php echo ! empty ( $title ) ? $title : esc_attr(get_cat_name( $block_category ) ); ?></a>
	            <?php
	            echo $args['after_title'];
			}
		}
		?>

		<div class="block4_widget_content">
			<?php while ( $custom_query->have_posts() ) : $custom_query->the_post();  ?>

				<?php $class = ( $count % 2 == 0 ) ? 'even' : ''; ?>
                <!-- begin .hentry -->
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'block-posts-4 ' . $class ); ?> >

                    <!-- begin .featured-image -->
                    <?php if ( has_post_thumbnail() ) { ?>
                    <div class="featured-image">
                        <?php if ( has_post_thumbnail() ) : ?><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'cassions-widget-medium' ); ?></a><?php endif; ?>
                    </div>
                    <?php } ?>
                    <!-- end .featured-image -->

                    <!-- begin .entry-header -->
                    <header class="entry-header">
                        <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
                    </header>
                    <!-- end .entry-header -->

                </article>
                <!-- end .hentry -->

            <?php
			$count++;
			endwhile; ?>
		</div> <!-- .block2_widget_content -->

		<?php echo $args['after_widget']; ?>
		<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();
		endif;
		?>

		<?php
		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'widget_block4', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}
	/**
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$this->remove_cache();
		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_recent_entries']) ) delete_option('widget_recent_entries');
		$new_instance = wp_parse_args( $new_instance, array(
            'title'               => '',
			'block_category'      => '',
			'ignore_sticky'		  => 1,
			'number_posts'        => 3,
			'order'               => 'DESC',
			'orderby'             => 'date'
		) );
        $instance['title']               = sanitize_text_field( $new_instance['title'] );
		$instance['ignore_sticky']       = isset($new_instance['ignore_sticky']) && $new_instance['ignore_sticky'] ? 1 : 0;
		$instance['block_category']      = isset( $new_instance['block_category'] ) ?  absint( $new_instance['block_category'] ) : '' ;
		$instance['number_posts']        = absint( $new_instance['number_posts'] );
        $instance['order'] 		         = sanitize_text_field( $new_instance['order'] );
		$instance['orderby'] 		     = sanitize_text_field( $new_instance['orderby'] );

		return $instance;
	}
	/**
	 * @access public
	 */
	public function remove_cache() {
		wp_cache_delete('widget_block4', 'widget');
	}
	/**
	 * @param array $instance
	 */
	public function form( $instance ) {
        // Set default value.
		$defaults = array(
			'title'               => '',
			'block_category'      => '',
			'ignore_sticky'		  => 1,
			'number_posts'        => 3,
			'order'               => 'DESC',
			'orderby'             => 'date'
		);
		$instance        = wp_parse_args( (array) $instance, $defaults );
		$block_category  = $instance['block_category'];
        $list_categories = get_categories();
		$order           = array( 'ASC', 'DESC' );
		$orderby         = array('date', 'comment_count', 'rand');
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('Widget Title:', 'cassions') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'block_category' ); ?>"><?php esc_html_e('Block Category:', 'cassions') ?></label>
			<select class="widefat" name="<?php echo $this->get_field_name( 'block_category' );?>" id="<?php echo $this->get_field_id( 'block_category' );?>">
				<option value="0" <?php if ( ! $instance['block_category']) echo 'selected="selected"'; ?>><?php esc_html_e('All', 'cassions'); ?></option>
				<?php foreach ( $list_categories as $category ) { ?>
					<option value="<?php echo $category->term_id; ?>" <?php echo ( $category->term_id == $block_category ) ? 'selected="selected" ' : '';?>><?php echo $category->name . " (". $category->count . ")"; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number_posts' ); ?>"><?php esc_html_e('Number of posts to show:', 'cassions') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'number_posts' ); ?>" name="<?php echo $this->get_field_name( 'number_posts' ); ?>" value="<?php echo $instance['number_posts']; ?>" />
		</p>


		<p>
		   <input id="<?php echo $this->get_field_id('ignore_sticky'); ?>" name="<?php echo $this->get_field_name('ignore_sticky'); ?>" type="checkbox" value="1" <?php checked('1', $instance['ignore_sticky']); ?>/>
		   <label for="<?php echo $this->get_field_id('ignore_sticky'); ?>"><?php esc_html_e('Ignore Sticky Posts', 'cassions') ?></label>
	    </p>
		<p>
			<label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php esc_html_e('Order:', 'cassions') ?></label>
			<select class="widefat" name="<?php echo $this->get_field_name( 'order' );?>" id="<?php echo $this->get_field_id( 'order' );?>">
				<?php for ( $i = 0; $i <= 1; $i++ ){ ?>
					<option value="<?php echo $order[$i]; ?>" <?php echo ($order[$i] == $instance['order']) ? 'selected="selected" ' : '';?>><?php echo $order[$i]; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php esc_html_e('Order By:', 'cassions') ?></label>
			<select class="widefat" name="<?php echo $this->get_field_name( 'orderby' );?>" id="<?php echo $this->get_field_id( 'orderby' );?>">
				<?php for ( $i = 0; $i <= 2; $i++ ){ ?>
					<option value="<?php echo $orderby[$i]; ?>" <?php echo ($orderby[$i] == $instance['orderby']) ? 'selected="selected" ' : '';?>><?php echo $orderby[$i]; ?></option>
				<?php } ?>
			</select>
		</p>
<?php
	}
}
