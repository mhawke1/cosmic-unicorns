<div class="wrap">
    <h1><img src="<?php echo WPHYPERSPEED_ASSETS_URL . '/icon.png'; ?>" style="height:20px"> <?php echo WPHYPERSPEED_TITLE; ?></h1>

    <h3>Visit my <a href="https://marketinginunderwear.com/">Website</a></h3>

    <form method="post" novalidate="novalidate">
        <input type="hidden" name="option_page" value="general">
        <input type="hidden" name="action" value="update">

        <?php wp_nonce_field('update'); ?>

        <table class="form-table">
            <tbody>
                    <tr>
                        <th scope="row">Enable WP Speed Visit:</th>
                        <td>
                            <label>
                                <input
                                    type="checkbox"
                                    class="checkbox"
                                    name="enable_hyper_speed"
                                    <?php checked($settings->enable_hyper_speed); ?>
                                   >Enable WP Speed Visit
                            </label>
                        </td>
                    </tr>

                    <tr>
                        <th scope="row">Enable Advanced Mode:</th>
                        <td>
                            <label>
                                <input
                                    type="checkbox"
                                    class="checkbox"
                                    name="use_advanced_cache"
                                    data-wphyperspeed-option
                                    <?php checked($settings->use_advanced_cache); ?>
                                >Enable Advanced WP Speed Visit Mode (Recommended!)
                            </label>
                        </td>
                    </tr>

                    <tr>
                        <th scope="row">Enable On Posts</th>
                        <td>
                            <label>
                                <input
                                    type="checkbox"
                                    class="checkbox"
                                    name="posts_enabled"
                                    data-wphyperspeed-option
                                    <?php checked($settings->posts_enabled); ?>
                                >Enable WP Speed Visit On Posts
                            </label>
                        </td>
                    </tr>

                    <tr>
                        <th scope="row">Enable On Pages</th>
                        <td>
                            <label>
                                <input
                                    type="checkbox"
                                    class="checkbox"
                                    name="pages_enabled"
                                    data-wphyperspeed-option
                                    <?php checked($settings->pages_enabled); ?>
                                >Enable WP Speed Visit On Pages
                            </label>
                        </td>
                    </tr>

                    <tr>
                        <th scope="row">Enable On Other Pages:</th>
                        <td>
                            <label>
                                <input
                                    type="checkbox"
                                    class="checkbox"
                                    name="other_enabled"
                                    data-wphyperspeed-option
                                    <?php checked($settings->other_enabled); ?>
                                >Enable WP Speed Visit On All Other Pages (eg. homepage)
                            </label>
                        </td>
                    </tr>

                    <tr>
                        <th scope="row">Display Loading Bar:</th>
                        <td>
                            <label>
                                <input
                                    type="checkbox"
                                    class="checkbox"
                                    name="loading_bar"
                                    data-wphyperspeed-option
                                    <?php checked($settings->loading_bar); ?>
                                >Display Loading Bar On Compatible Browsers
                            </label>
                        </td>
                    </tr>

                    <tr>
                        <th scope="row">Cleanup Address Bar:</th>
                        <td>
                            <label>
                                <input
                                    type="checkbox"
                                    class="checkbox"
                                    name="cleanup_address_bar"
                                    data-wphyperspeed-option
                                    <?php checked($settings->cleanup_address_bar); ?>
                                >Remove Additonal Information From The Address Bar
                            </label>
                        </td>
                    </tr>

                  

                  



            </tbody>
        </table>

        <p>WP Speed Visit is only active for visitors who are not logged in - to test the effects, please log out first</p>

        <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Settings"></p>

    </form>
</div>

<script>
    (function($){
        $('[name="enable_hyper_speed"').change(function(event){
            var target = event.target;
            $('[data-wphyperspeed-option]').attr('disabled', !target.checked)
        }).change();
    })(jQuery);
</script>