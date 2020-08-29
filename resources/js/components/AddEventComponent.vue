<template>
    <div>
        <gmap-map   :center="centerMap"
                    :zoom="7"
                    style="width: 500px; height: 300px"
                    @click="onClickMap"
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

<!--        <div>-->
<!--            <h1>My Weather App</h1>-->
<!--            <button v-on:click="getWeatherData">Get Weather Data</button>-->
<!--            <div v-for="weatherData in weatherDataList" :key="weatherData.id">-->
<!--                <div>-->
<!--                    <div>-->
<!--                        <span>{{weatherData.city}}</span>-->
<!--                    </div>-->
<!--                    <div>-->
<!--                        <span>{{weatherData.lat}}</span>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

        <div class="pt-3">
            <h3>Select a city to go there</h3>
            <select @change="selectEvent" v-model="selectedCity">
                <option v-for="city in myJson" :value="city">{{city.city}}</option>
            </select>
            <hr>
            Map Coordinates: Latitude: {{selectedCity.lat}}, Longitude {{selectedCity.lng}}
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
