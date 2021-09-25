<template>
    <div>
        test
        <ul v-for="file in fileList" v-bind:key="file.id">
            <li>{{ file.id }}<img :src="'/api/file/'+file.id"></li>
        </ul>
    </div>
</template>

<script>
    import { defineComponent } from 'vue';

    export default defineComponent({
        data: function() {
            return {
                fileList: [{id: 1, path:"test"}, {id: 2, path:"test2"}],
            }
        },
        created: function() {
            const vm = this;
            axios.get('api/file', {})
                .then(function(response) {
                    console.log(vm.$data.fileList);
                    vm.$data.fileList = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                    // error 処理
                });
        },
    });
</script>
