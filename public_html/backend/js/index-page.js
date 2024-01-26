
            
    (function($){
        $.fn.focusTextToEnd = function(){
            this.focus();
            var $thisVal = this.val();
            this.val('').val($thisVal);
            return this;
        }
    }(jQuery));

    function getUrlVars() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
            vars[key] = value;
        });
        return vars;
    }
    function getUrlParam(parameter, defaultvalue){
        var urlparameter = defaultvalue;
        if(window.location.href.indexOf(parameter) > -1){
            urlparameter = getUrlVars()[parameter];
            }
        return urlparameter;
    }
    function updateURLParam(key,val){
        var url = window.location.href;
        var reExp = new RegExp("[\?|\&]"+key + "=[0-9a-zA-Z\_\+\-\|\.\,\;]*");

        if(reExp.test(url)) {
            // update
            var reExp = new RegExp("[\?&]" + key + "=([^&#]*)");
            var delimiter = reExp.exec(url)[0].charAt(0);
            url = url.replace(reExp, delimiter + key + "=" + val);
        } else {
            // add
            var newParam = key + "=" + val;
            if(!url.indexOf('?')){url += '?';}

            if(url.indexOf('#') > -1){
                var urlparts = url.split('#');
                url = urlparts[0] +  "&" + newParam +  (urlparts[1] ?  "#" +urlparts[1] : '');
            }else if(url.indexOf('&') > -1 || url.indexOf('?') > -1){
                url += "&" + newParam;
            } else {
                url += "?" + newParam;
            }
        }
        window.history.pushState(null, document.title, url);
    return url;
        // window.history.pushState(null, document.title, url);
    }
    

    var checkUrlParameter = function checkUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return true;
            }
        }
        return false;
    };
    function  tableLoading(status){
        if(status == 'start'){
            $('#ajax-container').html('<div id="floatingBarsG"> <div class="blockG" id="rotateG_01"></div> <div class="blockG" id="rotateG_02"></div> <div class="blockG" id="rotateG_03"></div> <div class="blockG" id="rotateG_04"></div> <div class="blockG" id="rotateG_05"></div> <div class="blockG" id="rotateG_06"></div> <div class="blockG" id="rotateG_07"></div> <div class="blockG" id="rotateG_08"></div> </div>');  
        }
    }
    $(document).on('click', '.col-btn',function(){
        var val = $(this).data('val');
        $('.'+val).toggleClass('d-none');
        $(this).toggleClass('bg-dark');
        $(this).find('a').toggleClass('text-white');
    });

    function getData(url) {
        tableLoading('start');
        $.ajax({
            url : url,
            cache : false,
        }).done(function (data) {
            $('#ajax-container').html(data);  
            if(checkUrlParameter('search')){
                $('#search').focusTextToEnd();
            }
        }).fail(function () {
            alert('Data could not be loaded.');
        });
    }    

    $('body').on('click', '.pagination a', function(e) {
        e.preventDefault();

        var url = $(this).attr('href');  
        getData(url);
        window.history.pushState("", "", url);
    });

    $(document).on('submit','#TableForm',function(e){
        e.preventDefault();
        var formdata = $(this).serialize();
        var route = $(this).attr('action');
        window.history.pushState(null, document.title, route+'?'+formdata);
        getData(route+'?'+formdata);
        
    });
        $(document).on('change','#jumpTo',function() {
            var url;
            if(checkUrlParameter('page')){
               url = updateURLParam('page', $(this).val());
            }else{
              url =  updateURLParam('page', $(this).val());
            }
            getData(url);
        });
        $(document).on('change','#length',function() {
            var url;
            if(checkUrlParameter('length')){
            url = updateURLParam('length', $(this).val());
            }else{
            url =  updateURLParam('length', $(this).val());
            }
            getData(url);
        });
        $(document).on('change','#search',function() {
            var url;
            if(checkUrlParameter('search')){
               url = updateURLParam('search', $(this).val());
            }else{
               url = updateURLParam('search', $(this).val());
            }
            getData(url);
            $('#search').focus();
        });
          
        $(document).on('click','.asc',function(){
            var desc = getUrlParam('desc');
            var val = $(this).data('val');
            // if(desc == val){
                updateURLParam('desc', "");
            // }
            if(checkUrlParameter('asc')){
                url = updateURLParam('asc', val);
            }else{
                url =  updateURLParam('asc', val);
            }
            getData(url);
        });
        $(document).on('click','.desc',function(){
            var asc = getUrlParam('asc');
            var val = $(this).data('val');
            // if(asc == val){
                updateURLParam('asc', "");
            // }
            if(checkUrlParameter('desc')){
                url = updateURLParam('desc', val);
            }else{
                url =  updateURLParam('desc', val);
            }
            getData(url);
        });
        
        $(document).on('click','#print',function(){
            var tbl_data = $(this).data('rows');
            var print_url = $(this).data('url');
            $.ajax({
                url: print_url,
                method: "post",
                data: {records:tbl_data},
                dataType: 'html',
                success: function(res){
                var w = window.open();
                $(w.document.body).html(res);
                w.print();
                   
                }
            })
        });