<template>
    <div class="form-container">
        <div v-if="isLoading" class="loader-container">
            Loading...
        </div>
        <div class="select-teacher" v-if="!isLoading">
            Select a Teacher
        </div>
        <!-- wait for loading to complete -->
        <div v-if="!isLoading">
            <template v-for="teacher in teachers">
                <teacher :teacher="teacher"></teacher>
            </template>
        </div>
        <paginate v-if="!isLoading" :meta="paginationObject"></paginate>
    </div>
</template>
<script>
import Teacher from "./Teacher";
import Paginate from "./utils/Paginate";

export default {
    name: "main-comp",
    data() {
        return {
            isLoading: true,
            teachers: null,
            paginationObject: null,
            filters: {
                page: 1,
                query: ''
            }
        }
    },
    mounted() {
        this.getTeachers();
    },
    methods: {
        //Fetch teachers to be displayed
        getTeachers() {
            axios.get('/get-teachers', {
                params: this.filters
            })
                .then((res) => {
                    this.teachers = res.data.data
                    this.paginationObject = res.data.meta.pagination
                    this.isLoading = false;
                })
        },
        search() {
            this.getTeachers()
        }
    },
    components: {
        Teacher,
        Paginate
    }
}
</script>
<style scoped>
.form-container {
    margin-top: 25px;
}

.teacher-select {
    width: 50%;
}

.loader-container {
    margin: 100px;
    display: flex;
    justify-content: center;
}

.loader-container img {
    width: 60px;
    height: 60px;
}

.select-teacher {
    display: flex;
    justify-content: center;
    margin: 10px;
    font-weight: bold;
}
</style>
