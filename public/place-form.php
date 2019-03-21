

<?php require_once('../private/init.php'); ?>

<?php
$errors = Session::get_temp_session(new Errors());
$message = Session::get_temp_session(new Message());
$admin = Session::get_session(new Admin());

if(empty($admin)){
    Helper::redirect_to("login.php");
}else{
    $place_id = isset($_GET['id']) ? $_GET['id'] : '';
    $all_places = new Place();

    // Items for Edit
    $place = (isset($place_id) && !empty($place_id)) ? $all_places->where(["id" => $place_id])->one() : '';
    $image = (!empty($place) && !empty($place->itm_img_id)) ? Place::imageName($place->itm_img_id) : "default_pic.png";
    $image_path = "/public/tripeasy_images/" . $image;
    $place_title = (!empty($place) && !empty($place->place_title)) ? $place->place_title : "";
    $place_description = (!empty($place) && !empty($place->description)) ? $place->description : "";
    $place_latitude = (!empty($place) && !empty($place->latitude)) ? $place->latitude : "";
    $place_longitude = (!empty($place) && !empty($place->longitude)) ? $place->longitude : "";
    $place_address = (!empty($place) && !empty($place->address)) ? $place->address : "";
    $featured = (!empty($place) && !empty($place->featured) && $place->featured > 0) ? "checked" : '';

    $action = "../private/controllers/placeController.php";
    $action = !empty($place_id) ? $action . "?id=" . $place_id : $action;

}


?>




<?php require("common/php/php-head.php"); ?>

<body>

<?php require("common/php/header.php"); ?>

<div class="main-container">

    <?php require("common/php/sidebar.php"); ?>

    <div class="main-content">

        <div class="form-wrapper">
            <div class="form-content">

                <h4 class="m-title">Create Place</h4>
                <div class="form-inner">
                    <div class="form-inner">

                        <!--form section start-->
                        <form action="<?=$action?>" method="post" enctype="multipart/form-data">
                            <!--search place-->
                            <div class="pos-relative">
                                <input id="pac-input" class="controls" type="text" placeholder="Search Place">
                                <div id="mapMoveHere"></div>
                            </div>

                            <div id="map"></div>

                            <!--Uploaded Image-->
                            <div>
                                <img id="uploaded-image" src="<?=$image_path?>"/>
                            </div>

                            <!-- Place Image -->
                            <div class="form-group field-place_img required">
                                <label class="control-label" for="place_img">Image Upload</label>
                                <!--<input type="hidden" name="Uploadimages[image_upload]" value="">-->
                                <input type="file" id="place_img" class="upload-img image-input" name="place_image" accept="image/jpg,image/png,image/jpeg,image/gif" >

                            </div>

                            <!-- Place Title -->
                            <div class="form-group field-place-place_title required">
                                <label class="control-label" for="place-place_title">Place Title</label>
                                <input type="text" id="place-place_title" class="form-control" name="place_title" placeholder="eg. W3 Engineers Ltd." value="<?=$place_title?>" required />
                            </div>

                            <!-- Description -->
                            <div class="form-group field-place-description required">
                                <label class="control-label" for="place-description">Description</label>
                                <textarea id="place-description" class="form-control" name="place_description" rows="4" placeholder="Description"  aria-required="true"><?=$place_description?></textarea>
                            </div>

                            <!-- Latitude and Longitude -->
                            <div class="oflow-hidden">
                                <div class="input-6 pr-7-5">
                                    <div class="form-group field-lat required">
                                        <label class="control-label" for="lat">Latitude</label>
                                        <input type="text" id="lat" class="form-control" name="place_latitude" placeholder="eg. 89.55251195" value="<?=$place_latitude?>" required />
                                    </div>
                                </div>
                                <div class="input-6 pl-7-5">
                                    <div class="form-group field-long required">
                                        <label class="control-label" for="long">Longitude</label>
                                        <input type="text" id="long" class="form-control" name="place_longitude" placeholder="eg. 89.55251195" value="<?=$place_longitude?>" required />
                                    </div>
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="form-group field-address">
                                <label class="control-label" for="address">Address</label>
                                <input type="text" id="address" class="form-control" name="place_address" maxlength="255" placeholder="eg. Tayamun Centre, Upper Jessore Road, Khulna 9100, Bangladesh" value="<?=$place_address?>">
                            </div>

                            <!-- Featured -->
                            <h5 class="mtb-30 oflow-hidden">
                                <label class="switch mr-15">
                                    <input type="checkbox" name="featured" <?=$featured?> />
                                    <span class="slider round"></span>
                                </label>
                                <span class="toggle-title">Featured</span>
                            </h5>

                            <?php
                            if (!empty($place_id)) {
                                $multipleImages = place::multiple_img($place->id);

                                foreach ($multipleImages as $img) {
                                    if($img->id != $place->itm_img_id){
                                        echo $img->image;
                                        $image_url = '/public/tripeasy_images/' . $img->image;
                                        echo '<img src=" '. $image_url.'" alt="image" class="upload_form_img"/>';
                                    }
                                }
                            }
                            ?>

                            <div class="gallery"></div>

                            <!--Choose file-->
                            <div class="form-group field-gallery-photo-add">
                                <label class="control-label" for="gallery-photo-add">Files</label>
                                <input type="file" id="gallery-photo-add" name="files[]" multiple>
                            </div>

                            <button type="submit" id="sb_btn" class="c-btn  mb-10"><b>Save</b></button>


                        </form>

                    </div><!--form-inner-->
                </div><!--form-inner-->
            </div><!--form-content-->
        </div><!--form-wrapper-->

    </div><!--main-content-->
