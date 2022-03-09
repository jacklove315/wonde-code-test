<template>
    <div style="padding: 5px">
        <div style="cursor: pointer;" @click="getExtendedDetails">
            {{ student.forename }} {{ student.surname }}
        </div>
        <div class="extended-details" v-if="showExtended">
            Extended Details - {{ student.forename }} {{ student.surname }}
            <hr>
            <b v-if="extendedDetails">
                dietary needs {{ extendedDetails['dietary_needs'] ? extendedDetails['dietary_needs'] : 'N/a'}}
                <br>
                first language {{ extendedDetails['first_language'] ? extendedDetails['first_language'] : 'N/a' }}
                <br>
                free school meals {{ extendedDetails['free_school_meals'] ? extendedDetails['free_school_meals'] : 'N/a' }}
                <br>
                in care details {{ extendedDetails['in_care_details'] ? extendedDetails['in_care_details'] : 'N/a' }}
                <br>
                paramedical support {{ extendedDetails['paramedical_support'] ? extendedDetails['paramedical_support'] : 'N/a' }}
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
            showExtended: false
        }
    },
    methods: {
        getExtendedDetails() {
            axios.get('/students/' + this.student.id + '/extended-details')
                .then((res) => {
                    this.extendedDetails = res.data.extended_details.data;
                    this.showExtended = true
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
