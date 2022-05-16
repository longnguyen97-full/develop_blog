# THE WORDPRESS TEMPLATE HIERARCHY
Đây là hệ thống cấp bật của template được wordpress quy định nhớ tuân thủ hen.

```bash
index.php
├──archive.php
│  ├──author.php                           Author Archive
│  │  └──author-$id.php                    Author Archive With ID
│  │     └──author-$nicename.php           Author Archive With Nicename
│  ├──category.php                         Category Archive
│  │  └──category-$id.php                  Category Archive With ID
│  │     └──category-$slug.php             Category Archive With Slug
│  ├──archive-$posttype.php                Custom Post Type Archive
│  ├──taxonomy.php                         Custom Taxonomy Archive
│  │  └──taxonomy-$taxonomy.php            Custom Taxonomy Archive
│  │     └──taxonomy-$taxonomy-$term.php   Custom Taxonomy Archive
│  ├──date.php                             Date Archive
│  └──tag.php                              Tag Archive
│     └──tag-$id.php                       Tag Archive With ID
│        └──tag-$slug.php                  Tag Archive With Slug
├──singular.php                            Singular Page
│  ├──single.php                           Single Post Page
│  │  ├──attachment.php                    Attachment Post
│  │  │  └──$mimetype.php                  Attachment Post
│  │  │     └──$subtype.php                Attachment Post
│  │  │        └──$mimetype-$subtype.php   Attachment Post
│  │  ├──single-$posttype.php              Custom Post
│  │  │  └──single-$posttype-$slug.php     Custom Post
│  │  └──single-post.php                   Blog Post
│  └──page.php                             Static Page
│     └──page-$id.php                      Static Page With ID
│        └──page-$slug.php                 Static Page With Slug
├──home.php                                Blog Posts Index Page
│  └──front-page.php                       Site Front Page
├──404.php                                 Error 404 Page
└──search.php                              Search Result Page
```

# Giải thích
Chúng ta có các dạng:
Archive: Đây là layout dùng để show ra danh sách các bài viết (Post).
- author: đây là trang dành cho các user đã được đăng ký trong wordpress. show user chỉ định hoặc danh sách user tùy mục đích sử dụng.
- Category: đây là trang danh mục, show danh sách bài viết thuộc danh mục nào đó.
- Tag: đây là trang thẻ, show danh sách bài viết có thẻ nào đó.
- Date: đây là trang ngày/tháng/năm, show danh sách bài viết có ngày/tháng/năm nào đó.
- Tag: đây là trang thẻ, show danh sách bài viết thuộc thẻ nào đó.
- Taxonomy: đây là trang phân loại tương tự danh mục hoặc thẻ.
- $id là ID của author/category/page tùy thuộc vào vị trí của nó mà nó là id được chỉ định.
- $slug là tên của bài viết được xử lý để thân thiện với url và người dùng. sẽ được dùng làm url truy cập tới bài viết thay cho id, việc search và SEO cũng sẽ thân thiện hơn với các công cụ tìm kiếm như google. thường sẽ bị loại bỏ ký tự đặt biệt và là định danh duy nhất trong database của post.
- $nicename là nickname hoặc user login của user.
- $posttype là tên loại post khác mà mình đã tạo ra.
- $taxonomy là tên phân loại khác mà mình đã tạo ra. Tương tự có thể tạo taxonomy giống category hoặc tag.
- $term là tên của 1 phân loại cụ thể.
- $mimetype / $subtype là nhãn được sử dụng để xác định loại tệp. (Ví dụ: image.php, video.php, pdf.php).

Wordpress sẽ tìm các file con nếu không tồn tại nó sẽ tìm tới file cấp cao hơn để hiển thị.
Về tính quan trọng các file nằm gần gốc sẽ buộc phải có.
Ví dụ: Trang sample có id là 1, slug là sample và url là https://themestandard.com/sample thì khi truy cập nó sẽ tìm đến template theo thứ tự từ ① > ② > ③ > ④ > ⑤.
```bash
index.php                    ⑤
├──singular.php              ④
│  └──page.php               ③
│     └──page-$id.php        ②
│        └──page-$slug.php   ①
```

# Tham khảo
- https://developer.wordpress.org/themes/basics/template-hierarchy/
- https://wphierarchy.com/
- https://en.wikipedia.org/wiki/Media_type
- https://developer.wordpress.org/themes/basics/template-hierarchy/#attachment

# Navigation
- [Trang chủ](https://phuquang.github.io/themestandard/)
- [Sơ đồ tài liệu](https://phuquang.github.io/themestandard/sitemap)
