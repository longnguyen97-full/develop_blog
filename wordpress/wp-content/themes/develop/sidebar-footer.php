<?php
if (!is_active_sidebar('footer')) {
    return;
}
?>
<div class="row">
    <?php dynamic_sidebar('footer'); ?>
</div>