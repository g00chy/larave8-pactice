<template>
    <div>
        url base download:
        <input type="text" v-on:bind="changed">
    </div>
</template>

<script>
    import { defineComponent } from 'vue';
    export default defineComponent({
        data:() => {
            return {
                url: "",
            }
        },
        methods: {
            changed: function(event) {
                const vm = this;
                // FormData を利用して File を POST する
                let formData = new FormData();
                formData.append('file', event.target.value);
                axios
                    .post('api/file/getUrl', formData, config)
                    .then(function(response) {
                        vm.$refs.list.refreshList();
                    })
                    .catch(function(error) {
                        // error 処理
                    })
            },
        }
    });
</script>
