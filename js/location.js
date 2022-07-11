function initMap(destinationLat, destinationLong) {
    //console.log("Test map "+destinationLat+":"+destinationLong);
    if(destinationLat!==undefined){
        var allOfDistance = "";
        var originLat = document.getElementById("hdn_lttd").value,
            originLong = document.getElementById("hdn_lngtd").value;
        const bounds = new google.maps.LatLngBounds();
        const markersArray = [];
        const origin1 = {lat: parseFloat(originLat), lng: parseFloat(originLong)};
        // console.log("Dest lat and long "+destinationLat+"-"+destinationLong);
        const origin2 = {lat: parseFloat(originLat), lng: parseFloat(originLong)};
        const destinationA = {lat: parseFloat(destinationLat), lng: parseFloat(destinationLong)};
        const destinationB = {lat: parseFloat(destinationLat), lng: parseFloat(destinationLong)};
        const destinationIcon =
            "https://chart.googleapis.com/chart?" +
            "chst=d_map_pin_letter&chld=D|FF0000|000000";
        const originIcon =
            "https://chart.googleapis.com/chart?" +
            "chst=d_map_pin_letter&chld=O|FFFF00|000000";
        const map = new google.maps.Map(document.getElementById("map"), {
            center: {lat: -1.9506937, lng: 30.1239912},
            zoom: 10,
        });
        const geocoder = new google.maps.Geocoder();
        const service = new google.maps.DistanceMatrixService();
        service.getDistanceMatrix(
            {
                origins: [origin1, origin2],
                // origins: [origin1, origin2],
                destinations: [destinationA, destinationB],
                // destinations: [destinationA, destinationB],
                travelMode: google.maps.TravelMode.DRIVING,
                unitSystem: google.maps.UnitSystem.METRIC,
                avoidHighways: false,
                avoidTolls: false,
            },
            (response, status) => {
                if (status !== "OK") {
                    alert("Error was: " + status);
                } else {
                    const originList = response.originAddresses;
                    const destinationList = response.destinationAddresses;
                    const outputDiv = document.getElementById("output");
                    outputDiv.innerHTML = "";
                    deleteMarkers(markersArray);

                    const showGeocodedAddressOnMap = function (asDestination) {
                        const icon = asDestination ? destinationIcon : originIcon;

                        return function (results, status) {
                            if (status === "OK") {
                                map.fitBounds(bounds.extend(results[0].geometry.location));
                                markersArray.push(
                                    new google.maps.Marker({
                                        map,
                                        position: results[0].geometry.location,
                                        icon: icon,
                                    })
                                );
                            } else {
                                allOfDistance = [null];
                            }
                        };
                    };

                    for (let i = 0; i < originList.length; i++) {
                        const results = response.rows[i].elements;
                        geocoder.geocode(
                            {address: originList[i]},
                            showGeocodedAddressOnMap(false)
                        );

                        for (let j = 0; j < results.length; j++) {
                            geocoder.geocode(
                                {address: destinationList[j]},
                                showGeocodedAddressOnMap(true)
                            );
                            //============================ KABAKA's Code
                            if (j == 1) {
                                //=======================ASUA' code
                                let el = document.getElementById("mapDistance");
                                let d = document.createElement("data");
                                let text = document.createTextNode(results[j].distance.text+"#"+originList[i]+"#"+destinationList[j]);
                                d.appendChild(text);
                                el.appendChild(d);
                                //count max element then if is last
                                let dataEl = el.childNodes, dataElCount = el.childElementCount;
                                if (dataElCount == el.getAttribute("max-elem")) readValues();

                                //============================END ASUA's CODES
                                //console.log(originList[i]+"=== Dest ==="+destinationList[j].toString());
                                outputDiv.innerHTML +=
                                    originList[i] +
                                    " to " +
                                    destinationList[j] +
                                    ": " +
                                    results[j].distance.text +
                                    " in " +
                                    results[j].duration.text +
                                    "<br>";
                                if (i == 0) {

                                    var originState = originList[0];
                                    var destinationState = destinationList[1];
                                    var distanceKm = results[1].distance.text;
                                    var durationTime = results[1].duration.text;

                                    allOfDistance = [originState, destinationState, distanceKm, durationTime];
                                    // console.log(allOfDistance);

                                }
                            }
                        }
                    }
                }
            }
        );
        return allOfDistance;
    }
}

function deleteMarkers(markersArray) {
    for (let i = 0; i < markersArray.length; i++) {
        markersArray[i].setMap(null);
    }
    markersArray = [];
}

var dataObj = [];
var changeRead = [];
function calculateProductDistance(){
    document.getElementById("mapDistance").setAttribute("max-elem", dataObj.length);
    for (var i = 0; i < dataObj.length; i++) {
        let obj = dataObj[i];
        // document.getElementById("googleresult").setAttribute("data-index", i);
        setTimeout((x,y) => initMap(x,y), 700,obj.user_latitude,obj.user_longitude);
    }
}


function readValues() {
    let el = document.getElementById("mapDistance").childNodes;
    let elCount = document.getElementById("mapDistance").childElementCount;

    for (let i = 0; i < el.length; i++) {
        let distanceData = el[i].innerHTML.split("#"),
            distance = distanceData[0],
            origin = distanceData[1],
            destination = distanceData[2];
        dataObj[i].client_current_location = origin;
        dataObj[i].product_seller_location = destination;
        dataObj[i].actual_distance = distance.substring(0,distance.length-3);
        dataObj[i].actual_distance_unit = distance.substring(distance.length-2,distance.length);
    }
    //bubble sort
    dataObj = bubbleSort(dataObj);
    setLoadedData(dataObj);
    console.log("Ordered data "+dataObj);

}
let bubbleSort = (arr) => {
    //Length of the array
    let n = arr.length;

    for(let i = 0; i < n - 1; i++){
        for(let j = 0; j < n - i - 1; j++){
            //Swap the numbers
            if(parseFloat(arr[j].actual_distance) > parseFloat(arr[j+1].actual_distance)){
                [arr[j], arr[j+1]] = [arr[j+1], arr[j]];
            }
        }
    }

    return arr;
}
var bubbleTestData = [
    {'actual_distance':12},
    {'actual_distance':82},
    {'actual_distance':9},
    {'actual_distance':21},
    {'actual_distance':51},
    {'actual_distance':32},
    {'actual_distance':12},
    {'actual_distance':43},
    {'actual_distance':82},
    {'actual_distance':32},
    {'actual_distance':12},
    {'actual_distance':19},
    {'actual_distance':42},
    {'actual_distance':39},
]

//Improve accuracy
