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

        <h3 class="pt-3">Select a city to go there:</h3>

        <select class="form-control" @change="changeCity($event)">
            <option value="" selected disabled>Choose</option>
            <option v-for="(p, city) in myJson" :key="city" :value="p.City">{{ p.City }}</option>
            <span>{{city.lng}}</span>
            <span>{{city.lat}}</span>
        </select>
        <br><br>

        <add-event-form :myCoordinates="coordinates"></add-event-form>
    </div>


</template>
<script>

import AddEventForm from "./AddEventForm";
import {gmapApi} from 'vue2-google-maps'
import GmapCustomMarker from 'vue2-gmap-custom-marker';
import Axios from "axios";
import MY_JSON from '../../../public/json/cities.json'
export default {
    data: function (){
        return {
            coordinates: {lat: 0.0, lng: 0.0},
            marker: {
                lat: 0.0,lng: 0.0
            },
            model: '',
            myJson : MY_JSON,
            selectedCity: null,
            city: {lat: 0.0, lng:0.0}
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
        changeCity (event) {
            this.selectedCity = event.target.options[event.target.options.selectedIndex].text
            console.log(event.target.options[event.target.options.selectedIndex]);
        }
    },
    components: {
        'gmap-custom-marker': GmapCustomMarker,
        AddEventForm,

    }


}

</script>
