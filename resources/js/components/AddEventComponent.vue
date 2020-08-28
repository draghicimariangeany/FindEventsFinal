<template>
    <div>
        <gmap-map   :center="{lat:1.38, lng:103.8}"
                    :zoom="7"
                    style="width: 500px; height: 300px"
                    @click="onClickMap"
        >
        <GmapMarker ref="myMarker"
                    :position="google && new google.maps.LatLng(1.38, 103.8)"
                    @click="onClickMarker"
                    :clickable="true"
        />
            <GmapMarker ref="myMarker"
                        :position="marker"
                        @click="onClickMarker"
                        :clickable="true"
            />



        </gmap-map>

        <add-event-form :myCoordinates="coordinates"></add-event-form>
    </div>


</template>
<script>

import AddEventForm from "./AddEventForm";

import {gmapApi} from 'vue2-google-maps'
import GmapCustomMarker from 'vue2-gmap-custom-marker';
export default {
    data() {
        return {
            coordinates: {lat: 0.0, lng: 0.0},
            marker: {
                lat: 0.0,lng: 0.0
            }
        }
    },

    computed: {
        google: gmapApi
    },

    methods: {
        onClickMarker(location) {
            this.coordinates = {
                lat: location.latLng.lat(),
                lng: location.latLng.lng(),
            };

            console.log(this.coordinates.lat + '/' + this.coordinates.lng);
        },
        onClickMap(location) {
            this.coordinates = {
                lat: location.latLng.lat(),
                lng: location.latLng.lng(),
            };

            this.marker = this.coordinates;

        },
    },
    components: {
        'gmap-custom-marker': GmapCustomMarker,
        AddEventForm
    }
}

</script>
