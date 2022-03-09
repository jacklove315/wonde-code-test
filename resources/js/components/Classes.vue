<template>
    <div class="form-container">
        <div class="teacher-name">
            {{ name }}'s weekly class list
        </div>
        <div v-if="classes">
            <template v-for="(day, index) in classes">
                <!-- single day section -->
                <div class="day-pane">
                    <div style="padding-bottom: 10px" class="header">
                        {{ index }} Classes
                    </div>
                    <!-- looping out all classes in a day into their own component-->
                    <template v-for="classes in day">
                        <class :clas="classes" :day="index"></class>
                    </template>
                </div>
            </template>
        </div>
    </div>
</template>
<script>
import Class from "./Class";

export default {
    name: "classes",
    props: ['classes', 'name'],
    components: {
        Class
    },
    mounted() {
        // axios.get('/get-teachers')
        //     .then((res) => {
        //         this.teachers = res.data.data
        //         this.isLoading = false;
        //     })
    },
    computed: {
        //------------------------------- My original attempt at filtering data into week days -------------------------------//
        // weekdays() {
        //     let Monday = []
        //     let Tuesday = []
        //     let Wednesday = []
        //     let Thursday = []
        //     let Friday = []
        //
        //     //loop through each class and its lessons -
        //     // if a class has a lesson on particular day push it to the day specific array
        //     this.teacher.classes.data.forEach((e) => {
        //         e.lessons.data.forEach((x) => {
        //             let date = new Date(x.start_at.date);
        //             if (date.getDay() === 1) {
        //                 if (Monday.filter(d => d.description === e.description).length > 0) {
        //                     return false;
        //                 } else {
        //                     Monday.push(e)
        //                 }
        //             } else if (date.getDay() === 2) {
        //                 if (Tuesday.filter(d => d.description === e.description).length > 0) {
        //                     return false;
        //                 } else {
        //                     Tuesday.push(e)
        //                 }
        //             } else if (date.getDay() === 3) {
        //                 if (Wednesday.filter(d => d.description === e.description).length > 0) {
        //                     return false;
        //                 } else {
        //                     Wednesday.push(e)
        //                 }
        //             } else if (date.getDay() === 4) {
        //                 if (Thursday.filter(d => d.description === e.description).length > 0) {
        //                     return false;
        //                 } else {
        //                     Thursday.push(e)
        //                 }
        //             } else if (date.getDay() === 5) {
        //                 if (Friday.filter(d => d.description === e.description).length > 0) {
        //                     return false;
        //                 } else {
        //                     Friday.push(e)
        //                 }
        //             }
        //         })
        //     })
        //     return {Monday, Tuesday, Wednesday, Thursday, Friday}
        // }
    },
}
</script>
<style>
.form-container {
    margin-top: 25px;
}

.day-pane {
    background-color: #d9d9d9;
    margin-bottom: 40px;
    padding: 10px;
    border-radius: 10px;
}

.teacher-name {
    display: flex;
    justify-content: center;
    padding: 20px;
    font-weight: bold;
    font-size: 20px;
    color: var(--vr-blue-primary);
}
</style>
