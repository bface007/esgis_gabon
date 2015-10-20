/**
 * Created by bface007 on 24/08/2015.
 */
// https://gist.github.com/brucekirkpatrick/7026682
/**
 * $.unserialize
 *
 * Takes a string in format "param1=value1&param2=value2" and returns an object { param1: 'value1', param2: 'value2' }. If the "param1" ends with "[]" the param is treated as an array.
 *
 * Example:
 *
 * Input:  param1=value1&param2=value2
 * Return: { param1 : value1, param2: value2 }
 *
 * Input:  param1[]=value1&param1[]=value2
 * Return: { param1: [ value1, value2 ] }
 *
 * @todo Support params like "param1[name]=value1" (should return { param1: { name: value1 } })
 * Usage example: console.log($.unserialize("one="+escape("& = ?")+"&two="+escape("value1")+"&two="+escape("value2")+"&three[]="+escape("value1")+"&three[]="+escape("value2")));
 */
;(function($){
    $.unserialize = function(serializedString){
        var str = decodeURI(serializedString);
        var pairs = str.split('&');
        var obj = {}, p, idx;
        for (var i=0, n=pairs.length; i < n; i++) {
            p = pairs[i].split('=');
            idx = p[0];
            if (obj[idx] === undefined) {
                obj[idx] = unescape(p[1]).replace ( /\+/g, ' ' );
            }else{
                if (typeof obj[idx] == "string") {
                    obj[idx]=[obj[idx]];
                }
                obj[idx].push(unescape(p[1]).replace ( /\+/g, ' ' ));
            }
        }
        return obj;
    };
})(jQuery);
;(function ($) {
    $("#esgis_ga_global_search").blur(function (e) {
        var $el = $(this);
        $el.val() === "" ? $el.removeClass("active") : $el.addClass("active");
    });
    var $mainCarousel = $("#main_carousel"),
        $entAllPosts = $("#ent_all_posts_content"),
        $entSpinner = $("#ent_spinner");

    if ($entAllPosts.length) {

        var $subsub = $entAllPosts.find('#subsubsub'),
            $selectEntries = $entAllPosts.find('#select-entries'),
            $postsTable = $entAllPosts.find('#posts-table'),
            $tableBody = $postsTable.find('tbody'),
            $thereis = $entAllPosts.find('#thereispost'),
            $postsTableWrapper = $entAllPosts.find('#posts-table-wrapper'),
            $pagination = $entAllPosts.find('#posts-table-pagination');

        buildSelectEntries(postsCount, $selectEntries);

        ajaxLoadPost(apiGetPosts);

        $selectEntries.on('change', function () {
            var limit = parseInt(this.value, 10),
                currentPage = parseInt($pagination.find('.active > a').text(), 10);
            var queryObj = {},
                apiUrl;

            if(isQueryString(apiGetPosts))
                queryObj = getQueryString(apiGetPosts);

            queryObj.page = currentPage;
            queryObj.limit = limit;

            apiUrl = createPostUrl(baseApiGetPostsUrl, queryObj);

            ajaxLoadPost(apiUrl);
        });
        $pagination.delegate("a", "click", function (e) {
            if(!$(this).hasClass('current'))
                ajaxLoadPost($(this).attr('href'));

            e.preventDefault();
            return false;
        });
        $subsub.delegate("a", "click", function (e) {
            var postsObj = $subsub.data('data-posts'),
                $this = $(this);

            if(!$this.parent().hasClass('active')){
                $subsub.find("li").removeClass('active');
                $this.parent().addClass('active');

                buildTableBody(postsObj[$this.attr('rel')], $tableBody);
            }

            e.preventDefault();
            return false;
        })
    }

    if ($mainCarousel.length) {
        $mainCarousel.owlCarousel({
            slideSpeed : 300,
            paginationSpeed : 400,
            singleItem:true,
            autoPlay: 6000,
            stopOnHover: true,
            transitionStyle : "fadeUp"
        });

        $("#main_carousel_controls").find("span").click(function(e){
            var direction = $(this).attr("class");
            if (direction === "left")
                $mainCarousel.trigger("owl.prev");
            else if (direction === "right")
                $mainCarousel.trigger("owl.next");
        });
    }


    $('.scrollable').slimScroll({
            height: 'auto',
            alwaysVisible: true,
            railVisible: true
        }
    );
    $('.ent-panel').click(function (e) {
        var a = $(e.target).closest('a');
        if(a.hasClass("panel-action-button")){
            if(a.attr("data-action") === "expand")
                expand($(this), a.find('i.material-icons'));
            return false;
        }
        return;
    });
    $('.esgis_ga_ent_sidebar').find('a[data-action="sub"]').click(function (e) {
        var el = $(this),
            parent = el.parent(),
            icon = el.find('i.icon-absolute');
        if (parent.hasClass('open')){
            parent.removeClass('open');
            icon.text('chevron_left');
        }else {
            parent.addClass('open');
            icon.text('expand_more');
        }
    });


    function expand(el, actionBtn){
        if(el.hasClass("expanded")){
            el.removeClass("expanded");
            actionBtn.text('expand_less')
        }else {
            el.addClass("expanded");
            actionBtn.text('expand_more');
        }
    }

    function buildSubsub(data, $subsub){
        var publics = [],
            trashes = [],
            pendings = [],
            drafts = [],
            postStatus;

        for(var i = 0; i < data.length; i++){
            postStatus = data[i].postStatus.toLowerCase();
            if(postStatus === "pending")
                pendings.push(data[i]);
            else if(postStatus === "public")
                publics.push(data[i]);
            else if(postStatus === "trash")
                trashes.push(data[i]);
            else if(postStatus === "draft")
                drafts.push(data[i]);
        }
        $subsub.empty();
        $subsub.append("<li class='active all'><a href='#' rel='all'>Tous ("+ data.length +")</a></li>");
        if(publics.length > 0)
            $subsub.append("<li class='public'><a href='#' rel='publics'>Publiques ("+ publics.length +")</a></li>");
        if(trashes.length > 0)
            $subsub.append("<li class='trash'><a href='#' rel='trashes'>Corbeilles ("+ trashes.length +")</a></li>");
        if(pendings.length > 0)
            $subsub.append("<li class='pending'><a href='#' rel='pendings'>En attente ("+ pendings.length +")</a></li>");
        if(drafts.length > 0)
            $subsub.append("<li class='draft'><a href='#' rel='drafts'>Brouillons ("+ drafts.length +")</a></li>");

        var posts = {
            publics: publics,
            trashes: trashes,
            pendings: pendings,
            drafts: drafts,
            all: data
        };

        $subsub.data('data-posts', posts);
    }

    function buildSelectEntries(length, $selectEntries){
        $selectEntries.empty();

        if(length <= 5)
            $selectEntries.append("<option value='"+ length +"'>"+ length +"</option>");
        else if(length <= 15) {
            $selectEntries
                .append("<option value='5'>5</option>");
            if(length <= 10)
                $selectEntries
                    .append("<option value='"+ length +"' selected='selected'>"+ length +"</option>");
            else {
                $selectEntries
                    .append("<option value='"+ length +"' selected='selected'>"+ length +"</option>");
            }
        }else if(length <= 30){
            $selectEntries
                .append("<option value='5'>5</option>")
                .append("<option value='10' selected='selected'>10</option>")
                .append("<option value='15'>15</option>")
                .append("<option value='"+ length +"'>"+ length +"</option>");
        }else if(length <= 50){
            $selectEntries
                .append("<option value='5'>5</option>")
                .append("<option value='10' selected='selected'>10</option>")
                .append("<option value='15'>15</option>")
                .append("<option value='30'>30</option>")
                .append("<option value='"+ length +"'>"+ length +"</option>");
        }else if(length <= 75){
            $selectEntries
                .append("<option value='5'>5</option>")
                .append("<option value='10' selected='selected'>10</option>")
                .append("<option value='15'>15</option>")
                .append("<option value='30'>30</option>")
                .append("<option value='50'>50</option>")
                .append("<option value='"+ length +"'>"+ length +"</option>");
        }
    }

    function buildTableBody(data, $tableBody){
        $tableBody.empty();
        for(var i = 0; i < data.length; i++){
            var tr = $('<tr id="post_'+ i +'"></tr>');
            var cats = "",
                keys = "",
                categories = data[i].categories,
                keywords = data[i].keywords,
                postTitle = data[i].postTitle == "" ? "(pas de titre)" : data[i].postTitle,
                postStatus = '';

            switch(data[i].postStatus.toLowerCase()){
                case "draft":
                    postStatus = '<span class="post-status"> - Brouillon</span>';
                    break;
                case "pending":
                    postStatus = '<span class="post-status"> - En attente de relecture</span>';
                    break;
                case "trash":
                    postStatus = '<span class="post-status"> - Corbeille</span>';
                    break;
            }

            for(var ii = 0; ii < categories.length; ii++){
                cats += '<a href="'+ basePost +'?category='+ categories[ii].slug +'">'+ categories[ii].name +'</a>';
                if(ii !== categories.length - 1)
                    cats += ', ';
            }
            for(var iii = 0; iii < keywords.length; iii++){
                keys += '<a href="'+ basePost +'?keyword='+ keywords[iii].slug +'">'+ keywords[iii].name +'</a>';
                if(iii !== keywords.length - 1)
                    keys += ', ';
            }
            tr
                .append('<td><input type="checkbox" id="post_check_'+ i +'"></td>')
                .append('<td><a href="'+ basePost +'edit/'+ data[i].id +'">'+ postTitle +'</a>'+ postStatus +
                    '<div class="row-actions mt-20" rel="'+ data[i].id +'"><div class="action-buttons">'+
                        '<a href="'+ basePost +'edit/'+ data[i].id +'" class="text-blue"><i class="material-icons">mode_edit</i></a>'+
                        '<a href="'+ basePost +'show/'+ data[i].id +'" class="text-golden"><i class="material-icons">launch</i></a>'+
                        '<a href="javascript:;" class="text-red delete"><i class="material-icons">delete</i></a>'+
                    '</div></div>'+
                '</td>')
                .append('<td><a href="'+ basePost +'?by_author='+ data[i].owner.id +'">'+ data[i].owner.displayname +'</a></td>')
                .append('<td>'+ cats +'</td>')
                .append('<td>'+ keys +'</td>')
                .append('<td class="text-center">--</td>')
                .append('<td class="text-center">'+ data[i].viewsCounter +'</td>')
                .append('<td><abbr title="'+ moment(data[i].updateDate).format('L HH:mm:ss') +'">'+ moment(data[i].updateDate).format('L') +'</abbr><br>Dernière modification</td>');

            $tableBody.append(tr);
        }
    }

    function buildPagination(data, $pagination){
        if(data.pages === 1){
            $pagination
                .empty()
                .append('<li class="disabled"><a href="'+ data._links.first.href +'" title="first">≪</a></li>')
                .append('<li class="active"><a class="current" href="'+ data._links.self.href +'" title="current">1</a></li>')
                .append('<li class="disabled"><a href="'+ data._links.last.href +'" title="first">≫</a></li>');

        }else if(data.pages > 1){
            $pagination
                .empty()
                .append('<li><a href="'+ data._links.first.href +'" title="first">≪</a></li>');

            for(var i = 1; i < data.pages + 1; i++){
                if(i === data.page - 1)
                    $pagination
                        .append('<li><a href="'+ data._links.prev.href +'" title="prev">'+ i +'</a></li>');

                else if(i === data.page)
                    $pagination
                        .append('<li class="active"><a class="current" href="'+ data._links.self.href +'" title="current">'+ i +'</a></li>');

                else if(i === data.page + 1 && i < data.pages)
                    $pagination
                        .append('<li><a href="'+ data._links.next.href +'" title="next">'+ i +'</a></li>');
            }

            $pagination
                .append('<li><a href="'+ data._links.last.href +'" title="last">≫</a></li>');
        }
    }

    function ajaxLoadPost(url){
        if($entSpinner.length)
            $entSpinner.removeClass("hide");

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function (data, status) {
                if($entSpinner.length) $entSpinner.addClass("hide");

                var postsObj = data._embedded.posts,
                    length = postsObj.length;

                if(length > 0){
                    $thereis.addClass('hide');

                    var posts = buildSubsub(postsObj, $subsub);
                    $postsTableWrapper.parent().find('header').removeClass('hide');
                    $postsTable.removeClass('hide');
                    buildTableBody(postsObj, $tableBody);
                    $("#posts-table-info").find('.select_entries').text(length);
                    $postsTableWrapper.parent().find('footer').removeClass('hide');
                    buildPagination(data, $pagination);

                }
            },
            error: function (result, status, error) {
                if($entSpinner.length) $entSpinner.addClass("hide");

                switch (result.status){
                    case 404:
                        $thereis.text(
                            "Le contenu demandé n'existe pas."
                        ).addClass('warning').removeClass('hide');
                        break;
                    default :
                        $thereis.text(
                            "Une erreur est survenue. Recharger la page ou consulter le webmaster."
                        ).addClass('danger').removeClass('hide');
                }
            }
        });
    }

    function isQueryString(string){
        if("string" !== typeof string)
            return false;
        return string.indexOf("?") !== -1;
    }

    function getQueryString(string){
        if("string" !== typeof string)
            return false;
        return $.unserialize(string.substring(string.indexOf("?") + 1));
    }

    function createPostUrl(url, queryObj){
        return url + "?" + $.param(queryObj);
    }
})(jQuery);
