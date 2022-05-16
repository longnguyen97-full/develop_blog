# Form validation

# Cấu trúc thư mục
```bash
.
├──📁inc/                                # Function, controller v.v..
│  └──📁libraries/                       # Chứa thư viện code
│     └──📁Form/                         # Thư viện Form
│        ├──📝index.php                  # File index để tránh truy cập trực tiếp
│        ├──📝init.php                   # Include các file quang trọng
│        ├──📝QNP_Form.php               # Chương trình chính
│        ├──📝QNP_Field.php              # Khởi tạo field
│        ├──📝QNP_Mailer.php             # Gửi mail
│        ├──📝trait.qnp_errors.php       # Hàm xử lý thông tin lỗi
│        ├──📝trait.qnp_filters.php      # Hàm xử lý và chuyển đổi dữ liệu
│        ├──📝trait.qnp_methods.php      # Hàm xử lý dữ liệu đầu vào
│        ├──📝trait.qnp_rules.php        # Xử lý dữ liệu qua các quy tắc định trước
│        └──📝trait.qnp_helpers.php      # Hàm phụ trợ
├──📁form-controllers/                   # Chứa các file sử lý của form
│  ├──📝page-contact-controller.php      # Xử lý
│  ├──📝page-contact-validator.php       # Kiểm tra đầu vào
│  └──📝page-contact-sendmail.php        # Gửi mail
├──📁template-emails/                    # Chứa các mẫu gửi mail
│  ├──📝page-contact-user.tpl            # Mẫu dành email của user
│  └──📝page-contact-admin.tpl           # Mẫu dành email của admin
├──📁template-pages/                     # Chứa các trang với định danh là slug
│  ├──📝page-contact.php                 # Trang form
│  └──📝page-contact-complete.php        # Trang hoàn thành của form
├──📁template-parts/                     # Chứa các thành phần của trang
│  ├──📝content-contact-confirmation.php # Phần nội dung của trang xác nhận
│  └──📝content-contact.php              # Phần nội dung của trang form
```

# Luồn chính
```bash
.
└─┐template-pages/
  ├──┐page-contact.php
  │  ├──┐form-controllers/
  │  │  └──┐page-contact-controller.php
  │  │     ├──┐inc/libraries/Form/
  │  │     │  ├──index.php
  │  │     │  ├──init.php
  │  │     │  ├──QNP_Form.php
  │  │     │  ├──QNP_Field.php
  │  │     │  ├──QNP_Mailer.php
  │  │     │  ├──trait.qnp_errors.php
  │  │     │  ├──trait.qnp_filters.php
  │  │     │  ├──trait.qnp_methods.php
  │  │     │  ├──trait.qnp_rules.php
  │  │     │  └──trait.qnp_helpers.php
  │  │     ├───page-contact-validator.php
  │  │     └──┐page-contact-sendmail.php
  │  │        └──┐template-emails/
  │  │           ├──page-contact-user.tpl
  │  │           └──page-contact-admin.tpl
  │  └──┐template-parts/
  │     ├──content-contact-confirmation.php
  │     └──content-contact.php
  └──page-contact-complete.php
```

# Rules

| Hàm | Param | Return | Giải thích |
| --- | --- | --- | --- |
| **required** | `String` | `true`/`false` | Value is exist |
| **max** | `String`, `integer` | `true`/`false` | Value is elder condition |
| **min** | `String`, `integer` | `true`/`false` | Value is lesser condition |
| **zipcode** | `String` | `true`/`false` | zipcode format exactly |
| **hiragana** | `String` | `true`/`false` | hiragana format exactly |
| **katakana** | `String` | `true`/`false` | katakana format exactly |
| **email** | `String` | `true`/`false` | email format exactly |
| **phone** | `String` | `true`/`false` | phone format exactly |
| **number** | `String` | `true`/`false` | number format exactly |
| **url** | `String` | `true`/`false` | url format exactly |
| **fullwidth** | `String` | `true`/`false` | fullwidth format exactly |
| **numfullwidth** | `String` | `true`/`false` | number fullwidth format exactly |
| **dateformat** | `String` | `true`/`false` | date format exactly |
| **passwordstrength** | `String` | `true`/`false` | Use long passwords (8-20) with letters, CAPS, numbers and sybols |
| **passwordstrengthnotsymbols** | `String` | `true`/`false` | Use long passwords (8-20) with letters, CAPS and numbers |
| **passwordstrengthtomessage** | `String` | `true`/`false` | Use long passwords (8-20) with letters, CAPS and numbers |

