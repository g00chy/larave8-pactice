<template>
    <div>
        <h3> File List </h3>
        <ul v-for="file in fileList" v-bind:key="file.id">
            <li>
                {{ file.id }}
                <danger-button @click="this.delete(file.id)">delete</danger-button>
                <img :src="'/api/file/'+file.id">
            </li>
        </ul>
    </div>
</template>

<script>
    import { defineComponent } from 'vue';
    import DangerButton from '../../Jetstream/DangerButton.vue';

    function refreshList(vm) {
        axios.get('api/file', {})
            .then(function(response) {
                console.log(vm.$data.fileList);
                vm.$data.fileList = response.data;
            })
            .catch(function(error) {
                console.log(error);
                // error 処理
            });
    }

    export default defineComponent({
        components: {
            DangerButton,
        },
        data: function() {
            return {
                fileList: [],
            }
        },
        created: function() {
            const vm = this;
            refreshList(vm);
        },
        methods: {
            delete: function(e) {
                const vm = this;
                axios.delete('api/file/' + e)
                .then(function(response) {
                    refreshList(vm);
                });
            },
            refreshList: function() {
                const vm = this;
                refreshList(vm);
            }
        }
    });
</script>
