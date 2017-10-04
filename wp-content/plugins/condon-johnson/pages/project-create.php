<script type="text/javascript"><?= ((!empty($redirect))?'window.location.href = "'.$redirect.'"':'')?></script>




<div class="wrap">
    <h1><?= ((empty($project))?'New project':$project['name']) ?></h1>
    <form id="formProject" name="project" enctype="multipart/form-data" method="post" autocomplete="off">

        <input type="hidden" name="id" value="<?= ((empty($project))?'':$project['id']) ?>">

        <div class="tool-box">
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="name">Name</label>
                    </th>
                    <td>
                        <input style="width: 100%;" name="name" type="text" value="<?= ((empty($project))?'':$project['name']) ?>" maxlength="225" size="30" required/>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="type">Type</label>
                    </th>
                    <td>
                        <select style="width: 100%;" name="type" required>
                            <?php foreach ($types_project as $type_project) {?>
                              <option <?= ((empty($project))?'':(($project['type'] == $type_project['id'])?' selected="selected" ':'')) ?> value="<?= $type_project['id'] ?>"><?= $type_project['name'] ?></option>
                            <?php }?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="description">Description</label>
                    </th>
                    <td>
                        <textarea style="width: 100%;" rows="3" cols="45" name="description"><?= ((empty($project))?'':$project['description']) ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="photo">Photo</label>
                    </th>
                    <td>
                        <?php foreach ($photos as $photo) {?>
                           <div style="display: inline-block;">
                               <a class="photo-delete" style="position: absolute; padding: 5px; background-color: white; opacity: 0.7;" href="#" photoId="<?= $photo['id'] ?>">Delete</a>
                               <img src="/wp-content/uploads/<?= $photo['photo'] ?>" style="height: 100px; margin-right: 5px;"/>
                           </div>
                        <?php } ?>
                        <br/>
                        <!--<img src="/wp-content/uploads/<?/*= !empty($project)?$project['photo']:'' */?>" style="height: 100px;"/><br/>-->
                        <input style="width: 100%;" type="file" name="photo[]" multiple="multiple" value="<?= ((empty($project))?'':$project['photo']) ?>">
                        <!--<input name="photo" type="text" value="<?/*= ((empty($project))?'':$project['photo']) */?>" maxlength="225" size="30" required />
                        <input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="Upload Image">-->
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="adress">Address</label>
                    </th>
                    <td>
                        <input name="city" type="hidden" value="<?= (!empty($project)?$project['city']:'') ?>"/>
                        <input name="position" type="hidden" value="<?= stripcslashes(!empty($project)?$project['position']:'') ?>"/>
                        <input id="autocomplete" placeholder="Please enter address for project" style="width: 100%;" name="adress" type="text" value="<?= ((empty($project))?'':$project['adress']) ?>" maxlength="225" size="30" required/>
                        <div id="map" style="width: 100%; height: 400px; border: rgba(118, 130, 34, 0.48) solid 1px;"></div>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="name">Order</label>
                    </th>
                    <td>
                        <input style="width: 100%;" name="feature" type="number" min="0" step="1" value="<?= ((empty($project))?'':$project['feature']) ?>" maxlength="225" size="30"/>
                    </td>
                </tr>
            </table>
        </div>
        <!--<input type="submit" style="display: none;">-->
        <?php
        submit_button();
        ?>
    </form>
</div>

<script type="text/javascript">
    jQuery(document).ready(function () {

        window.loadedGoogleMapApi = false;
        var initGoogleMap = function (mapID, onOk, noUserPosition) {
            if (typeof(mapID) !== 'string' || mapID == '') {
                mapID = 'map';
            }
            window.initMapGoogle = function () {
               // console.log(window[mapID]);
                window[mapID] = null;
                delete window[mapID];
                window[mapID] = new google.maps.Map(jQuery('#' + mapID)[0]/*document.getElementById(mapID)*/, {
                        center: {lat: -33.8688, lng: 151.2195},
                        zoom: 17,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                });
                if (typeof(onOk) == 'function') {
                  onOk();
                }
            }
            if (window.loadedGoogleMapApi == false) {
                var script = document.createElement('script');
                script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyCnm5s8fcWZvVbIEbPyM5RWIyqbb0EAe3w&libraries=places&signed_in=true&callback=initMapGoogle&language=en";
                document.body.appendChild(script);
                window.loadedGoogleMapApi = true;
            } else {
                setTimeout(function () {
                    window.initMapGoogle();
                }, 1000);
            }
        }

        initGoogleMap('map', function () {
            centerPointer = new google.maps.Marker({
                map       : window.map,
                position  : window.map.getCenter(),
              //  draggable : true,
                title     : "Address for project"
            });

            autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
                {types: ['geocode']});

            var p = jQuery('input[name="position"]').val();
            if (p !== '') {
              p = p.replace(/'/g, '"');
              p = jQuery.parseJSON(p);
              window.map.setCenter(new google.maps.LatLng(p.lat, p.lng));
              centerPointer.setPosition(new google.maps.LatLng(p.lat, p.lng));
            } else {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var geolocation = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        var circle = new google.maps.Circle({
                            center: geolocation,
                            radius: position.coords.accuracy
                        });
                        autocomplete.setBounds(circle.getBounds());
                        window.map.setCenter(new google.maps.LatLng(geolocation.lat, geolocation.lng));
                        centerPointer.setPosition(new google.maps.LatLng(geolocation.lat, geolocation.lng));
                    });
                }
            }

            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();
                var p = JSON.stringify({
                  lat: place.geometry.location.lat(),
                  lng: place.geometry.location.lng()
                });
                jQuery('input[name="position"]').val(p);
                window.map.setCenter(new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng()));
                centerPointer.setPosition(new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng()));
                for (var i = 0; i < place.address_components.length; i++) {
                    var addressType = place.address_components[i].types[0];
                    if (addressType == 'locality') {
                        var val = place.address_components[i].long_name;
                        //console.log(val);
                        jQuery('input[name="city"]').val(val);
                    }
                }
                window.allow_submit = true;
            });
        });

        window.allow_submit = true;
        jQuery('#autocomplete').on('focus', function () {
          window.allow_submit = false;
        });
        jQuery('#autocomplete').on('blur', function () {
          window.allow_submit = true;
        });
        jQuery('form[name="project"] input[name="submit"]').on('click', function (e) {
           if (window.allow_submit == false) {
              e.preventDefault();
           }
        });

        jQuery('.photo-delete').on('click', function (e) {
            e.preventDefault();
            if (confirm('Are you sure?')) {
              //jQuery(this).parent().remove();
              var self = this;
              jQuery.post('/wp-admin/admin-ajax.php', {
                    action      : 'condonjohnson_ajax',
                    ajaxAction  : 'deleteProjectPhoto',
                    photoId     : jQuery(this).attr('photoId')
              }, function (res) {
                console.log(res);
                if (res.ok) {
                  jQuery(self).parent().remove();
                }

              });
            }
        });


    });
</script>