</div><!--main-container-->


<?php require("common/php/php-footer.php"); ?>


<script>


    function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -33.8688, lng: 151.2195},
            zoom: 13,
            mapTypeId: 'roadmap'
        });

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function () {
            searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function () {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }

            // Clear out the old markers.
            markers.forEach(function (marker) {
                marker.setMap(null);
            });
            markers = [];

            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function (place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                var icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };

                // Create a marker for each place.
                markers.push(new google.maps.Marker({
                    map: map,
                    icon: icon,
                    title: place.name,
                    position: place.geometry.location
                }));

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }

                var lat = (place.geometry.viewport.fa.j + place.geometry.viewport.fa.l) / 2;
                var long = (place.geometry.viewport.ma.j + place.geometry.viewport.ma.l) / 2;

                $('#name').val(place.name)
                $('#address').val(place.formatted_address)
                $('#lat').val(lat)
                $('#long').val(long)


            });
            map.fitBounds(bounds);
        });
    }


</script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCyuiMtMoOGbA11BoUsIb-uRZNqe7zdZq8&callback=initAutocomplete" async defer></script>

<script>

    function changeUploadedImage(e) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#uploaded-image').attr('src', e.target.result);
        };
        reader.readAsDataURL(e.target.files[0]);
    }

    function validateImage(input, e) {
        var imageName = $(input).val(),
            extension = imageName.substring(imageName.lastIndexOf('.') + 1).toLowerCase();

        if (extension == 'jpg' || extension == 'png' || extension == 'jpeg' || extension == 'gif') {
            changeUploadedImage(e);
        } else {
            //changeUploadedImage(e);
            $(input).val("");
            alert("Invalid Image file.");
        }
    }

    $(function () {

        $('.image-input').on('change', function (e) {
            validateImage($(this), e);
        });
    });
    // Multiple images preview in browser
    $(function () {
        // Multiple images preview in browser
        var imagesPreview = function (input, placeToInsertImagePreview) {

            if (input.files) {
                var filesAmount = input.files.length;

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function (event) {
                        $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }

        };

        $('#gallery-photo-add').on('change', function () {
            imagesPreview(this, 'div.gallery');
        });
    });

</script>














