<template>
    <div>

        <div class="form-group">
            <div class="mt-2 h5" >Event Pin Coordinates: <small class="text-muted h5">Latitude - {{ myCoordinates.lat.toFixed(5) }}</small>, <small class="text-muted h5">Longitude - {{ myCoordinates.lng.toFixed(5) }}</small></div>

            <div class="form-group">
                <label class="h5">Name</label>

                <b-form-input v-model="name" placeholder="Event Name"></b-form-input>
            </div>
            <div class="form-group">
                <label class="h5">Choose a date</label>
                <b-form-datepicker id="example-datepicker" v-model="date" class="mb-2"></b-form-datepicker>

            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="h5">Event <b>start</b> at:</label>
                        <b-form-timepicker v-model="start_at" locale="ro"></b-form-timepicker>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="example-datepicker" class="h5">Event <b>end</b> at:</label>
                        <b-form-timepicker v-model="end_at" locale="ro"></b-form-timepicker>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <b-button @click="addNewEvent" style="width: 25%" type="submit" variant="primary">Add Event</b-button>
            </div>
        </div>
    </div>
</template>

<script>


export default {
    data() {
        return {
            text: '',
            name: '',
            date: '',
            start_at: '',
            end_at: ''
        }
    },
    props: ['myCoordinates','mySelectedCity'],
    methods: {
        addNewEvent(){

            axios.post('/createevent',{name: this.name, date: this.date,
                start_at: this.start_at, end_at: this.end_at,
                lat: this.myCoordinates.lat, lng: this.myCoordinates.lng})
                .then((response)=>{

                    console.log();

                })
        }
    }




}
</script>
