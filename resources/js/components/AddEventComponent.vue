<template>
    <div>
        <gmap-map   :center="centerMap"
                    :zoom="centerZoom"
                    style="width: 100%; height: 450px"
                    @rightclick="onClickMap"
        >
        <GmapMarker ref="myMarker"
                    :position="currentPositionMarker"
                    @click="onClickMarker"
                    :clickable="true"
        />

        <gmap-custom-marker :marker="marker" @click.native="onClickMarker">
            <img src="images/eventIcon.png" style="max-height: 30px; max-width: 30px"/>
        </gmap-custom-marker>


        </gmap-map>

        <div class="form-group">
            <label class="h5 pt-3">Select a city to go there:</label>
                <select class="form-control shadow p-2 mb-3" @change="selectEvent" v-model="selectedCity">
                    <option v-for="city in myJson" :value="city">{{city.city}}</option>
                </select>

        </div>


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
            centerZoom : 7,
            selectedCity: {
                lat: 0.0,
                lng: 0.0
            },
            centerMap: {
                lat: 10,
                lng: 10
            },
            currentPositionMarker: {
                lat: 0.0,
                lng: 0.0
            }

        }
    },

    computed: {
        google: gmapApi,
        options(){
            return Object.keys(this.myJson).map(k => {
                let o = this.myJson[k]
                return `${o.city} ${o.lat} ${o.lng}`
            })
        }
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
        selectEvent: function () {
            this.centerMap.lat = parseFloat(this.selectedCity.lat);
            this.centerMap.lng = parseFloat(this.selectedCity.lng);

            this.centerZoom = 8;
        },
        geolocation : function() {
            navigator.geolocation.getCurrentPosition((position) => {
                this.centerMap = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                this.currentPositionMarker.lat = position.coords.latitude;
                this.currentPositionMarker.lng = position.coords.longitude;
            });
        }

    },
    components: {
        'gmap-custom-marker': GmapCustomMarker,
        AddEventForm,


    },
    mounted : function() {
        this.geolocation();
    }


}

</script>
