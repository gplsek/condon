<div class="collapse navbar-collapse" id="top-nav-menu">
    <div class="navbar">
        <ul class="nav navbar-nav">
            <li><a href="/about-us" class="<?= (( in_array(basename(get_permalink()), ['about-us', 'about-person']) )?'active':'')?>" >About Us</a></li>
            <!--<li><a href="/services" class="<?/*= ((basename(get_permalink()) == 'services')?'active':'')*/?>" >Services</a></li>-->
            <li class="dropdown">
                <a href="#" class="<?= ((basename(get_permalink()) == 'services')?'active':'')?>">Services</a>
                <ul class="dropdown-menu">
                    <li><a href="/deep-foundation/">Deep Foundation</a></li>
                    <li><a href="/earth-retention/">Earth Retention</a></li>
                    <li><a href="/ground-improvement/">Ground Improvement</a></li>
                    <li><a href="/dewatering/">Dewatering</a></li>
                </ul>
            </li>

            <li><a href="/projects" class="<?= ((in_array(basename(get_permalink()), ['projects', 'projects-list']))?'active':'')?>" >Projects</a></li>
            <li><a href="/publications" class="<?= ((basename(get_permalink()) == 'publications')?'active':'')?>" >Publications</a></li>
            <li><a href="/careers" class="<?= ((basename(get_permalink()) == 'careers')?'active':'')?>" >Careers</a></li>
            <li><a href="/contact" class="<?= ((basename(get_permalink()) == 'contact')?'active':'')?>" >Contact</a></li>
            <!--<li><a href="/search" class="<?/*= ((basename(get_permalink()) == 'search')?'active':'')*/?>" ><i class="glyphicon glyphicon-search"></i></a></li>-->
            <li>
                <a href="/search" id="search-modal-button" class="<?= ((basename(get_permalink()) == 'search')?'active':'')?>"><i class="glyphicon glyphicon-search"></i></a>
                <div class="search-modal-wrapper">
                    <div id="search-modal-form" class="search-modal-content">
                        <div class="search-form">
                            <form id="searchform2" role="search" method="get" action="/search">
                                <input name="s" type="text" placeholder="Write search text..." class="search-input">
                                <button type="submit" class="search-button animate-slow"><i class="glyphicon glyphicon-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#search-modal-button').off('click');
        $('#search-modal-button').on('click', function() {
            // $('#search-modal-form').toggleClass('active');
            if ($('#search-modal-form:visible').length > 0) {
              $('#search-modal-form').hide();
            } else {
              $('#search-modal-form').show();
            }
            return false;
        });
        $('#searchform2').submit(function (e) {
            e.preventDefault();
            $.cookie('s', $('#searchform2').find('input[name="s"]').val(), { path: '/search/' });
            location = '/search';
        });
    });
</script>