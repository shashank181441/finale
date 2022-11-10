// get reference of elements
map = document.getElementById('map');
confirm_position_btn = document.getElementById('confirm-position');
idle_position = document.getElementById('idle-position');
confirm_position = document.getElementById('confirmed-position');

// initialize location picker plugin
let ip = new locationPicker(map, {
    setCurrentPosition: true,
    // lat: 27.6713817,
    // lng: 85.3365496
}, {
    zoom: 15
})

// onbutton click
confirm_position_btn.onclick = function() {
    let location = ip.getMarkerPosition();
    confirm_position.innerHTML = location.lat + "," + location.lng;
    document.getElementById("lat").value = location.lat;
    document.getElementById("long").value = location.lng;
}

// show coords when user interact with map
google.maps.event.addListener(ip.map, 'idle', function(event) {
    let location = ip.getMarkerPosition();
    idle_position.innerHTML = "Lattitude: " + location.lat + " Longitude: " + location.lng;

    document.cookie = "latt = " + location.lat;
    document.cookie = "long = " + location.lng;
})