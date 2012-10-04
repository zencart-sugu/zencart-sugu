// 名前空間
var liveValidation = new Object();

// コンストラクタ
liveValidation.Validator = function(mainPage, config) {
    var me = this;
    jQuery(document).ready(function() {
        me.setForm(mainPage);
        me.unbindDefaultValidation();
        me.makeErrorPlacements();
        me.makeRulesAndMessages(config);
        me.form.validate(
            {rules:    me.rules,
             messages: me.messages});
    });
}

liveValidation.Validator.prototype = {

    // インスタンス変数
    form: null,
    rules: {},
    messages: {},

    setForm: function(mainPage) {
        var formName;

        switch(mainPage) {
        case 'login':
        case 'create_account':
            formName = 'create_account';
            break;
        case 'account_edit':
            formName = 'account_edit';
            break;
        case 'address_book_process':
            formName = 'addressbook';
            break;
        case 'checkout_shipping_address':
        case 'checkout_payment_address':
            formName = 'checkout_address';
            break;
        }
        if (formName) {
            this.form = jQuery('form[name="' + formName + '"]');
        }
    },
    // インスタンスメソッド
    /**
     */
	unbindDefaultValidation: function() {

        if (this.form) {
            this.form.removeAttr('onsubmit');
        }
    },
    makeErrorPlacements: function() {
        var fields = {
            'email_address'      : {'type': 'input', 'for': 'email-address'},
            'password'           : {'type': 'input', 'for': 'password-new'},
            'confirmation'       : {'type': 'input', 'for': 'password-confirm'},
            'firstname'          : {'type': 'input', 'for': 'firstname'},
            'lastname'           : {'type': 'input', 'for': 'lastname'},
            'firstname_kana'     : {'type': 'input', 'for': 'firstname_kana'},
            'lastname_kana'      : {'type': 'input', 'for': 'lastname_kana'},
            'postcode'           : {'type': 'input', 'for': 'postcode'},
            'state'              : {'type': 'input', 'for': 'state'},
            'city'               : {'type': 'input', 'for': 'city'},
            'street_address'     : {'type': 'input', 'for': 'street-address'},
            'suburb'             : {'type': 'input', 'for': 'suburb'},
            'company'            : {'type': 'input', 'for': 'company'},
            'telephone'          : {'type': 'input', 'for': 'telephone'},
            'fax'                : {'type': 'input', 'for': 'fax'},
            'gender'             : {'type': 'input', 'for': 'gender'},
            'dob'                : {'type': 'input', 'for': 'dob'},
            'privacy_conditions' : {'type': 'input', 'for': 'privacy_conditions'}
        }
        // 都道府県の特別な処理
        // textのときとselectの時がある
        if ($('select[name="state"]').length > 0) {
            fields.state.type = 'select';
        }
        $.each(fields, function(name, property) {
          if ($('label.error[for="'+ property.for +'"]').length == 0) {
            $(property.type + '[name="'+ name +'"]').parent().append('<p><label class="error" for="'+ property.for +'" generated="false" style="display:none;"></label></p>');
          }
        });
    },
    makeRulesAndMessages: function(config) {
        var me = this;
        // 都道府県の特別な処理
        // textのときとselectの時がある
        if ($('select[name="state"]').length > 0) {
            delete config.state.minlength;
        }
        $.each(config, function(field, setting) {
            $.each(setting, function(type, validate) {
                if (type == 'required' && validate.value == true && liveValidation.validate_depend_firstname == true) {
                    me.addRule(field, type, me.isRequired);
                } else {
                    me.addRule(field, type, validate.value);
                }
                me.addMessage(field, type, validate.message);
            });
        });
    },
    addRule: function(field, key, value) {
        if (this.rules[field] == undefined) {
            this.rules[field] = {};
        }
        this.rules[field][key] = value;
    },
    addMessage: function(field, key, value) {
        if (this.messages[field] == undefined) {
            this.messages[field] = {};
        }
        this.messages[field][key] = value;
    },
    isRequired: function() {
        if (liveValidation.validate_depend_firstname == true) {
            if ($('#firstname').val() == '' && $('#lastname').val() == '' && $('#street-address').val() == '') {
                return false;
            }
        }
        return true;
    }
}
