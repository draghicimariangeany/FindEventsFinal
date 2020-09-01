<template>
    <div>
        <form @submit.prevent="handleSubmit">
            <div class="form-group">
                <div class="mt-2 h5" >Event Pin Coordinates: <small class="text-muted h5">Latitude - {{ myCoordinates.lat.toFixed(5) }}</small>, <small class="text-muted h5">Longitude - {{ myCoordinates.lng.toFixed(5) }}</small></div>


                <div class="form-group">
                    <input type="hidden" v-model="lat" id="lat" name="lat" class="form-control" :class="{ 'is-invalid': submitted && $v.lat.$error }" />
                    <div v-if="submitted && !$v.lat.required" class="invalid-feedback"><h6>Coordinates are required!</h6></div>
                </div>

                <div class="form-group">
                    <label class="h5">Name</label>

                    <b-form-input id="eventName" name="eventName" v-model="eventName" placeholder="Event Name" :class="{ 'is-invalid': submitted && $v.eventName.$error }"></b-form-input>
                    <div v-if="submitted && !$v.eventName.required" class="invalid-feedback">Event name is required</div>

                </div>
                <div class="form-group">
                    <label class="h5">Choose a date</label>
                    <b-form-datepicker id="eventDate" name="eventDate"v-model="eventDate" class="mb-2" :class="{ 'is-invalid': submitted && $v.eventDate.$error }"></b-form-datepicker>
                    <div v-if="submitted && !$v.eventDate.required" class="invalid-feedback">Event Date is required</div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="h5">Event <b>start</b> at:</label>
                            <b-form-timepicker id="eventStart_at" name="eventStart_at" v-model="eventStart_at" locale="ro" :class="{ 'is-invalid': submitted && $v.eventStart_at.$error }"></b-form-timepicker>
                            <div v-if="submitted && !$v.eventStart_at.required" class="invalid-feedback">Event start time is required</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="h5">Event <b>end</b> at:</label>
                            <b-form-timepicker id="eventEnd_at" name="eventEnd_at" v-model="eventEnd_at" locale="ro" :class="{ 'is-invalid': submitted && $v.eventEnd_at.$error }"></b-form-timepicker>
                            <div v-if="submitted && !$v.eventEnd_at.required" class="invalid-feedback">Event end time is required</div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="form-group">
                        <button class="btn btn-primary">Add Event</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>

import { required, email, minLength, sameAs } from "vuelidate/lib/validators";

export default {
    data() {
        return {
            text: '',
            eventName: '',
            eventDate: '',
            eventStart_at: '',
            eventEnd_at: '',
            lat: '',
            lng: '',
            submitted: false
        }
    },

    validations: {
            eventName: { required },
            eventDate: {required},
            eventStart_at: {required},
            eventEnd_at: {required},
            lat: {required},
            lng: {required}

    },

    props: ['myCoordinates','mySelectedCity'],
    methods: {
        handleSubmit(e) {
            this.submitted = true;

            if(this.myCoordinates.lat !== 0.0 && this.myCoordinates.lng !== 0.0) {
                this.lat = this.myCoordinates.lat;
                this.lng = this.myCoordinates.lng;
            }

            // stop here if form is invalid
            this.$v.$touch();
            if (this.$v.$invalid) {
                return;
            }




            axios.post('/createevent',{name: this.eventName, date: this.eventDate,
                start_at: this.eventStart_at, end_at: this.eventEnd_at,
                lat: this.lat, lng: this.lng});

        }
    }




}
</script>
