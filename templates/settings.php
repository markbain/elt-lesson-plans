<div class="wrap">
    <h2>ELT Lesson Plans</h2>
    <form method="post" action="options.php"> 
        <?php @settings_fields('gisig_Lesson_inspiration-group'); ?>
        <?php @do_settings_fields('gisig_Lesson_inspiration-group'); ?>

        <?php do_settings_sections('gisig_Lesson_inspiration'); ?>
        <?php @submit_button(); ?>
    </form>
</div>

<div class="wrap">
	<h2>Support Questions</h2>
	<p>If you have any questions about this plugin, please contact me at <a href="mailto:hello@markbaindesign.com?subject=GISIG%20Plugin%20Support">hello@markbaindesign.com</a>.
</div>
