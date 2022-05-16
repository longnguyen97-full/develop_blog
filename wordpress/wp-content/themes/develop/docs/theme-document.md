# Nội dung tham khảo
Đối với WP 4.7 về sau sử dụng comment block trước file sẽ dùng được template này cho các loại bài viết
```php
<?php
/*
Template Name: Tên template
Template Post Type: post, page, product
*/
```

# Tận dụng hook để tiết kiệm code
Các hook sau đây là custom được tạo trong phạm vi theme này
- cba_head_before : Hook này đặt phía dưới thẻ &lt;head&gt;
- cba_head_after  : Hook này đặt phía trên thẻ &lt;/head&gt;
- cba_body_before : Hook này đặt phía dưới thẻ &lt;body&gt;
- cba_body_after  : Hook này đặt phía trên thẻ &lt;/body&gt;
```php
// Sử dụng
add_action('cba_head_after', function(){
    // something here
});
```

# Thêm css hoặc js cho từng trang
Có thể chọn 1 trong 2 cách bên dưới, khuyến nghị cách 1 nhe.
Đặt ở phía trên hàm get_header().
```php
<?php
// Add style or script for current page
add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style( 'page-slug-stype', get_theme_file_uri( '/assets/css/style.css' ), null, '1.0' );
    wp_enqueue_script( 'page-slug-script', get_theme_file_uri( '/assets/js/script.js' ), null, '1.0', false );
});

// Add style or script for current page
add_action('cba_head_after', function(){
?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/style.js" media="all">
<script type='text/javascript' src="<?php echo get_template_directory_uri(); ?>/assets/js/script.js"></script>
<?php
});
```

# Hàm Helper
Hàm này tạo ra để rút ngắn tên dùng ở frontend
```php
<?php
// echo home url
url();

// return home url
getUrl();

// echo theme url
themeUrl();

// return theme url
getThemeUrl();

// echo url for assets folder in theme
assets();

// return url for assets folder in theme
getAssets();

// Hàm cắt đoạn chữ nhật dựa theo byte
mb_limit_text($str = '', $byte = 64, $more = '…');

// Hàm sắp xếp mảng dựa trên 1 mảng khác xem ví dụ ở inc\helper.php
cbaOrderByArray();

// Merge và build url dựa vào GET
the_build_url($args = array(), $return = false);

// Tạo phân trang (Xem thêm tại inc\helper.php hoặc inc/pagination.php)
the_pagination($config);
```

# Sử dụng hàm xuất cho url và luôn escape
```html
<?php echo esc_url(home_url( '/' )); ?>
<?php echo esc_url(get_template_directory_uri()); ?>
```

# Đối với Form
Nên phân code ra thành file như mẫu bên dưới
```bash
.
├──📁form-controllers/                # Chứa các file sử lý của form
│  ├──📁libraries/                    # Chứa thư viện chung cho form hoặc để trong /inc/libraries
│  ├──📝page-contact-controller.php   # Xử lý
│  ├──📝page-contact-validator.php    # Kiểm tra đầu vào
│  └──📝page-contact-sendmail.php     # Gửi mail
├──📁template-emails/                 # Chứa các trang với định danh là slug
│  ├──📝page-contact-user.tpl         # Mẫu dành email của user
│  └──📝page-contact-admin.tpl        # Mẫu dành email của admin
├──📁template-pages/                  # Chứa các trang với định danh là slug
│  ├──📝page-contact.php              # Trang form
│  ├──📝page-contact-confirmation.php # Trang xác nhận
│  ├──📝page-contact-error.php        # Trang in lỗi
│  └──📝page-contact-complete.php     # Trang hoàn thành
```

# Navigation
- [Trang chủ](https://phuquang.github.io/themestandard/)
- [Sơ đồ tài liệu](https://phuquang.github.io/themestandard/sitemap)