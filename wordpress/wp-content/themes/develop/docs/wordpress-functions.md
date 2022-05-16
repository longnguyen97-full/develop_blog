# Các hàm thường dùng
Dưới đây là danh sách kèm mô tả ngắn ý nghĩa của hàm để biết thêm chi tiết hãy xem mục tham khảo thêm.
Các hàm có tiếp đầu ngữ the_ thì sẽ print dữ liệu và get_ thì sẽ return dữ liệu.

```php
<?php
/**
 * Posts
 */

// lấy id của post hiện tại
the_ID();
$id = get_the_ID();

// lấy tiêu đề (Title) của post hiện tại
the_title();
$title = get_the_title();

// lấy nội dung của post hiện tại
the_content();
$content = get_the_content();

// Lấy 1 đoạn đầu nội dung
the_excerpt();
$excerpt = get_the_excerpt();

// Kiểm tra trích đoạn có hay không
$has_excerpt = has_excerpt();

// Lấy ngày publish
$time = the_time('d M Y');

// Lấy đường link của bài
the_permalink();
$link = get_the_permalink();

// Kiểm tra có ảnh đại diện không
$has_thumbnail = has_post_thumbnail();

// Lấy ảnh đại diện của bài
$thumbnail = get_the_post_thumbnail();

// Lấy slug của bài
$slug = get_post_field('post_name', get_the_id());

// Lấy tình trạng của bài
$status = get_post_status();

// Lấy author id của bài
$author_id = get_post_field('post_author', get_the_id());
the_author();
get_the_author();

// Lấy link edit của bài
edit_post_link("クイック編集",'<span class="edit-link" title="Edit" style="position: fixed;top: 0;left: 0;z-index: 9999;">','</span>');

// Check Điều kiện file single-attachment.php
is_singular( 'attachment' );

// Lấy field của bài
get_post_meta(get_the_ID(), 'showroom_information', true);

/**
 * Custom Post Type
 */

// Đăng ký post type
register_post_type();

// Check là post type archive page
is_post_type_archive();

// Lấy post type slug của bài
get_post_type();

// Lấy post type url
get_post_type_archive_link();

/**
 * Pages
 */

// Lấy tất cả ID của page
get_all_page_ids();

// Lấy url của page
get_page_link();
get_page_uri();

// Điều kiện nếu là page
is_page();

/**
 * Custom Fields (postmeta)
 */

// Đăng ký field
register_meta();

// Lấy tất cả field
get_post_custom();

// Lấy field key
get_post_custom_keys();

// Lấy field value
get_post_custom_values();

// Lấy field
get_post_meta();

// Cập nhật field
update_post_meta();

// Xóa field
delete_post_meta();

/**
 * Attachments
 */

// Lấy đường dẫn đến tệp được đính kèm
get_attached_file();

// Kiểm tra là page attachment
is_attachment();

// Đặt hình ảnh đại diện cho bài viết
set_post_thumbnail();

// Xác định post id có phải là hình ko
wp_attachment_is_image();

// Lấy hình (bao gồm thẻ img)
wp_get_attachment_image();

// Xuất ra đường dẫn hình (bao gồm thẻ a và img)
wp_get_attachment_link();

// Xuất ra url của hình
wp_get_attachment_image_src();

// Xuất ra thông tin của attachment
$img = wp_get_attachment_metadata($id_attachment);

// Xuất ra url của hình attachment
wp_get_attachment_url();

// Lấy hình thumnail (bao gồm thẻ img)
wp_get_attachment_thumb_file();

// Lấy hình thumnail
wp_get_attachment_thumb_url();

// Lấy url của hình
$url = wp_get_attachment_image_url($id_attachment, 'full');

/**
 * Terms
 */

// Truy xuất danh sách mục (Taxonomies) cho một bài
$terms = wp_get_post_terms(get_the_ID(),'taxonomy_slug');

// Truy xuất danh sách mục cho một bài
$categories = wp_get_post_categories();

// Truy xuất danh sách thẻ cho một bài
$tags = wp_get_post_tags();

// Lấy taxonomy
$terms = get_the_terms(get_the_id(),'taxonomy_slug');
$terms = get_terms( array(
    'taxonomy'   => 'taxonomy_slug',
    'hide_empty' => false,
));

// Lấy danh sách mục của taxonomy cho 1 bài
the_terms();
get_the_terms();

// Lấy url edit ở admin
get_edit_term_link();

// Lấy thông tin của mục
get_term();
get_term_by();

// Lấy danh sách thông tin của mục
get_the_term_list();

// Điều kiện là page taxonomy
is_tax();

// Đăng ký taxonomy
register_taxonomy();

/**
 * Categories
 */

// Lấy Category ID
get_cat_ID();

// Lấy Category name
get_cat_name();

// Lấy danh sách Category
get_categories();
get_the_category_list();
wp_dropdown_categories();
wp_list_categories();

// Lấy Category
get_category();
get_the_category();
get_category_by_slug();
get_the_category_by_ID();

// Lấy url ở frontend
get_category_link();

// Điều kiện là trang category
is_category();

/**
 * Tags
 */

// Lấy Tag
get_tag();
get_tag_link();

// Lấy danh sách tag
get_tags();
get_the_tag_list();
get_the_tags();

// Điều kiện có tag hay không
has_tag();

// Điều kiện là trang tag
is_tag();

/**
 * Action, Filter, and Plugin Functions
 */

// Kiểm tra xem có bộ lọc nào đã được đăng ký hook
has_filter();

// Móc một hàm vào một hook filter
add_filter();

// Gọi các chức năng được thêm vào hook lọc. 
apply_filters();

// Loại chức năng được thêm vào hook lọc. 
remove_filter();

// Kiểm tra xem có action nào đã được đăng ký hook
has_action();

// Móc một hàm vào hook action
add_action();

// Gọi hook action 
do_action();

// Loại chức năng được thêm vào hook (tương tự remove_filter)
remove_action();

// Thêm hàm vào hook shortcode
add_shortcode();

// Gọi hook shortcode
do_shortcode();

// Loại bỏ móc cho shortcode
remove_shortcode();

/**
 * Theme-Related Functions
 */

// Chèn code của file content-single.php trong folder template-parts
get_template_part( 'template-parts/content', 'single' );

// Chèn sidebar.php hoặc sidebar-contact.php
get_sidebar();
get_sidebar('contact');

// Kiểm tra sidebar đã có widget chưa
is_active_sidebar();

// Xuất sidebar
dynamic_sidebar();

// Kiểm tra sidebar đã đăng ký
is_dynamic_sidebar();

// Chèn header.php
get_header();

// Chèn footer.php
get_footer();

// Chèn comments.php
comments_template();

// Chèn searchform.php
get_search_form();

/**
 * Miscellaneous Functions
 */

// In class
body_class();
get_body_class();
get_post_class();
post_class();

// Trả về đường dẫn thực của theme
get_stylesheet_directory();
get_template_directory();

// Trả về đường dẫn url của theme
get_stylesheet_directory_uri();
get_template_directory_uri();

// Trả về http://site.com/wp-content/themes
get_theme_root_uri();

// Xuất language attributes
language_attributes();

// Chèn 1 template
load_template();

// Lấy option có tên là admin_email
$admin_email = get_option('admin_email');

// Cập nhật option
update_option();

// Lấy thông tin user
$users = get_users(array('fields' => 'all_with_meta','exclude' => array(1)));
$user_info = get_userdata(get_post_field('post_author', get_the_id()));

// Lấy link từ home
echo esc_url( site_url('/') );
echo esc_url( home_url( '/' ) );

// Lấy link từ theme
echo esc_url(get_template_directory_uri());

// Lấy next và prev link
the_post_navigation( array(
    'next_text' => __( 'Next post:', 'twentysixteen' ),
    'prev_text' => __( 'Previous post:', 'twentysixteen' ),
) );

// Truy vấn post dựa vào đối số.
// tìm hiểu thêm các đối số ở https://phuquang.github.io/themestandard/functions/wp-query
$query = new WP_Query( $args );
if ( $query->have_posts() ): /* Xác định nếu có post tồn tại*/
    while ( $query->have_posts() ): /* Vòng lặp */
            $query->the_post(); /* Thiết lập post hiện tại sau mõi vòng lặp */
    endwhile;
    // <!-- pagination here -->
    wp_reset_postdata(); /* Restore original Post Data */
    wp_reset_query(); /* Restore original query */
else:
    // no posts found
endif;

// Truy vấn post dựa vào query mặc định
if (have_posts()):
    while ( have_posts() ) : the_post();
        // found posts
    endwhile;
else:
    // no posts found
endif;
```

# Navigation
- [Trang chủ](https://phuquang.github.io/themestandard/)
- [Sơ đồ tài liệu](https://phuquang.github.io/themestandard/sitemap)
