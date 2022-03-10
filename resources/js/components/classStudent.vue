<template>
    <div style="padding: 5px">
        <div style="cursor: pointer;" @click="getExtendedDetails">
            {{ student.forename }} {{ student.surname }} <span style="font-size: 11px">- details</span>
        </div>
        <div style="font-size: 11px" v-if="isLoading">
            Loading...
        </div>
        <div class="extended-details" v-if="showExtended">
            Extended Details - {{ student.forename }} {{ student.surname }}
            <hr>
            <b v-if="extendedDetails">
                dietary needs: {{ extendedDetails['dietary_needs'] ? extendedDetails['dietary_needs'] : '-'}}
                <br>
                first language: {{ extendedDetails['first_language'] ? extendedDetails['first_language'] : '-' }}
                <br>
                free school meals: {{ extendedDetails['free_school_meals'] ? extendedDetails['free_school_meals'] : '-' }}
                <br>
                in care details: {{ extendedDetails['in_care_details'] ? extendedDetails['in_care_details'] : '-' }}
                <br>
                paramedical support: {{ extendedDetails['paramedical_support'] ? extendedDetails['paramedical_support'] : '-' }}
                <br>
            </b>
        </div>
    </div>
</template>
<script>
export default {
    props: ['student'],
    name: "class-student",
    data() {
        return {
            extendedDetails: null,
            showExtended: false,
            isLoading: false
        }
    },
    methods: {
        getExtendedDetails() {
            this.isLoading = true
            axios.get('/students/' + this.student.id + '/extended-details')
                .then((res) => {
                    this.extendedDetails = res.data.extended_details.data;
                    this.showExtended = true
                    this.isLoading = false
                })
        }
    },
}
</script>
<style>
.extended-details {
    background-color: #c8c8c8;
    margin: 10px;
    padding: 10px;
    font-size: 12px;
}
</style>
