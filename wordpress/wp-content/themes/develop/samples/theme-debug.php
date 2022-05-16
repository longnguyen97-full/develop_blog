<?php
$allow_debug_ips = array(
    '10.11.9.26',
);
if ( WP_DEBUG === true && in_array($_SERVER['REMOTE_ADDR'], $allow_debug_ips) ) {
    add_action('wp_footer', function () { ?>
<div id="themedebug" class="hidden">
<div class="themedebug_header">Theme debug <span id="themedebug_close">-</span></div>
<div class="themedebug_content">
    <ul class="themedebug_tab">
        <li data-tab="themedebug_tab_theme" class="active">THEME</li>
        <li data-tab="themedebug_tab_server">SERVER</li>
    </ul>
    <div class="themedebug_tab_content active" id="themedebug_tab_theme">
        <ul>
            <li>This is: <?php
            if ( is_front_page() && is_home() ) { echo 'Default homepage'; }
            elseif ( is_front_page() ) { echo 'static homepage'; }
            elseif ( is_home() ) { echo 'blog page'; }
            elseif ( is_page() ) { echo 'Page'; }
            elseif ( is_singular() ) { echo 'Single'; }
            elseif ( is_attachment() ) { echo 'Attachment'; }
            elseif ( is_tax() ) { echo 'Taxonomy'; }
            elseif ( is_category() ) { echo 'Category'; }
            elseif ( is_tag() ) { echo 'Tag'; }
            elseif ( is_post_type_archive() ) { echo 'Post Type Archive » '.get_post_type(); }
            elseif ( is_author() ) { echo 'Author'; }
            elseif ( is_search() ) { echo 'Search'; }
            elseif ( is_404() ) { echo '404'; }
             ?></li>
            <li>Current file <code><?php
            $dir = get_template_directory();
            $ext = '.php';
            $id = get_the_ID();
            $slug = get_post_field( 'post_name');
            $post_type = get_post_type();

            if ( is_page() ) {
                $page_template = get_post_meta( get_the_ID(), '_wp_page_template', true );
                if ( !empty($page_template) && $page_template !== 'default' ) {
                    echo get_page_template();
                } elseif ( file_exists("{$dir}/page-{$slug}{$ext}") ) {
                    echo "{$dir}/page-{$slug}{$ext}";
                } elseif ( file_exists("{$dir}/page-{$id}{$ext}") ) {
                    echo "{$dir}/page-{$id}{$ext}";
                } elseif ( file_exists("{$dir}/template-pages/page-{$slug}{$ext}") ) {
                    echo "{$dir}/template-pages/page-{$slug}{$ext}";
                } elseif ( file_exists("{$dir}/page{$ext}") ){
                    echo "{$dir}/page{$ext}";
                }
            } elseif (is_attachment()) {
                if ( file_exists("{$dir}/attachment{$ext}") ){
                    echo "{$dir}/attachment{$ext}";
                }
            } elseif ( is_singular() ) {
                if ( file_exists("{$dir}/single-{$slug}{$ext}") ) {
                    echo "{$dir}/single-{$slug}{$ext}";
                } elseif ( file_exists("{$dir}/single-{$id}{$ext}") ) {
                    echo "{$dir}/single-{$id}{$ext}";
                } elseif ( file_exists("{$dir}/single-{$post_type}-{$slug}{$ext}") ) {
                    echo "{$dir}/single-{$post_type}-{$slug}{$ext}";
                } elseif ( file_exists("{$dir}/single-{$post_type}{$ext}") ) {
                    echo "{$dir}/single-{$post_type}{$ext}";
                } elseif ( file_exists("{$dir}/single{$ext}") ){
                    echo "{$dir}/single{$ext}";
                }
            } elseif ( file_exists("{$dir}/singular{$ext}") ) {
                echo "{$dir}/singular{$ext}";
            }

            if ( is_author() ) {
                $author_id = get_the_author_meta('ID');
                $author_nickname = get_the_author_meta('nickname');
                if ( file_exists("{$dir}/author-{$author_nickname}{$ext}") ) {
                    echo "{$dir}/author-{$author_nickname}{$ext}";
                } elseif ( file_exists("{$dir}/author-{$author_id}{$ext}") ) {
                    echo "{$dir}/author-{$author_id}{$ext}";
                } elseif ( file_exists("{$dir}/author{$ext}") ){
                    echo "{$dir}/author{$ext}";
                } elseif ( file_exists("{$dir}/archive{$ext}") ){
                    echo "{$dir}/archive{$ext}";
                }
            } elseif ( is_category() ) {
                $category_id = get_queried_object()->term_id;
                $category_slug = get_queried_object()->slug;
                if ( file_exists("{$dir}/category-{$category_slug}{$ext}") ){
                    echo "{$dir}/category-{$category_slug}{$ext}";
                } elseif ( file_exists("{$dir}/category-{$category_id}{$ext}") ){
                    echo "{$dir}/category-{$category_id}{$ext}";
                } elseif ( file_exists("{$dir}/category{$ext}") ){
                    echo "{$dir}/category{$ext}";
                } elseif ( file_exists("{$dir}/archive{$ext}") ){
                    echo "{$dir}/archive{$ext}";
                }
            } if ( is_post_type_archive() ) {
                if ( file_exists("{$dir}/archive-{$post_type}{$ext}") ) {
                    echo "{$dir}/archive-{$post_type}{$ext}";
                } elseif ( file_exists("{$dir}/archive{$ext}") ){
                    echo "{$dir}/archive{$ext}";
                }
            } elseif ( is_tax() ) {
                $tax = get_query_var('taxonomy');
                $tax_slug = get_queried_object()->slug;
                if ( file_exists("{$dir}/taxonomy-{$tax}-{$tax_slug}{$ext}") ){
                    echo "{$dir}/taxonomy-{$tax}-{$tax_slug}{$ext}";
                } elseif ( file_exists("{$dir}/taxonomy-{$tax}{$ext}") ){
                    echo "{$dir}/taxonomy-{$tax}{$ext}";
                } elseif ( file_exists("{$dir}/taxonomy{$ext}") ){
                    echo "{$dir}/taxonomy{$ext}";
                } elseif ( file_exists("{$dir}/archive{$ext}") ){
                    echo "{$dir}/archive{$ext}";
                }
            } elseif ( is_date() ) {
                if ( file_exists("{$dir}/date{$ext}") ){
                    echo "{$dir}/date{$ext}";
                } elseif ( file_exists("{$dir}/archive{$ext}") ){
                    echo "{$dir}/archive{$ext}";
                }
            } elseif ( is_tag() ) {
                $tag_id = get_queried_object()->term_id;
                $tag_slug = get_queried_object()->slug;
                if ( file_exists("{$dir}/tag-{$tag_slug}{$ext}") ){
                    echo "{$dir}/tag-{$tag_slug}{$ext}";
                } elseif ( file_exists("{$dir}/tag-{$tag_id}{$ext}") ){
                    echo "{$dir}/tag-{$tag_id}{$ext}";
                } elseif ( file_exists("{$dir}/tag{$ext}") ){
                    echo "{$dir}/tag{$ext}";
                } elseif ( file_exists("{$dir}/archive{$ext}") ){
                    echo "{$dir}/archive{$ext}";
                }
            }

            if ( is_search() ) {
                if ( file_exists("{$dir}/search{$ext}") ) {
                    echo "{$dir}/search{$ext}";
                }
            }

            if ( is_404() ) {
                if ( file_exists("{$dir}/404{$ext}") ) {
                    echo "{$dir}/404{$ext}";
                }
            }
            ?></code></li>
        </ul>
    </div>
    <div class="themedebug_tab_content" id="themedebug_tab_server">
        <ul>
            <li>REQUEST_URI <?php echo $_SERVER['REQUEST_URI'] ?></li>
            <li>REDIRECT_STATUS <?php echo isset($_SERVER['REDIRECT_STATUS']) ? $_SERVER['REDIRECT_STATUS'] : '' ?></li>
            <li>HTTP_HOST <?php echo $_SERVER['HTTP_HOST'] ?></li>
            <li>SERVER_NAME <?php echo $_SERVER['SERVER_NAME'] ?></li>
            <li>SERVER_ADDR <?php echo $_SERVER['SERVER_ADDR'] ?></li>
            <li>SERVER_PORT <?php echo $_SERVER['SERVER_PORT'] ?></li>
            <li>DOCUMENT_ROOT <?php echo $_SERVER['DOCUMENT_ROOT'] ?></li>
            <li>REMOTE_ADDR <?php echo $_SERVER['REMOTE_ADDR'] ?></li>
            <li>REDIRECT_URL <?php echo isset($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : '' ?></li>
            <li>SERVER_PROTOCOL <?php echo $_SERVER['SERVER_PROTOCOL'] ?></li>
            <li>REQUEST_METHOD <?php echo $_SERVER['REQUEST_METHOD'] ?></li>
        </ul>
    </div>
</div>
</div>
<style>#themedebug{color: #FF6F61;border: 1px solid #FF6F61;position: fixed;bottom: 0;left: 0;right: 0;font-size: 16px;padding-bottom: 20px;background: #fff;z-index: 999;box-shadow: 3px 3px 10px 0px #000;}
#themedebug_close{position: absolute;top: 0;right: 0;cursor: pointer;padding: 0 9px;background: #222;}
#themedebug .themedebug_header{background: #FF6F61;color: #FFF;padding: 0 5px;}
#themedebug .themedebug_content{background:#FFF;}
#themedebug.hidden {left: auto;}
#themedebug.hidden .themedebug_content{display: none;}
#themedebug.hidden .themedebug_header{padding-right: 35px;}
#themedebug ul{margin: 0;}
.themedebug_tab_content{display: none;}
.themedebug_tab_content.active{display: block;}
.themedebug_tab{padding: 0;font-size: 0;border-bottom: 1px solid #FF6F61;}
.themedebug_tab li{display: inline-block;font-size: 16px;padding: 0 5px;border-right: 1px solid #FF6F61;cursor: pointer;}
.themedebug_tab li.active{color: #fff;background: #FF6F61;}
.themedebug_tab li:hover{color: #fff;background: #FF6F61;}
</style>
<script>
'use strict';
function themeDebugTabs() {
    var bindAll = function() {
        var menuElements = document.querySelectorAll('[data-tab]');
        for(var i = 0; i < menuElements.length ; i++) {
            menuElements[i].addEventListener('click', change, false);
        }
    }

    var clear = function() {
        var menuElements = document.querySelectorAll('[data-tab]');
        for(var i = 0; i < menuElements.length ; i++) {
            menuElements[i].classList.remove('active');
            var id = menuElements[i].getAttribute('data-tab');
            document.getElementById(id).classList.remove('active');
        }
    }

    function makeAllActive() {
        var tabs = document.querySelectorAll('.themedebug_tab_content');
        Array.from(tabs).map(item => {
            item.classList.add('active');
        });
    }

    var change = function(e) {
        clear();
        e.target.classList.add('active');
        var id = e.currentTarget.getAttribute('data-tab');
        if(id === "green") {
            makeAllActive();
            return;
        }
        document.getElementById(id).classList.add('active');
    }
    bindAll();
}

var connectThemeDebugTabs = new themeDebugTabs();

document.getElementById('themedebug_close').addEventListener('click', function (e) {
    document.getElementById('themedebug').classList.toggle('hidden');
}, false);
</script>
<?php }, 999);

} // END WP_DEBUG

if ( !function_exists('theme_debug') ) {
    function theme_debug($var)
    {
        $bt = debug_backtrace();
        $caller = array_shift($bt);
        echo '<div class="recursiveThemeDebug">';
        echo "<div class='header'>Debug line {$caller['line']} in {$caller['file']}</div>";
        recursiveThemeDebug($var);
        echo '</div>';
        ?><style>.recursiveThemeDebug{background: #272822;font-size: 13px;color:#fff;padding: 5px;}
.recursiveThemeDebug tr:nth-of-type(odd) {background-color: rgba(0,0,0,.05);}
.recursiveThemeDebug td:first-child {width: 5%;}
.recursiveThemeDebug td {border: 1px solid #75715e;vertical-align: top;}
.recursiveThemeDebug td td {border-left: 0;border-bottom: 0;}
.recursiveThemeDebug td td:last-child{border-right: 0;}
.recursiveThemeDebug td tr:first-child td {border-top: 0;}
.recursiveThemeDebug table {width: 100%;border-spacing: 0px;border-collapse: collapse;}
.recursiveThemeDebug td.hidden + td{background:#75715e;}
.recursiveThemeDebug td.hidden + td > *{display: none;}
.recursiveThemeDebug span {padding-left: 5px;padding-right: 5px;}
.recursiveThemeDebug .int {color: #ae81ff;}
.recursiveThemeDebug .string {color: #e6db74;}
.recursiveThemeDebug .null {color: #75715e;font-style: italic;}
.recursiveThemeDebug .bool {color: #ae81ff;}
.recursiveThemeDebug .obj {color: #66d9ef;}
.recursiveThemeDebug .key {color: #a6e22b;}
</style><script>
var recursiveThemeDebug = document.querySelectorAll('.recursiveThemeDebug td');
Array.from(recursiveThemeDebug).map(item => {
    item.addEventListener('click', function (e) {this.classList.toggle('hidden');}, false);
});
</script><?php
    }
    function recursiveThemeDebug($variable)
    {
        if ( is_string($variable) && !empty($variable) ) {
            echo "<span class='string' title='String'>{$variable}</span>";
        } elseif ( is_numeric($variable) ) {
            echo "<span class='int' title='Number'>{$variable}</span>";
        } elseif ( is_bool($variable) ) {
            echo '<span class="bool" title="Boolean">' . ($variable ? 'true' : 'false').'</span>';
        } elseif ( is_object($variable) || (is_array($variable) && count($variable) ) ) {
            $class = '';
            if ( is_array($variable) ) {
                $class= 'key';
                $title= 'Array';
            }
            if ( is_object($variable) ) {
                $class= 'obj';
                $title= 'Object';
            }
            echo '<table>';
            foreach ($variable as $key => $value) {
                echo "<tr>";
                    echo "<td><span class='{$class}' title='{$title}'>{$key}</span></td>";
                    echo '<td>';
                    recursiveThemeDebug($value);
                    echo '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo "<span class='null' title='Null'>null</span>";
        }
    }
}
