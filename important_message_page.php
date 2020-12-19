<?php settings_errors(); ?>
<div class='immWrapper'>
	<form method="POST" action="options.php">  

        Enabled?
        <br>
        <?php $imm_enabled = esc_attr(get_option('imm_enabled')); ?>
        <input class="apple-switch" name="imm_enabled" type="checkbox" <?php if($imm_enabled == 'on'){ echo "checked"; } ?> />
        <?php $imm_msg = esc_attr(get_option('imm_msg')); ?>
        <input type='text' value='<?php echo $imm_msg; ?>' placeholder="Message..." class='imm_msg' name='imm_msg' />
        <?php settings_fields( 'imm_options_group' ); ?>

        <input type="submit" name="submit" value="Save" id="submit" class='imm_save'/>
    </form>
</div>

