<div class="wrap">
 
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
 
    <?php settings_errors(); ?>

    <form method="post" action="<?php echo esc_html( admin_url( 'admin-post.php' ) ); ?>">
        <div id="universal-message-container">
            <h2 class="title">Google Analytics ID</h2>
            <div class="options">
                <p>
                    <label for="euperia-google-analytics-id">Enter your Google Analytics Tracking ID:</label>
                    <br />
                    <input 
                    type="text" 
                    name="euperia-google-analytics-id"
                    id="euperia-google-analytics-id"
                    value="<?php echo esc_attr($this->deserializer->get_value('euperia-google-analytics-id')); ?>" 
                    placeholder="e.g. UA-xxxxxxxxx-x"
                    />
                </p>
            </div>
            <div class="options">
            <?php
                wp_nonce_field( 'euperia-google-analytics-id-save', 'euperia-google-analytics-id-message');
                submit_button();
            ?>
            </div>
    </form>
 
</div>
