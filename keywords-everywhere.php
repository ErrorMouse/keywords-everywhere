<?php
/**
 * Plugin Name: 		Keywords Everywhere
 * Description: 		Automatically uses post/product tags, categories, and Rank Math focus keywords to generate meta keywords for your WordPress content.
 * Version: 			2.0
 * Requires at least: 	5.2
 * Author: 				Err
 * Author URI: 			https://profiles.wordpress.org/nmtnguyen56/
 * License: 			GPL2
 * License URI: 		https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: 		keywords-everywhere
 */

if (!defined('ABSPATH')) {
	exit;
}

add_filter('wp_head', 'errkwew_keywords_everywhere', 1);
function errkwew_keywords_everywhere() {
	$keywords = array();

	// Hàm phụ để xuất thẻ meta keywords
	$output_keywords = function($keywords) {
		if (!empty($keywords)) {
			echo '<meta name="keywords" content="' . esc_attr(implode(", ", array_unique($keywords))) . '" />' . "\n";
		}
	};

	// Trường hợp: Bài viết đơn (post)
	if (is_single() && !is_singular('product')) {
		$post_id = get_the_ID();

		// Ưu tiên: Rank Math focus keywords
		$rank_math_keywords = get_post_meta($post_id, 'rank_math_focus_keyword', true);
		if (!empty($rank_math_keywords)) {
			$keywords = array_map('trim', explode(',', $rank_math_keywords));
			$output_keywords($keywords);
			return;
		}

		// Nếu không có, lấy tags thường
		$tags = get_the_tags($post_id);
		if ($tags && !is_wp_error($tags)) {
			foreach ($tags as $tag) {
				$keywords[] = $tag->name;
			}
		}

		$output_keywords($keywords);
	}

	// Trường hợp: Sản phẩm WooCommerce
	elseif (is_singular('product')) {
		$post_id = get_the_ID();

		// Ưu tiên: Rank Math focus keywords
		$rank_math_keywords = get_post_meta($post_id, 'rank_math_focus_keyword', true);
		if (!empty($rank_math_keywords)) {
			$keywords = array_map('trim', explode(',', $rank_math_keywords));
			$output_keywords($keywords);
			return;
		}

		// Lấy thẻ sản phẩm (product_tag)
		$product_tags = get_the_terms($post_id, 'product_tag');
		if ($product_tags && !is_wp_error($product_tags)) {
			foreach ($product_tags as $tag) {
				$keywords[] = $tag->name;
			}
		}

		// Lấy danh mục sản phẩm (product_cat)
		$product_categories = get_the_terms($post_id, 'product_cat');
		if ($product_categories && !is_wp_error($product_categories)) {
			foreach ($product_categories as $category) {
				$keywords[] = $category->name;
			}
		}

		$output_keywords($keywords);
	}

	// Trường hợp: Trang taxonomy (ví dụ product_cat hoặc bất kỳ taxonomy nào)
	elseif (is_tax() || is_category()) {
		$term = get_queried_object();

		if ($term && !is_wp_error($term)) {
			// Ưu tiên: Rank Math focus keywords cho taxonomy
			$rank_math_keywords = get_term_meta($term->term_id, 'rank_math_focus_keyword', true);
			if (!empty($rank_math_keywords)) {
				$keywords = array_map('trim', explode(',', $rank_math_keywords));
			} else {
				// Nếu không có, chỉ lấy tên của term hiện tại
				$keywords[] = $term->name;
			}

			$output_keywords($keywords);
		}
	}

	// Các trường hợp khác: Cho phép Rank Math tự hiển thị keywords
	else {
		add_filter('rank_math/frontend/show_keywords', '__return_true');
	}
}

/* Donate */
add_action( 'admin_enqueue_scripts', 'errkwew_enqueue_admin_scripts' );
function errkwew_enqueue_admin_scripts( $hook_suffix ) {

	$is_plugins_page  = ( 'plugins.php' === $hook_suffix );

	if ( $is_plugins_page ) {
		$donate_css = "
            .err-donate-link {
                font-weight: bold;
                background: linear-gradient(90deg, #0066ff, #00a1ff, rgb(255, 0, 179), #0066ff);
                background-size: 200% auto;
                color: #fff;
                -webkit-background-clip: text;
                -moz-background-clip: text;
                background-clip: text;
                -webkit-text-fill-color: transparent;
                animation: errGradientText 2s linear infinite;
            }
            @keyframes errGradientText {
                to { background-position: -200% center; }
            }";
		wp_add_inline_style( 'wp-admin', $donate_css );
	}
}

function errkwew_donate_link_html() {
	$donate_url = 'https://err-mouse.id.vn/donate';
	printf(
		'<a href="%1$s" target="_blank" rel="noopener noreferrer" class="err-donate-link" aria-label="%2$s"><span>%3$s 🚀</span></a>',
		esc_url( $donate_url ),
		esc_attr__( 'Donate to support this plugin', 'keywords-everywhere' ), //
		esc_html__( 'Donate', 'keywords-everywhere' ) //
	);
}

add_filter( 'plugin_row_meta', 'errkwew_plugin_row_meta', 10, 2 );
function errkwew_plugin_row_meta( $links, $file ) {
	if ( plugin_basename( __FILE__ ) === $file ) {
		ob_start();
		errkwew_donate_link_html();
		$links['donate'] = ob_get_clean();
	}
	return $links;
}