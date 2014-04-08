window.lineStorm = window.lineStorm || {};
window.lineStorm.api = (function(){

    // convert a form to a multi dimentional array
    var _serializeForm = function($form){

        var self = this,
            json = {},
            push_counters = {},
            patterns = {
                "validate": /^[a-zA-Z][a-zA-Z0-9_]*(?:\[(?:\d*|[a-zA-Z0-9_]+)\])*$/,
                "key":      /[a-zA-Z0-9_]+|(?=\[\])/g,
                "push":     /^$/,
                "fixed":    /^\d+$/,
                "named":    /^[a-zA-Z0-9_]+$/
            };

        this.build = function(base, key, value){
            base[key] = value;
            return base;
        };

        this.push_counter = function(key){
            if(push_counters[key] === undefined){
                push_counters[key] = 0;
            }
            return push_counters[key]++;
        };

        $.each($form, function(i,v){

            // skip invalid keys
            if(!patterns.validate.test(this.name)){
                return;
            }

            var k,
                keys = i.match(patterns.key),
                merge = v,
                reverse_key = i;

            while((k = keys.pop()) !== undefined){

                // adjust reverse_key
                reverse_key = reverse_key.replace(new RegExp("\\[" + k + "\\]$"), '');

                // push
                if(k.match(patterns.push)){
                    merge = self.build([], self.push_counter(reverse_key), merge);
                }

                // fixed
                else if(k.match(patterns.fixed)){
                    merge = self.build([], k, merge);
                }

                // named
                else if(k.match(patterns.named)){
                    merge = self.build({}, k, merge);
                }
            }

            json = $.extend(true, json, merge);
        });

        return json;
    };

    var _call = function(url, options){

        if(options === undefined)
            options = {};

        var opts = $.extend(true, {}, options, { url: url });

        $.ajax(opts);
    };

    var _saveForm = function($form, callback_success, callback_failure){
        var data, field, fname, method;

        method = $form[0].method;

        callback_success = callback_success || null;
        callback_failure = callback_failure || null;

        data = {};

        for(var i=0 ; i<$form[0].length ; ++i){
            field = $form[0][i];
            if(field.name){
                fname = field.name;

                if(field.name === '_method'){
                    method = field.value;
                } else if(field.type === 'radio'){
                    data[fname] = data[fname] || [];
                    data[fname].push(field.value);
                } else if(field.type === 'checkbox'){
                    data[fname] = field.checked ? field.value : null;
                } else {
                    if(field.name.match(/\[\]$/)){
                        fname = field.name.replace(/\[\]$/, '');
                        data[fname] = data[fname] || [];
                        data[fname].push($(field).val());
                    } else {
                        data[fname] = $(field).val();
                    }
                }
            }
        }

        var sData = _serializeForm(data);

        $form.find('input[type="submit"]').prop('disabled', true);

        _call($form[0].action, {
            data: JSON.stringify(sData),
            method: method,
            success: function(e){
                $form.find('input[type="submit"]').prop('disabled', false);
                callback_success.call(this, e);
            },
            error: function(a,b,c){
                $form.find('input[type="submit"]').prop('disabled', false);
                callback_failure.call(this, a,b,c);
            }
        });

    };

    return {
        serializeForm:  _serializeForm,
        saveForm:       _saveForm,
        call:           _call
    }

})();
