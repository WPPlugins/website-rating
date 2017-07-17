<?php
/*
  Plugin Name: Website Rating
  Plugin URI: http://buffercode.com/wordpress-website-rating-plugin/
  Description: Easy way to display the number of post in that particular category by selecting from admin dashboard widget.
  Version: 1.3
  Author: vinoth06
  Author URI: http://buffercode.com/
  License: GPLv2
  License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

// Additing Action hook widgets_init
add_action('widgets_init', 'buffercode_website_rating');

function buffercode_website_rating() {
    register_widget('buffercode_website_rating_info');
}

class buffercode_website_rating_info extends WP_Widget {

    function buffercode_website_rating_info() {
        $this->WP_Widget('buffercode_website_rating_info', 'Website Rating', 'Select the category to display');
    }

    public function form($instance) {
        if (isset($instance['buffercode_website_rating_cutom_title'])) {
            $buffercode_website_rating_cutom_title = $instance['buffercode_website_rating_cutom_title'];
        } else {//Setting Default Values
            $buffercode_website_rating_cutom_title = 'Rate Our Website';
        }
        ?>

        <p>Custom Name: <input class="widefat" name="<?php echo $this->get_field_name('buffercode_website_rating_cutom_title'); ?>" type="text" value="<?php echo esc_attr($buffercode_website_rating_cutom_title); ?>" /></p>

        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['buffercode_website_rating_cutom_title'] = (!empty($new_instance['buffercode_website_rating_cutom_title']) ) ? strip_tags($new_instance['buffercode_website_rating_cutom_title']) : '';
        return $instance;
    }

    function widget($args, $instance) {
        extract($args);
        echo $before_widget;
        $bc_name_value = apply_filters('widget_title', $instance['buffercode_website_rating_cutom_title']);

        if (!empty($name)) {
            echo $before_title . $bc_name_value . $after_title;
        }
        ?>
        <?php if (!isset($_COOKIE['buffercode_website_rating'])) { ?>
            <form method="post" action="" onsubmit="setCookie();" name="buffercode_website_rating_post">
                <select name="buffercode_website_rating_options">
                    <option value="5" selected >Please Rate Me!</option>
                    <option value="1">&#9733;</option>
                    <option value="2">&#9733;&#9733;</option>
                    <option value="3">&#9733;&#9733;&#9733;</option>
                    <option value="4">&#9733;&#9733;&#9733;&#9733;</option>
                    <option value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
                </select>
                <input type="submit" name="buffercode_website_rating_submit" value="submit" />
            </form>

            <?php
        }
        if (isset($_COOKIE['buffercode_website_rating']) || isset($_POST['buffercode_website_rating_post'])) {
            if ((isset($_POST['buffercode_website_rating_options']))) {
                $value = esc_attr($_POST['buffercode_website_rating_options']);
                if ($value == 1) {
                    $value1 = esc_attr(get_option('buffercode_website_rating_rating1')) + 1;
                    update_option('buffercode_website_rating_rating1', $value1);
                } elseif ($value == 2) {
                    $value2 = esc_attr(get_option('buffercode_website_rating_rating2')) + 1;
                    update_option('buffercode_website_rating_rating2', $value2);
                } elseif ($value == 3) {
                    $value3 = esc_attr(get_option('buffercode_website_rating_rating3')) + 1;
                    update_option('buffercode_website_rating_rating3', $value3);
                } elseif ($value == 4) {
                    $value4 = esc_attr(get_option('buffercode_website_rating_rating4')) + 1;
                    update_option('buffercode_website_rating_rating4', $value4);
                } elseif ($value == 5) {
                    $value5 = esc_attr(get_option('buffercode_website_rating_rating5')) + 1;
                    update_option('buffercode_website_rating_rating5', $value5);
                }
                $buffercode_website_rating_rating1 = get_option('buffercode_website_rating_rating1');
                $buffercode_website_rating_rating2 = get_option('buffercode_website_rating_rating2');
                $buffercode_website_rating_rating3 = get_option('buffercode_website_rating_rating3');
                $buffercode_website_rating_rating4 = get_option('buffercode_website_rating_rating4');
                $buffercode_website_rating_rating5 = get_option('buffercode_website_rating_rating5');

                $buffercode_website_rating_array = array($buffercode_website_rating_rating1, $buffercode_website_rating_rating2, $buffercode_website_rating_rating3, $buffercode_website_rating_rating4, $buffercode_website_rating_rating5);

                $buffercode_website_rating_max = max($buffercode_website_rating_array);

                $buffercode_website_rating_100 = 100 / $buffercode_website_rating_max;

                $buffercode_website_rating_rating_result_1 = $buffercode_website_rating_rating1 * $buffercode_website_rating_100;
                $buffercode_website_rating_rating_result_2 = $buffercode_website_rating_rating2 * $buffercode_website_rating_100;
                $buffercode_website_rating_rating_result_3 = $buffercode_website_rating_rating3 * $buffercode_website_rating_100;
                $buffercode_website_rating_rating_result_4 = $buffercode_website_rating_rating4 * $buffercode_website_rating_100;
                $buffercode_website_rating_rating_result_5 = $buffercode_website_rating_rating5 * $buffercode_website_rating_100;
                update_option('buffercode_website_rating_rating_result_1', $buffercode_website_rating_rating_result_1);
                update_option('buffercode_website_rating_rating_result_2', $buffercode_website_rating_rating_result_2);
                update_option('buffercode_website_rating_rating_result_3', $buffercode_website_rating_rating_result_3);
                update_option('buffercode_website_rating_rating_result_4', $buffercode_website_rating_rating_result_4);
                update_option('buffercode_website_rating_rating_result_5', $buffercode_website_rating_rating_result_5);

                $buffercode_website_rating_email = get_option('buffercode_website_rating_email');
                $buffercode_website_rating_bloginfo = get_bloginfo('name');
                if(!empty($buffercode_website_rating_email)){
                $buffercode_website_rating_subject = 'New Rating in -'.$buffercode_website_rating_bloginfo;
                $buffercode_website_rating_message = 'Dear Webmaster, One of your user has rated your website with value ' . esc_attr($_POST['buffercode_website_rating_options']) . '  - Regards - ' . $buffercode_website_rating_bloginfo;
                
                wp_mail($buffercode_website_rating_email, $buffercode_website_rating_subject, $buffercode_website_rating_message);
            
                }
            }
            ?>
            <div class="wrap">
                <b><i>Thanks for Rating</i></b><br>
                <b>Website Rating Statistics</b>

                <div class="web-rate">
                    <div class="star">&#9733; 5</div>
                    <div class="value"><?php echo get_option('buffercode_website_rating_rating5'); ?></div>
                    <div class="rattting">
                        <div class="rating" style="width:<?php echo get_option('buffercode_website_rating_rating_result_5'); ?>%; background-color: #00FF00"></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="web-rate">
                    <div class="star">&#9733; 4</div>
                    <div class="value"><?php echo get_option('buffercode_website_rating_rating4'); ?></div>
                    <div class="rattting">
                        <div class="rating" style="width:<?php echo get_option('buffercode_website_rating_rating_result_4'); ?>%; background-color: #FF2AAA"></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="web-rate">
                    <div class="star">&#9733; 3</div>
                    <div class="value"><?php echo get_option('buffercode_website_rating_rating3'); ?></div>
                    <div class="rattting">
                        <div class="rating" style="width:<?php echo get_option('buffercode_website_rating_rating_result_3'); ?>%; background-color: #ffff00"></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="web-rate">
                    <div class="star">&#9733; 2</div>
                    <div class="value"><?php echo get_option('buffercode_website_rating_rating2'); ?></div>
                    <div class="rattting">
                        <div class="rating" style="width:<?php echo get_option('buffercode_website_rating_rating_result_2'); ?>%; background-color: #00ffff"></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="web-rate">
                    <div class="star">&#9733; 1</div>
                    <div class="value"><?php echo get_option('buffercode_website_rating_rating1'); ?></div>
                    <div class="rattting">
                        <div class="rating" style="width:<?php echo get_option('buffercode_website_rating_rating_result_1'); ?>%; background-color: #ff6666"></div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <?php
        }
        echo $after_widget;
    }

}

add_action('admin_menu', 'buffercode_website_rating_menu');

function buffercode_website_rating_menu() {

    add_options_page('Website Rating ID', 'Website Rating', 'manage_options', __FILE__, 'buffercode_website_rating_options');
    add_action('admin_init', 'buffercode_website_rating_regsiter_setting');
}

function buffercode_website_rating_options() {
    ?>

    <div class="wrap">

        <h2>Website Rating Statistics</h2><br><br>

        <div class="web-rate">
            <div class="star">&#9733; 5</div>
            <div class="value"><?php echo get_option('buffercode_website_rating_rating5'); ?></div>
            <div class="rattting">
                <div class="rating" style="width:<?php echo get_option('buffercode_website_rating_rating_result_5'); ?>%; background-color: #00FF00"></div>
            </div>
            <div class="clear"></div>
        </div>

        <div class="web-rate">
            <div class="star">&#9733; 4</div>
            <div class="value"><?php echo get_option('buffercode_website_rating_rating4'); ?></div>
            <div class="rattting">
                <div class="rating" style="width:<?php echo get_option('buffercode_website_rating_rating_result_4'); ?>%; background-color: #FF2AAA"></div>
            </div>
            <div class="clear"></div>
        </div>


        <div class="web-rate">
            <div class="star">&#9733; 3</div>
            <div class="value"><?php echo get_option('buffercode_website_rating_rating3'); ?></div>
            <div class="rattting">
                <div class="rating" style="width:<?php echo get_option('buffercode_website_rating_rating_result_3'); ?>%; background-color: #ffff00"></div>
            </div>
            <div class="clear"></div>
        </div>


        <div class="web-rate">
            <div class="star">&#9733; 2</div>
            <div class="value"><?php echo get_option('buffercode_website_rating_rating2'); ?></div>
            <div class="rattting">
                <div class="rating" style="width:<?php echo get_option('buffercode_website_rating_rating_result_2'); ?>%; background-color: #00ffff"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="web-rate">
            <div class="star">&#9733; 1</div>
            <div class="value"><?php echo get_option('buffercode_website_rating_rating1'); ?></div>
            <div class="rattting">
                <div class="rating" style="width:<?php echo get_option('buffercode_website_rating_rating_result_1'); ?>%; background-color: #ff6666"></div>
            </div>
            <div class="clear"></div>
        </div>

        <form method="post" action="options.php">
            <?php settings_fields('buffercode_website_rating_regsiter_setting_group'); ?>
            <?php do_settings_sections('buffercode_website_rating_regsiter_setting_group'); ?>
            <table>
                <tr valign="top">
                    <th>Do you want to mail on each voting by user ?</th>
                    <td><input type="text" name="buffercode_website_rating_email" placeholder="Enter your email id" value="<?php echo get_option('buffercode_website_rating_email') ?>" /></td>
                </tr>
                <tr valign="top">

                    <td><?php submit_button(); ?></td>
                </tr>
                For Suggestion - <a href="http://buffercode.com/wordpress-website-rating-plugin/">Buffercode.com</a> <br /> If you find this plugin valuable ? kindly,<br /> <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7DHAEMST475BY"><img src="<?php echo plugins_url('images/donate.png', __FILE__); ?>" alt="Donate" /></a>
                <!-- Buffercode.com website rating Statistics -->
            </table>
        </form>

    </div>
<?php
}

function buffercode_website_rating_regsiter_setting() {
    register_setting('buffercode_website_rating_regsiter_setting_group', 'buffercode_website_rating_options');
    register_setting('buffercode_website_rating_regsiter_setting_group', 'buffercode_website_rating_isset_email');
    register_setting('buffercode_website_rating_regsiter_setting_group', 'buffercode_website_rating_email');
}

add_action('wp_footer', 'buffercode_cookie_script');

function buffercode_cookie_script() {

    echo "<script>function setCookie(){ document.cookie = 'buffercode_website_rating=ok; expires=Fri, 14 Oct 2040 20:47:11 UTC; path=/' }</script>\n";
}

function buffercode_website_rating_css() {
    wp_enqueue_style('bc-website-rating', plugins_url('css/bc-website-rating.css', __FILE__));
}

add_action('wp_footer', 'buffercode_website_rating_css');
add_action('admin_enqueue_scripts', 'buffercode_website_rating_css');
?>