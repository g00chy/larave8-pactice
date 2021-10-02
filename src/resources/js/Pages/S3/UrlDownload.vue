<template>
    <div>
        url base download:
        <input type="text" v-model="url">
        <button-vue v-on:click="changed">Download</button-vue>
    </div>
</template>

<script>
    import { defineComponent } from 'vue';
    import ButtonVue from '../../Jetstream/Button.vue';
    export default defineComponent({
    components: { ButtonVue },
        data:() => {
            return {
                url: "",
            }
        },
        methods: {
            changed: function() {
                const vm = this;
                // FormData を利用して File を POST する
                let formData = new FormData();
                formData.append('url', vm.$data.url);
                axios
                    .post('api/file/geturl', formData, {})
                    .then(function(response) {
                        setTimeOut(function(vm) {
                            vm.$emit('close');
                        }, 200);
                    })
                    .catch(function(error) {
                        // error 処理
                        console.log('error');
                    })
            },
        }
    });
</script>
