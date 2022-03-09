<template>
    <div class="class-container">
        <div class="class-header">
            <div>
                Class Name: <b>{{ clas.name }}</b>
            </div>
        </div>
        <hr>
        <div class="student-list">
            <div class="view-button" v-if="showGetStudentBtn">
                <a style="cursor: pointer;" @click="getStudents">View students for {{ clas.name }}</a>
            </div>
            <div class="loading" v-if="isLoading">
                Loading...
            </div>
            <div v-if="!showGetStudentBtn">
                <template v-for="student in students">
                    <div class="student-profile">
                        <class-student :student="student"></class-student>
                    </div>
                </template>
            </div>
        </div>
    </div>
</template>
<script>
import moment from 'moment'
import classStudent from "./classStudent";

export default {
    props: ['clas', 'day'],
    name: 'class',
    components: {
        classStudent
    },
    data() {
        return {
            students: [],
            showGetStudentBtn: true,
            isLoading: false
        }
    },
    methods: {
        getStudents() {
            this.showGetStudentBtn = false
            this.isLoading = true
            axios.get('/class/' + this.clas.id + '/get-students')
                .then((res) => {
                    this.students = res.data.data
                    this.isLoading = false
                })
        }
    },
    computed: {
        findDayLesson() {
            return this.clas.lessons.data.filter((e) => {
                let date = new Date(e.start_at.date).toLocaleString('en-us', {weekday: 'long'});
                date.toString();
                if (date === this.day) {
                    return e.start_at + ' ' + e.end_at
                }
            })
        },
        //========================== Doesnt work for double periods ==========================//
        // startAt() {
        //     return new moment(this.findDayLesson[0].start_at.date).calendar()
        // },
        // endAt() {
        //     return new moment(this.findDayLesson[0].end_at.date).calendar()
        // },
    }

}
</script>
<style>
.class-header {
    display: flex;
    justify-content: space-between;
}

.class-container {
    background-color: white;
    padding: 10px;
    border-radius: 10px;
    margin-bottom: 20px;
}

.student-list {
    padding: 20px;
}

.view-button {
    display: flex;
    justify-content: center;
}

.loading {
    display: flex;
    justify-content: center;
}
</style>
