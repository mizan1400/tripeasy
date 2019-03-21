

<?php require_once('../private/init.php'); ?>

<?php
$errors = Session::get_temp_session(new Errors());
$message = Session::get_temp_session(new Message());
$admin = Session::get_session(new Admin());

if(empty($admin)){
    Helper::redirect_to("login.php");
}else{
    $restaurant_id = isset($_GET['id']) ? $_GET['id'] : '';
    $all_restaurant_details = new Restaurant_details();

    // Items for Edit
    $restaurant_detail = (isset($restaurant_id) && !empty($restaurant_id)) ? $all_restaurant_details->where(["id" => $restaurant_id])->one() : '';
    $image = (!empty($restaurant_detail) && !empty($restaurant_detail->itm_img_id)) ? Restaurant_details::imageName($restaurant_detail->itm_img_id) : "default_pic.png";
    $image_path = "/public/tripeasy_images/" . $image;
    $restaurant_title = (!empty($restaurant_detail) && !empty($restaurant_detail->title)) ? $restaurant_detail->title : "";
    $restaurant_description = (!empty($restaurant_detail) && !empty($restaurant_detail->description)) ? $restaurant_detail->description : "";
    $restaurant_latitude = (!empty($restaurant_detail) && !empty($restaurant_detail->latitude)) ? $restaurant_detail->latitude : "";
    $restaurant_longitude = (!empty($restaurant_detail) && !empty($restaurant_detail->longitude)) ? $restaurant_detail->longitude : "";
    $restaurant_address = (!empty($restaurant_detail) && !empty($restaurant_detail->address)) ? $restaurant_detail->address : "";
    $restaurant_category = (!empty($restaurant_detail) && !empty($restaurant_detail->category)) ? $restaurant_detail->category : "";
    $restaurant_timing = (!empty($restaurant_detail) && !empty($restaurant_detail->timing)) ? $restaurant_detail->timing : "";

    $action = "../private/controllers/restaurantDetailController.php";
    $action = !empty($restaurant_id) ? $action . "?id=" . $restaurant_id : $action;

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

                <h4 class="m-title">Create Restaurant</h4>
                <div class="form-inner">
                    <div class="form-inner">

                        <!--form section start-->
                        <form action="<?=$action?>" method="post" enctype="multipart/form-data">
                            <!--search Restaurant-->
                            <div class="pos-relative">
                                <input id="pac-input" class="controls" type="text" placeholder="Search Restaurant">
                                <div id="mapMoveHere"></div>
                            </div>

                            <div id="map"></div>

                            <!--Uploaded Image-->
                            <div>
                                <img id="uploaded-image" src="<?=$image_path?>"/>
                            </div>

                            <!-- Restaurant Image -->
                            <div class="form-group field-place_img required">
                                <label class="control-label" for="place_img">Image Upload</label>
                                <!--<input type="hidden" name="Uploadimages[image_upload]" value="">-->
                                <input type="file" id="place_img" class="upload-img image-input" name="item_image" accept="image/jpg,image/png,image/jpeg,image/gif" >

                            </div>

                            <!-- Restaurant Title -->
                            <div class="form-group field-place-place_title required">
                                <label class="control-label" for="place-place_title">Restaurant Title</label>
                                <input type="text" id="place-place_title" class="form-control" name="title" placeholder="eg. W3 Engineers Ltd." value="<?=$restaurant_title?>" required />
                            </div>

                            <!-- Restaurant Category -->
                            <div class="form-group field-place-place_title">
                                <label class="control-label" for="place-place_title">Restaurant Category</label>
                                <input type="text" id="place-place_category" class="form-control" name="category" placeholder="eg. W3 Engineers Ltd." value="<?=$restaurant_category?>" required />
                            </div>

                            <!-- Description -->
                            <div class="form-group field-place-description required">
                                <label class="control-label" for="place-description">Description</label>
                                <textarea id="place-description" class="form-control" name="description" rows="4" placeholder="Description"  aria-required="true"><?=$restaurant_description?></textarea>
                            </div>

                            <!-- Latitude and Longitude -->
                            <div class="oflow-hidden">
                                <div class="input-6 pr-7-5">
                                    <div class="form-group field-lat required">
                                        <label class="control-label" for="lat">Latitude</label>
                                        <input type="text" id="lat" class="form-control" name="latitude" placeholder="eg. 89.55251195" value="<?=$restaurant_latitude?>" required />
                                    </div>
                                </div>
                                <div class="input-6 pl-7-5">
                                    <div class="form-group field-long required">
                                        <label class="control-label" for="long">Longitude</label>
                                        <input type="text" id="long" class="form-control" name="longitude" placeholder="eg. 89.55251195" value="<?=$restaurant_longitude?>" required />
                                    </div>
                                </div>
                            </div>

                            <!-- Opening Time -->
                            <div class="form-group field-address">
                                <label class="control-label" for="opening_time">Opening Time</label>
                                <input type="text" id="opening_time" class="form-control" name="timing" maxlength="255" placeholder="eg. 10:00Am - 08:00Pm" value="<?=$restaurant_timing?>">
                            </div>


                            <?php
                            if (!empty($restaurant_id)) {
                                $multipleImages = Restaurant_details::multiple_img($restaurant_detail->id);

                                foreach ($multipleImages as $img) {
                                    if($img->id != $restaurant_detail->itm_img_id && $img->type == 3){
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














