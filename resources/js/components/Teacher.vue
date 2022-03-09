<template>
    <a :href="'/teacher/' + teacher.id + '/classes'">
        <div class="teacher">
            {{ teacherName }}
        </div>
    </a>
</template>
<script>
export default {
    props: ['teacher'],
    name: "teacher",
    computed: {
        teacherName() {
            return this.teacher.title + ' ' + this.teacher.legal_forename + ' ' + this.teacher.legal_surname
        }
    }
}
</script>
<style>
.teacher {
    background-color: white;
    padding: 20px;
    border-radius: 15px;
    margin-bottom: 10px;
    cursor: pointer;
}
.teacher:hover {
    background-color: var(--vr-blue-primary);
    color: white;
}
a {
    text-decoration: none;
    color: inherit;
}
</style>
