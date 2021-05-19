<script>
    (function() {
        function cleanup_address_bar() {
            try {
                var url = location.href
                    .replace(/&<?php echo WPHYPERSPEED_SLUG; ?>=[0-9]+/, '')
                    .replace(/\?<?php echo WPHYPERSPEED_SLUG; ?>=[0-9]+&/, '?')
                    .replace(/\?<?php echo WPHYPERSPEED_SLUG; ?>=[0-9]+/, '');
                window.history.replaceState('object', document.title, url);
            } catch (e) {
            }
        }

        function get_cookie(r) {
            function value(e) {
                0 === e.indexOf('"') && (e = e.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, "\\"));
                try {
                    return e = decodeURIComponent(e.replace(/\+/g, " ")), e
                } catch (e) {
                }
            }

            var p = r ? void 0 : {},
                s = document.cookie ? document.cookie.split("; ") : [];
            for (var m = 0; m < s.length; m++) {
                var v = s[m].split("="),
                    k = decodeURIComponent(v.shift()),
                    l = v.join("=");
                if (r && r === k) {
                    p = value(l);
                    break
                }
                r || void 0 === (l = value(l)) || (p[k] = l)
            }
            return p
        }

        function is_woocommerce(){
            return !!document.querySelector('meta[name="generator"][content~="WooCommerce"]');
        }

        function is_woocommerce_protected(link){
            //don't cache cart related stuff
            if (!!link.pathname.match(/\/(cart|checkout|my-account)/)) {
                return true;
            }
            //don't cache add-to-cart links
            return !!link.search.match(/add-to-cart/);
        }

        function is_headless(){
            try {
                var user_agent = navigator.userAgent;
                if (!!user_agent.match(/Google Page Speed Insights/)){
                    return true;
                }
                if (!!user_agent.match(/Linux x86_64/)){
                    return true;
                }
            }catch(e){}
            return false;
        }

        function is_file_link(link){
            try{
                var parts = link.pathname.split('/').pop().split('.');
                if( parts.length > 1){
                    var extension = parts[parts.length-1].toLowerCase();
                    var allowed = ['php', 'php5', 'php4', 'html', 'htm'];
                    if(extension.length > 0 && allowed.indexOf(extension) == -1){
                        return true;
                    }
                }
            }catch (e){}
            return false;
        }

        function is_anchor_link(link) {
            try{
                return link.getAttribute('href').startsWith('#');
            }catch(e){
                return false;
            }

        }

        function is_permitted_host(link){
            return is_permitted_host.hosts.indexOf(link.host) >= 0;
        }
        is_permitted_host.hosts = <?php echo json_encode($domains); ?>;

        function is_error(link){
            return is_error.cache.indexOf(get_prefetch_url(link)) >= 0;
        }
        is_error.cache = [];
        try{
            is_error.cache = JSON.parse(sessionStorage.getItem('<?php echo WPHYPERSPEED_SLUG; ?>_error')) || [];
        }catch(e){}

        function add_error(url){
            try{
                is_error.cache.push(url);
                sessionStorage.setItem('<?php echo WPHYPERSPEED_SLUG; ?>_error', JSON.stringify(is_error.cache));
            }catch(e){}
        }

        function is_prefetchable(link){
            if(link.getAttribute('href') == null){
                return false;
            }
            if(is_file_link(link) || is_anchor_link(link) || is_error(link)){
                return false;
            }

            if(is_woocommerce() && is_woocommerce_protected(link)){
                return false;
            }

            <?php if(!empty($settings->ignore_regex)): ?>
            if(!!(link.pathname + link.search + link.hash).match(<?php echo json_encode($settings->ignore_regex); ?>)){
                return false;
            }
            <?php endif; ?>

            var ignored_path_prefixes = <?php echo json_encode($this->cleanup_lines($settings->ignore)); ?>;
            for(var i in ignored_path_prefixes){
                var ignored_path_prefix = ignored_path_prefixes[i];
                if(link.pathname.startsWith(ignored_path_prefix)){
                    return
                }
            }

            return is_permitted_host(link);
        }

        function get_cache_version(){
            return get_cookie('<?php echo WPHYPERSPEED_SLUG; ?>');
        }

        function get_prefetch_url(link){
            var copy = link.cloneNode(false);
            //remove any old hyperspeed query
            var search = copy.search.replace(/<?php echo WPHYPERSPEED_SLUG; ?>=[0-9]+&?/, '');

            //add our 'new' query...
            search += (search.length > 1 ? '&' : '') + '<?php echo WPHYPERSPEED_SLUG; ?>=' + get_cache_version();
            copy.search = search;

            return copy.href.split('#')[0];
        }

        function update_progress(){
            try{
                NProgress.set( (prefetch.loaded + prefetch.errored) / prefetch.cache.length);
            }catch(e) {}
        }

        function onload(e){
            prefetch.loaded++;
            update_progress();
            e.target.parentNode.removeChild(e.target);
        }

        function onerror(e){
            add_error(e.target.href);
            prefetch.errored++;
            update_progress();
            e.target.parentNode.removeChild(e.target);
        }

        function click(e){
            var link = e.target.closest('a');

            if(!is_prefetchable(link)){
                return;
            }
            var search = link.search.replace(/<?php echo WPHYPERSPEED_SLUG; ?>=[0-9]+&?/, '');
            search += (search.length > 1 ? '&' : '') + '<?php echo WPHYPERSPEED_SLUG; ?>=' + get_cache_version();
            link.search = search;
        }

        function prefetch(link){
            link.addEventListener('click', click);
            link.setAttribute('hyperspeed-configured', 'true');

            var url = get_prefetch_url(link);

            if (prefetch.cache.indexOf(url) > -1) {
                return;
            }

            prefetch.cache.push(url);
            var temp = document.createElement('link');
            temp.rel = 'prefetch';
            temp.href = url;
            temp.addEventListener('error', onerror);
            temp.addEventListener('load', onload);
            document.head.appendChild(temp);
        }
        prefetch.cache = [];
        prefetch.loaded = 0;
        prefetch.errored = 0;

        function refresh_cookie(){
            if(!get_cookie('<?php echo WPHYPERSPEED_SLUG; ?>_refresh')){
                if(!refresh_cookie.element) {
                    refresh_cookie.element = document.createElement('img');
                    refresh_cookie.element.style.display = 'none';
                    refresh_cookie.element.style.position = 'fixed';
                    refresh_cookie.element.style.width = '0';
                    refresh_cookie.element.style.height = '0';
                    document.body.appendChild(refresh_cookie.element);
                    refresh_cookie.element.addEventListener('load', function(){
                        if(!!get_cookie('<?php echo WPHYPERSPEED_SLUG; ?>')) {
                            wphyperspeed.start();
                        }
                    })
                }

                var temp = document.createElement('a');
                temp.href = window.location;
                var random = Math.floor((Math.random() * 100000000000) + 1);
                temp.search = '<?php echo WPHYPERSPEED_SLUG; ?>=refresh' + '?r=' + random;
                refresh_cookie.element.src = temp.href;
            }
        }
        refresh_cookie.element = false;

        function wphyperspeed(){
            var cookie = get_cookie('<?php echo WPHYPERSPEED_SLUG; ?>');
            if(!cookie){
                return;
            }
            if(cookie == 'disable'){
                return;
            }
            var links = document.querySelectorAll('a:not([hyperspeed-configured])');
            for(var i = 0; i < links.length; i++){
                var link = links[i];
                if(is_prefetchable(link)) {
                    prefetch(link);
                }else{
                    link.setAttribute('hyperspeed-configured', 'false');
                }
            }
        }
        wphyperspeed.running = false;
        wphyperspeed.start = function(){
            if(!wphyperspeed.running) {
                wphyperspeed();
                wphyperspeed.interval = setInterval(wphyperspeed, 2000);
                wphyperspeed.running = true;
            }
        };
        wphyperspeed.stop = function(){
            if(wphyperspeed.running) {
                clearInterval(wphyperspeed.interval);
            }
            wphyperspeed.running = false;
        };

        function init(){
            if(is_headless()){
                return;
            }

            if(!!get_cookie('<?php echo WPHYPERSPEED_SLUG; ?>_cleanup_address_bar')){
                cleanup_address_bar();
            }

            setTimeout(refresh_cookie, 60*1000);
            if(!!get_cookie('<?php echo WPHYPERSPEED_SLUG; ?>')) {
                wphyperspeed.start();
            }else{
                refresh_cookie();
            }
        }
        init.enabled = false;
        init();
    })();
</script>