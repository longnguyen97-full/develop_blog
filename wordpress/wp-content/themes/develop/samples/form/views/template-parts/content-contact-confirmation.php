<h1>Confirmation</h1>

<h4>Form</h4>
<form action="/contact/" method="post" status="<?php echo $form_status ?>">
<input type="text" name="form_session" value="<?php echo !empty($form_session_name) ? $form_session_name : $Validate->post('form_session') ?>">
<input type="text" name="form_token" value="<?php echo !empty($form_token_value) ? $form_token_value : $Validate->post('form_token') ?>">
    <h4>Input</h4>
    <table class="table table-bordered table-hover">
        <?php foreach ($Validate->fields as $key => $field) : ?>
            <tr>
                <td style="width:255px"><?php echo $field->label ?></td>
                <td>
                    <?php
                    if ( is_array($field->value) ) {
                        foreach ($field->value as $v) {
                            echo $v . '<br>';
                        }
                        $Validate->hiddenInputArgs($field->name, $field->value);
                    } else {
                        echo $field->value;
                        $Validate->hiddenInput($field->name);
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <button type="submit" name="submit" value="back" class="btn btn-secondary">Back</button>
    <button type="submit" name="submit" value="done" class="btn btn-primary">Send Mail</button>
</form>