<?php
class QNP_Pagination
{
    public $paged          = 1;
    public $paged_name     = 'paged';
    public $total_pages    = 1;
    public $total_posts    = 1;
    public $posts_per_page = 10;
    public $range          = 2;
    public $class_li       = 'page-item';
    public $class_a        = 'page-link';
    public $hide_dot       = false;
    public $hide_first     = false;
    public $hide_last      = false;
    public $hide_previous  = false;
    public $hide_next      = false;
    public $label_dot      = '...';
    public $label_first    = '最初へ';
    public $label_last     = '最後へ';
    public $label_previous = '前へ';
    public $label_next     = '次へ';
    public $alway_display  = 0;
    public $_from_plus     = 0;
    public $_from_minus    = 0;
    public $_to_plus       = 0;
    public $_to_minus      = 0;

    /**
     * __construct
     * @param array $config set variable for paged,
     *                      max_num_pages, found_posts,
     *                      posts_per_page
     */
    public function __construct( $config = array() )
    {
        if ( array_key_exists('paged', $config) && $config['paged'] > 1 ) {
            $this->paged = $config['paged'];
        }

        if ( array_key_exists('max_num_pages', $config) && $config['max_num_pages'] > 1 ) {
            $this->total_pages = $config['max_num_pages'];
        }

        if ( array_key_exists('found_posts', $config) && $config['found_posts'] > 1 ) {
            $this->total_posts = $config['found_posts'];
        }

        if ( array_key_exists('posts_per_page', $config) && $config['posts_per_page'] > 1 ) {
            $this->posts_per_page = $config['posts_per_page'];
        }
    }

    /**
     * setQuery
     * @param object $query
     */
    public function setQuery( $query )
    {
        $this->paged = $query->query['paged'];
        $this->total_pages = $query->max_num_pages;
        $this->total_posts = $query->found_posts;
        $this->posts_per_page = $query->posts_per_page;
    }

    /**
     * link
     * @param  integer $paged
     * @param  integer $pages
     * @return string
     */
    public function link( $paged = 1, $pages = null )
    {
        $i = $paged;
        if ( $paged < 1 ) {
            $i = 1;
        }
        if ( $paged > $pages && $pages !== null ) {
            $i = $pages;
        }

        $params = $_GET;
        $params[$this->paged_name] = $i;
        return '?' . http_build_query($params);
    }

    /**
     * pagerItem
     * @param  string $text
     * @param  string $link
     * @param  string $class
     * @return string
     */
    public function pagerItem($text, $link = '#', $class = '')
    {
        echo "<li class='{$this->class_li} {$class}'><a href='{$link}' class='{$this->class_a}'>{$text}</a></li>";
    }

    /**
     * gotoPager
     * @param  string $action
     * @param  string $method
     * @return string html
     */
    public function gotoPager($action = '/', $method = 'GET')
    {
        if ( $this->total_pages <= 1 ) {
            return;
        }
    ?>
        <form action="<?php echo $action ?>" method="<?php echo $method ?>">
            <?php if ( isset($_GET) ) {
            foreach ($_GET as $key => $value) {
                if ( $key === $this->paged_name )
                    continue;
                echo "<input type='hidden' name='{$key}' value='$value'>";
            } }?>
            <input type="text" name="<?php echo $this->paged_name ?>">
            <button type="submit">Submit</button>
        </form>
    <?php
    }

    /**
     * pagerText
     * @param  string $before
     * @param  string $after
     * @return string
     */
    public function pagerText($before = '', $after = '')
    {
        if ( $this->total_pages <= 1 ) {
            return;
        }
        $from = ( $this->paged > 1 ) ? ( $this->paged - 1 ) * $this->posts_per_page + 1 : 1;
        $to = ( $this->paged == $this->total_pages ) ? $this->total_posts : ( $this->paged * $this->posts_per_page );
        $from_to = $from . '～' . $to;
        echo "{$before}{$from_to}/{$this->total_posts}件{$after}";
    }

    /**
     * pagination
     * @return string html
     */
    public function pagination()
    {
        if ( $this->total_pages > 1 ) {
            $_from = $this->paged - $this->range;

            if ( $_from < 1 )
                $_from = 1;

            $_to = $this->paged + $this->range;

            if ( $_to > $this->total_pages )
                $_to = $this->total_pages;

            // ↓ ↓ ↓ custom alway display 5 item
            if ( $this->alway_display !== 0 ) {
                if ( $this->paged < $this->alway_display ) {
                    $_from = 1;
                    $_to = $this->alway_display;
                }

                if ( $this->paged >= $this->total_pages - 1 ) {
                    $_from = $this->total_pages - ( $this->alway_display - 1 );
                    $_to = $this->total_pages;
                }

                if ( $this->total_pages < $this->alway_display ) {
                    $_from = 1;
                    $_to = $this->total_pages;
                }
            }
            // ↑ ↑ ↑ custom alway display 5 item
            if ( $this->_from_plus !== 0 ) {
                $_from  = $_from +$this->_from_plus;
            }
            if ( $this->_from_minus !== 0 ) {
                $_from  = $_from -$this->_from_minus;
            }
            if ( $this->_to_plus !== 0 ) {
                $_to  = $_to +$this->_to_plus;
            }
            if ( $this->_to_minus !== 0 ) {
                $_to  = $_to -$this->_to_minus;
            }
            if ( $this->hide_first === false )
                $this->pagerItem($this->label_first, $this->link(1), 'page-first' );
            if ( $this->hide_previous === false )
                $this->pagerItem($this->label_previous, $this->link($this->paged - 1), 'page-previous' );
            if ( $this->hide_dot === false && $this->paged > $this->range + 2 )
                $this->pagerItem($this->label_dot, 'javascript:;', 'page-dot' );
            for ( $i = $_from; $i <= $_to; $i++ ) {
                $this->pagerItem($i, $this->link($i), 'page-num ' . ( $this->paged == $i ? 'active' : '') );
            }
            if ( $this->hide_dot === false && $_to < $this->total_pages - 1 )
                $this->pagerItem($this->label_dot, 'javascript:;', 'page-dot' );
            if ( $this->hide_next === false )
                $this->pagerItem($this->label_next, $this->link($this->paged + 1, $this->total_pages), 'page-next' );
            if ( $this->hide_last === false )
                $this->pagerItem($this->label_last, $this->link($this->total_pages, $this->total_pages), 'page-last' );
        }
    }
}

if ( !function_exists('the_pagination') ) {
    function the_pagination($config) {
        $pagination = new QNP_Pagination($config);

        // Default config
        // $pagination->paged_name     = 'pageded';
        // $pagination->label_first    = '最初へ';
        // $pagination->label_last     = '最後へ';
        // $pagination->label_previous = '前へ';
        // $pagination->label_next     = '次へ';
        // $pagination->class_li       = 'page-item';
        // $pagination->class_a        = 'page-link';
        // $pagination->range          = 2;
        // $pagination->hide_dot       = false;
        // $pagination->hide_first     = false;
        // $pagination->hide_last      = false;
        // $pagination->hide_previous  = false;
        // $pagination->hide_next      = false;

        ?>
        <nav>
            <ul class="pagination">
                <?php $pagination->pagination(); ?>
            </ul>
            <?php $pagination->pagerText('<span>', '</span>'); ?>
            <?php $pagination->gotoPager(); ?>
        </nav>
        <?php
    }
}
