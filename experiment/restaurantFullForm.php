<?php
// session_start();
$cust_email = $_GET["email"];
echo $cust_email;
$rest_name =$_GET["rest_name"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Restaurants form</title>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5Jrp9PtHe0WapppUzxbIpMDWMAcV3qE4"></script>
    <!-- include location Picker package -->
    <script src="https://unpkg.com/location-picker/dist/location-picker.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->

</head>

<body>
    <!-- nav bar -->
    <?php require 'nav/nav.php' ?>

    <div style="width: auto; height: 80px;"></div>

    <!-- form of restaurant -->
    <div class="container border border-primary">
        <h1 class="display-3">Display 1</h1>
        <p>Please fill up your details.</p>
        <hr>

        <form action="backend/restaurantFullFormphp.php" method="post" enctype="multipart/form-data" novalidate>
            <div class="row row-cols-1  row-cols-lg-2 row-cols-md-2 gy-2">

            <div class="col">
                    <div class="form-floating">
                        <input type="text" id="cust_name" name="cust_name" class="form-control" placeholder="name" required>
                        <label for="name">Your Name</label>
                    </div>
                </div>
                <input type="email" name="email" value="<?php echo $cust_email?>" >
                <div class="col">
                    <div class="form-floating">
                        <input type="email" id="cust_email" name="rest_name" class="form-control" placeholder="name" value="<?php echo $rest_name?>" required>
                        <label for="name">Your Restaurant's Name</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating">
                        <input type="file" onchange="readURL(this)" accept="Image/" id="logo" name="uploadfile" class="file-upload-input form-control" placeholder="logo" required>
                        <label for="name">Company Logo</label>
                    </div>
                </div>

                <div class="form-floating">
                    <input type="textarea" id="details" name="details" class="form-control" placeholder="name" required>
                    <label for="name"> &nbsp Details</label>
                </div><br>
            </div>
            Lattitude<input type="text" id="lat" name="lat" required>
            Longitude<input type="text" id="long" name="long" required>
            <br>


            <div class="text-center my-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#messageModal" data-bs-whatever="@getstrap">Locate your restaurant</button>
        </div>
            <button class="position-relative bottom-0 start-50 translate-middle-x px-4 py-2 mb-3 mt-2 btn btn-info" type="submit" name="rest_bt">Send Message</button>
        </form>

        <!-- map and location slector -->

        

        <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="map" style="height: 450px; width: 450px;" id="map"></div>
                        <div class="show-details">
                            <button class="confirm-position" id="confirm-position">Confirm Position</button>
                            <p>Your Idle Position is: <span id="idle-position"></span></p>
                            <p>Your confirmed Position is: <span id="confirmed-position"></span></p>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>


    <!-- include JS file -->
    <script src="js/main.js"></script>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary text-center" data-bs-dismiss="modal">Close</button>

    </div>
    </div>
    </div>
    </div>

    </div>
    </div>
    </div>




    <?php require 'footer.php' ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        const form = document.querySelector("form")

        form.addEventListener('submit', e => {
            if (!form.checkValidity()) {
                e.preventDefault();
            }

            form.classList.add('was-validated')
        })
    </script>
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
    </div>
</body>

</html>