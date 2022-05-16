<?php
// Register and load the widget
add_action( 'widgets_init', function() {
    register_widget( 'cba_sample_widget' );
} );

class cba_sample_widget extends WP_Widget
{
    /**
     * Widgetを登録する
     */
    function __construct() {
        parent::__construct(
            'cba_sample_widget', // Base ID
            'Widgetの名前', // Name
            array( 'description' => 'Widgetの説明', ) // Args
        );
    }

    /**
     * 表側の Widget を出力する
     * Creating widget front-end
     *
     * @param array $args      'register_sidebar'で設定した「before_title, after_title, before_widget, after_widget」が入る
     * @param array $instance  Widgetの設定項目
     */
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        $email = $instance['email'];

        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        echo "<p>Email: ${email}</p>";

        echo $args['after_widget'];
    }

    /**
     * Widget管理画面を出力する
     * Widget Backend
     *
     * @param array $instance 設定項目
     * @return string|void
     */
    public function form( $instance ) {
        $title      = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
        $title_id   = $this->get_field_id('title');
        $title_name = $this->get_field_name('title');
        $email      = isset($instance['email']) ? $instance[ 'title' ] : '';
        $email_id   = $this->get_field_id('email');
        $email_name = $this->get_field_name('email');

        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $title_id; ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $title_id; ?>" name="<?php echo $title_name; ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $email_id; ?>"><?php _e( 'Email:' ); ?></label>
            <input class="widefat" id="<?php echo $email_id; ?>" name="<?php echo $email_name; ?>" type="text" value="<?php echo esc_attr( $email ); ?>">
        </p>
        <?php
    }

    /** 新しい設定データが適切なデータかどうかをチェックする。
     * 必ず$instanceを返す。さもなければ設定データは保存（更新）されない。
     *
     * @param array $new_instance  form()から入力された新しい設定データ
     * @param array $old_instance  前回の設定データ
     * @return array               保存（更新）する設定データ。falseを返すと更新しない。
     */
    function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

        if ( filter_var($new_instance['email'],FILTER_VALIDATE_EMAIL) ) {
            $instance['email'] = $new_instance['email'];
        }

        return $instance;
    }
}
