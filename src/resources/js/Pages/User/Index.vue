<template>
    <div class="p-4">
        <h1 class="text-lg font-bold">ユーザ一覧</h1>
        <ul>
            <li v-for="user in users" :key="user.id">{{ user.name }}</li>
        </ul>
    </div>
</template>
<script>
    export default {
        props:{
            users: {
                type: Array,
            }
        }
    }
</script>
