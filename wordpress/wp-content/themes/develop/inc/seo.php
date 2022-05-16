<?php
/**
 * titleを書き換える
 * Custom title wordpress
 */
add_filter( 'wp_title', function ( $title ) {
    $site_info = get_bloginfo('description').'｜'.get_bloginfo();
    if ( empty($title) ) {
        $title = $site_info;
    } else {
        $title .= '｜'.$site_info;
    }
    if ( is_404() ) {
        $title = '404｜'.$site_info;
    }
    return $title;
} );

/**
 * titleを書き換える
 * All in One SEO Pack が出力するtitle、description、keywordを書き換える方法まとめ
 * Custom title  for All in One SEO Pack
 */
add_filter('aioseop_title', function ($title) {
    return $title;
});

/**
 * descriptionを書き換える
 * All in One SEO Pack が出力するtitle、description、keywordを書き換える方法まとめ
 * Custom description for All in One SEO Pack
 */
add_filter('aioseop_description', function ($description) {
    return $description;
});

/**
 * keywordsを書き換える
 * All in One SEO Pack が出力するtitle、description、keywordを書き換える方法まとめ
 * Custom keywords for All in One SEO Pack
 */
add_filter('aioseop_keywords', function ($keywords) {
    return $keywords;
});