# Helpers

| Hàm | Param | Return | Giải thích |
| --- | --- | --- | --- |
| **eAgreement** | `String` name of input | `String` checked for checkbox | Used for checkbox |
| **eChecked** | `String` name of input, `String` current value of field, `Boolean` default when empty value | `String` checked for checkbox | Used for checkbox |
| **eSelected** | `String` name of input, `String` current value of field, `Boolean` default when empty value | `String` selected for select | Used for select |
| **eCheckedbox** | `String` name of input, `String` current value of field, `Boolean` default when empty value | `String` checked for checkbox | Used for checkbox |
| **eCheckedboxText** | `String` name of input, `String` current value of field, `Boolean` default when empty value | `String` checked for checkbox | Used for checkbox |
| **eTextarea** | `String` name of input, `Boolean` br tag or newline, `Boolean` return or echo | `String` value for input | Used for textarea |
| **args_msg** | `String` name of input, `Array` | `String` value of array | Used for ratio or select |
| **args_checkbox** | `String` name of input, `String` | `String` value of array | Used for checkbox |
| **hiddenInput** | `String` name of input | `String` input tag hidden | Used for input |
| **hiddenTextarea** | `String` name of input | `String` textarea tag hidden | Used for textarea |

# Errors

| Hàm | Param | Return | Giải thích |
| --- | --- | --- | --- |
| **notErrors** | | `true`/`false` | condition is not error |
| **hasErrors** | | `true`/`false` | condition is has error |
| **addError** | `String` name of input, `String` name of method, `String` message of error | | Used for add error |

# Filters

| Hàm | Param | Return | Giải thích |
| --- | --- | --- | --- |
| **convertKatakana** | `String` | `String` | Chuyển đổi hoàn toàn hiragana sang katakana |
| **convertHankaku** | `String` | `String` | Chuyển đổi thành các ký tự hankaku |
| **convertHiragana** | `String` | `String` | Chuyển đổi hoàn toàn katakana sang hiragana |
| **convertHiraganaToKatakana** | `String` | `String` | Chuyển đổi hiragana thành katakana |
| **convertNewLine** | `String`, `Boolean` | `String` | Chuyển \r\n thành thẻ br hoặc \n |
| **mb_trim** | `String`, `String` | `String` | Trim space fullsize and halfsize |
| **trimSpace** | `String` | `String` | Trim space, tab |
| **numFull2Half** | `String` | `String` | Chuyển đổi số full-width thành half-width |
| **removeSlashes** | `String` | `String` | Loại bỏ 2 dấu \ liền kề |
| **convertTel** | `String` | `String` | Bình thường hóa số điện thoại |
| **convertDateJa** | `String` | `String` | Chuyển đổi ngày sang định dạng Y年m月d日 |
| **convertStr2Dot** | `String`, `String` | `String` | Chuyển đổi tất cả ký tự thành ký tự ● |

# Methods

| Hàm | Param | Return | Giải thích |
| --- | --- | --- | --- |
| **methodIsPost** | | `Boolean` | Condition REQUEST_METHOD is POST  |
| **methodIsGet** | | `Boolean` | Condition REQUEST_METHOD is GET |
| **post** | `String` name of input, `Boolean` return or echo, `Boolean` filter it | `String` | get value from POST |
| **get** | `String` name of input, `Boolean` return or echo, `Boolean` filter it | `String` | get value from GET |
| **issetPost** | | | Condition input name exist POST |
| **issetGet** | | | Condition input name exist GET |

# Navigation

- [Trang chủ](https://phuquang.github.io/themestandard/)
- [Sơ đồ tài liệu](https://phuquang.github.io/themestandard/sitemap)
