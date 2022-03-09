<template>
    <div class="pagination-section">
        <div class="pagination-list">
            <div @click="goToPrevPage" class="pagination-item">
                Prev
            </div>
            <template v-for="i in 12">
                <div @click="changePage(i)" class="pagination-item" :class="{'active-item': i === meta.current_page}">
                    {{ i }}
                </div>
            </template>
            <div @click="goToNextPage" class="pagination-item">
                Next
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "paginate",
    props: ['meta'],
    methods: {
        changePage(index) {
            this.$parent.filters.page = index
            this.$parent.getTeachers();
        },
        goToNextPage() {
            this.$parent.filters.page = this.nextPage
            this.$parent.getTeachers();
        },
        goToPrevPage() {
            this.$parent.filters.page = this.prevPage
            this.$parent.getTeachers();
        }
    },
    computed: {
        //get next page in pagination
        nextPage() {
            const params = new URLSearchParams(this.meta.next);
            return params.get('page');
        },
        //get previous page in pagination
        prevPage() {
            const params = new URLSearchParams(this.meta.previous);
            return params.get('page');
        }
    }
}
</script>
<style>
.pagination-section {
    display: flex;
    justify-content: center;
    margin: 40px;
}

.pagination-list {
    display: flex;
    flex-direction: row;
}

.pagination-item {
    padding: 10px;
    background-color: white;
    cursor: pointer;
    margin: 3px;
}

.active-item {
    background-color: #3780d7;
}
</style>
