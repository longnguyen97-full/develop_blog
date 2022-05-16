<h1>Index</h1>

<h4>Form</h4>
<form action="/contact/" method="post" status="<?php echo $form_status ?>">
<input type="text" name="form_session" value="<?php echo !empty($form_session_name) ? $form_session_name : $Validate->post('form_session') ?>">
<input type="text" name="form_token" value="<?php echo !empty($form_token_value) ? $form_token_value : $Validate->post('form_token') ?>">
    <?php if ( $Validate->hasErrors() ): ?>
    <h4>Errors</h4>
    <div style="color:red;">
        <?php foreach ( $Validate->errors as $error_field_name => $error ) {
            echo '<p id="error-'.$error_field_name.'">'.array_shift($error[0]).'</p>';
        } ?>
    </div>
    <?php endif; ?>
    <h4>Input</h4>
    <table class="table table-bordered table-hover">
        <tr <?php $Validate->printError('fullname','class="table-danger"') ?>>
            <td style="width:255px"><label for="">氏名</label><span class="requied"></span></td>
            <td>
                <input type="text" name="fullname" value="<?php $Validate->post('fullname') ?>" class="form-control" placeholder="例）シュッピン　太郎">
                <?php $Validate->printError('fullname','<span class="error">:message</span>') ?>
            </td>
        </tr>
        <tr <?php $Validate->printError('namekana','class="table-danger"') ?>>
            <td><label for="">フリガナ</label><span class="requied"></span></td>
            <td>
                <input type="text" name="namekana" value="<?php $Validate->post('namekana') ?>" class="form-control" placeholder="例）シュッピン　タロウ">
                <?php $Validate->printError('namekana','<span class="error">:message</span>') ?>
            </td>
        </tr>
        <tr <?php $Validate->printError('year','class="table-danger"') ?>>
            <td><label for="">年齢</label><span class="requied"></span></td>
            <td>
                <input type="text" name="year" value="<?php $Validate->post('year') ?>" class="form-control" placeholder="例）1991（半角）">
                <?php $Validate->printError('year','<span class="error">:message</span>') ?>
            </td>
        </tr>
        <tr <?php $Validate->printError('phone','class="table-danger"') ?>>
            <td><label for="">電話番号</label><span class="requied"></span></td>
            <td>
                <input type="text" name="phone" value="<?php $Validate->post('phone') ?>" class="form-control" placeholder="例）12345678910（半角）">
                <?php $Validate->printError('phone','<span class="error">:message</span>') ?>
            </td>
        </tr>
        <tr <?php $Validate->printError('email','class="table-danger"') ?>>
            <td><label for="">メールアドレス</label><span class="requied"></span></td>
            <td>
                <input type="text" name="email" value="<?php $Validate->post('email') ?>" class="form-control" placeholder="例）pauli@cybridge.jp（半角）">
                <?php $Validate->printError('email','<span class="error">:message</span>') ?>
            </td>
        </tr>
        <tr <?php $Validate->printError('emailconfirm','class="table-danger"') ?>>
            <td><label for="">メールアドレス（確認用）</label><span class="requied"></span></td>
            <td>
                <input type="text" name="emailconfirm" value="<?php $Validate->post('emailconfirm') ?>" class="form-control" placeholder="確認のためもう一度ご入力ください">
                <?php $Validate->printError('emailconfirm','<span class="error">:message</span>') ?>
            </td>
        </tr>
        <tr <?php $Validate->printError('gender','class="table-danger"') ?>>
            <td><label for="">性別</label><span class="requied"></span></td>
            <td>
                <div class="form-check radio">
                    <input type="radio" name="gender" value="男" id="male" class="form-check-input" <?php $Validate->eChecked('gender', '男') ?>>
                    <span class="radioStyle"></span>
                    <label class="form-check-label" for="male">男性</label>
                </div>
                <div class="form-check radio">
                    <input type="radio" name="gender" value="女" id="female" class="form-check-input" <?php $Validate->eChecked('gender', '女') ?>>
                    <span class="radioStyle"></span>
                    <label class="form-check-label" for="female">女性</label>
                </div>
                <?php $Validate->printError('gender','<span class="error">:message</span>') ?>
            </td>
        </tr>
        <tr <?php $Validate->printError('hope','class="table-danger"') ?>>
            <td><label for="">希望連絡方法</label><span class="requied"></span></td>
            <td>
                <?php 
                $hope = array('電話','メール','どちらでも良い');
                foreach ($hope as $h):?>
                <div class="form-check radio">
                    <input type="radio" name="hope" <?php $Validate->eChecked('hope', $h) ?> value="<?php echo $h ?>" id="<?php echo $h ?>" class="form-check-input">
                    <span class="radioStyle"></span>
                    <label class="form-check-label"  for="<?php echo $h ?>"><?php echo $h ?></label>
                </div>
                <?php endforeach; ?>
                <?php $Validate->printError('hope','<span class="error">:message</span>') ?>
            </td>
        </tr>
        <tr <?php $Validate->printError('zipcode','class="table-danger"') ?>>
            <td><label for="">住所</label><span class="requied"></span></td>
            <td>
                <p>
                    <span>郵便番号</span>
                    <input type="text" name="zipcode" value="<?php $Validate->post('zipcode') ?>" class="form-control" placeholder="例）1070062（半角）">
                    <?php $Validate->printError('zipcode','<span class="error">:message</span>') ?>
                </p>
                <div class="form-row">
                    <div class="col">
                        <input type="text" name="zipcode1" value="<?php $Validate->post('zipcode1') ?>" class="form-control" placeholder="例）107">
                    </div>
                    ―
                    <div class="col">
                        <input type="text" name="zipcode2" value="<?php $Validate->post('zipcode2') ?>" class="form-control" placeholder="例）0062">
                    </div>
                </div>
                <?php $Validate->printError('zipcode1','<span class="error">:message</span>') ?>
                <?php $Validate->printError('zipcode2','<span class="error">:message</span>') ?>
                <br>
                <p>
                    <span>都道府県</span>
                    <select name="pref" class="form-control">
                        <option value="" disabled selected>【選択して下さい】</option>
                        <?php
                        $prefs = array('北海道','青森県','岩手県','宮城県','秋田県','山形県','福島県','茨城県','栃木県','群馬県','埼玉県','千葉県','東京都','神奈川県','新潟県','富山県','石川県','福井県','山梨県','長野県','岐阜県','静岡県','愛知県','三重県','滋賀県','京都府','大阪府','兵庫県','奈良県','和歌山県','鳥取県','島根県','岡山県','広島県','山口県','徳島県','香川県','愛媛県','高知県','福岡県','佐賀県','長崎県','熊本県','大分県','宮崎県','鹿児島県','沖縄県','海外');
                        foreach ($prefs as $pref): ?>
                        <option value="<?php echo $pref ?>" <?php $Validate->eSelected('pref',$pref) ?> ><?php echo $pref ?></option>
                        <?php endforeach;?>
                    </select>
                    <?php $Validate->printError('pref','<span class="error">:message</span>') ?>
                </p>
                <p>
                    <span>国名</span>
                    <input type="text" name="country" value="<?php $Validate->post('country') ?>" class="form-control" placeholder="国名">
                    <?php $Validate->printError('country','<span class="error">:message</span>') ?>
                </p>
                <p>
                    <span>市区町村</span>
                    <input type="text" name="city" value="<?php $Validate->post('city') ?>" class="form-control" placeholder="例）新宿区西新宿">
                    <?php $Validate->printError('city','<span class="error">:message</span>') ?>
                </p>
                <p>
                    <span>丁目番地（建物名）</span>
                    <input type="text" name="address" value="<?php $Validate->post('address') ?>" class="form-control" placeholder="例）1丁目14番11号　日廣ビル3階">
                    <?php $Validate->printError('address','<span class="error">:message</span>') ?>
                </p>
            </td>
        </tr>
        <tr <?php $Validate->printError('recruitment','class="table-danger"') ?>>
            <td><label for="">募集を知ったきっかけ</label><span class="requied"></span></td>
            <td>
                <?php 
                $recruitments = array('求人媒体','店舗で求人情報を見た','シュッピンのブログやsnsを見た','ネット通販サイトで求人情報を見た','シュッピン社員の紹介（紹介者の名前を入力してください）','採用イベントに参加した（イベント名の入力をお願いします）','コーポレートサイト','その他');
                foreach ($recruitments as $r):?>
                <div class="form-check checkbox">
                    <input type="checkbox" name="recruitment[]" <?php $Validate->eCheckedbox('recruitment',$r) ?> value="<?php echo $r ?>" id="<?php echo $r ?>" class="form-check-input">
                    <span class="checkboxStyle"></span>
                    <label class="form-check-label" for="<?php echo $r ?>"><?php echo $r ?></label>
                </div>
                <?php endforeach; ?>
                <?php $Validate->printError('recruitment','<span class="error">:message</span>') ?>
            </td>
        </tr>
        <tr <?php $Validate->printError('pr','class="table-danger"') ?>>
            <td><label for="">自己PR</label><span class="requied"></span></td>
            <td>
                <textarea name="pr" cols="30" rows="10" class="form-control"><?php $Validate->post('pr') ?></textarea>
                <?php $Validate->printError('pr','<span class="error">:message</span>') ?>
            </td>
        </tr>
        <tr <?php $Validate->printError('agreement','class="table-danger"') ?>>
            <td><label for="">プライバシーポリシーの同意</label><span class="requied"></span></td>
            <td>
                <div class="form-check checkbox">
                    <input type="checkbox" name="agreement" value="同意する" <?php $Validate->eAgreement('agreement') ?> id="agreement" class="form-check-input">
                    <span class="checkboxStyle"></span>
                    <label class="form-check-label" for="agreement">同意する</label>
                </div>
                <?php $Validate->printError('agreement','<span class="error">:message</span>') ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" name="submit" value="confirm" class="btn btn-primary">Confirm identity</button>
            </td>
        </tr>
    </table>
</form>