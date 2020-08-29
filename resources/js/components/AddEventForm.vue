<template>
    <div>

        <div class="mt-2" >Event Pin Coordinates: Latitude - {{ myCoordinates.lat.toFixed(5) }}, Longitude - {{ myCoordinates.lng.toFixed(5) }}</div>

    </div>
</template>

<script>


export default {
    data() {
        return {
            text: '',
        }
    },
    props: ['myCoordinates']




}
</script>
