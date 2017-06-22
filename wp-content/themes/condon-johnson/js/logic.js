console.log('loaded logic');
// /wp-content/themes/condon-johnson/images/
var markers = [];
var iconSvg = {
    path: 'M8.2,1.7c-3.7,0-6.7,3-6.7,6.7 c0,1.2,0.3,2.3,0.9,3.3l5.8,8.6l5.8-8.6c0.6-1,0.9-2.1,0.9-3.3C14.9,4.7,11.9,1.7,8.2,1.7z M8.2,10.6C7,10.6,6,9.6,6,8.4 c0-1.2,1-2.2,2.2-2.2c1.2,0,2.2,1,2.2,2.2C10.4,9.6,9.4,10.6,8.2,10.6z',
    strokeColor: '#F05023',
    strokeOpacity: 1,
    strokeWeight: 1.5,
    fillOpacity: 0,
    rotation: 0,
    scale: 1.0
};
var addMapMarkers = function(type, city) {

    if (typeof(window.infowindow) == 'undefined' && typeof(window.projectsMap) !== 'undefined') {
        window.infowindow = new google.maps.InfoWindow({
            content: 'test'
        });
    }
    jQuery.post('/wp-admin/admin-ajax.php', {
        action      : 'condonjohnson_ajax',
        ajaxAction  : 'getAllProjects',
        type        : type,
        city        : city
    }, function (res) {

        jQuery(markers).each(function (index, marker) {
            marker.setMap(null);
        });
        markers = [];

        jQuery(res.projects).each(function (index, project) {

            if (typeof(window.projectsMap) !== 'undefined') {
                var position = jQuery.parseJSON(project.position.replace(/[\s\\]+/g,'').replace(/[']+/g,'"'));
                var projectsMarker = new google.maps.Marker({
                    position : position,
                    map      : window.projectsMap,
                    //icon     : '/wp-content/themes/condon-johnson/images/map-marker.png',
                    icon     : iconSvg,
                    title    : project.name
                });
                projectsMarker.addListener('click', function() {
                    window.infowindow.setContent('<div style="width: 400px;">' +
                        '<h4 class="firstHeading">' + project.name + '</h4>' +
                        (project.photo ? '<img style="width: 150px; float: left; margin-right: 10px;" src="/wp-content/uploads/' + project.photo + '"/>':'') +
                        '<p>' + project.description + '</p>' +
                        '</div>');

                    window.infowindow.open(window.projectsMap, projectsMarker);
                });
                markers.push(projectsMarker);
            }

        });

        if (typeof(window.projectsMap) !== 'undefined') {
            var bounds = new google.maps.LatLngBounds();
            for (var i = 0; i < markers.length; i++) {
              bounds.extend(markers[i].getPosition());
            }
            window.projectsMap.fitBounds(bounds);
        }

    });
}
var getProjects = function (page, type, city) {

    /*if (typeof(window.infowindow) == 'undefined' && typeof(window.projectsMap) !== 'undefined') {
        window.infowindow = new google.maps.InfoWindow({
            content: 'test'
        });
    }*/

    jQuery.post('/wp-admin/admin-ajax.php', {
        action      : 'condonjohnson_ajax',
        ajaxAction  : 'getProjects',
        page        : page,
        type        : type,
        city        : city
    }, function (res) {

        //if (res.projects.length%parseInt(res.pageSize) == 1) {
        if (res.projects.length < parseInt(res.pageSize)) {
            jQuery('.load-more-projects').hide();
        } else {
            jQuery('.load-more-projects').show();
        }
        if (page == 1) {
            jQuery('.projects-list').html('');
        }

        // window.projectsMap.setZoom(4);
        // window.projectsMap.setCenter(new google.maps.LatLng(46.986399, -142.856798));

        jQuery(res.projects).each(function (index, project) {
            
            jQuery('.projects-list').append('' +
                '<a href="/projects-list/#project_' +  project.id + '">' +
                '<div class="col-md-4 col-sm-4 col-xs-6">' +
                '<div class="project project-1" style="height: 271px; background-image: url(/wp-content/uploads/' + project.photo + ');">' +
                '<div class="content animate-slow" style="height: 271px;">' +
                '<div class="title">' + project.name + '</div>' +
              //  '<p>' + project.description + '</p>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</a>');
			
        });

        if (type == -1) {
            jQuery('.filters-line').html('<b>All</b>');

        } else {
            jQuery('.filters-line').html('<a type="-1">All</a>');
        }
        jQuery('.filters-list').html('');
        jQuery(res.types).each(function (index, t) {
            if (t.id == type) {
                jQuery('.filters-line').append(' / <b>' + t.name + '</b>');
                jQuery('.filters-list').append('<li><b>' + t.name + '</b></li>');
            } else {
                jQuery('.filters-line').append(' / <a type="' + t.id + '">' + t.name + '</a>');
                jQuery('.filters-list').append('<li><a type="' + t.id + '">' + t.name + '</a></li>');
            }
        });

        jQuery('.filters-line a, .filters-list a').on('click', function (e) {
            e.preventDefault();
            currentPage = 1;
            currentType = jQuery(this).attr('type');
            currentCity = '';
            addMapMarkers(currentType, currentCity);
            getProjects(currentPage, currentType, currentCity);
        });

        jQuery('.cities-list').html('');
        jQuery(res.cities).each(function (index, c) {
            if (c.city == city) {
                jQuery('.cities-list').append('<li><b>' + c.city + '</b></li>');
            } else {
                jQuery('.cities-list').append('<li><a city="' + c.city + '">' + c.city + '</a></li>');
            }
        });

        jQuery('.cities-list a').on('click', function (e) {
            e.preventDefault();
            currentPage = 1;
            currentCity = jQuery(this).attr('city');
            addMapMarkers(currentType, currentCity);
            getProjects(currentPage, currentType, currentCity);
        });
    });
}
var currentPage = 1;
var currentType = -1;
var currentCity = '';



