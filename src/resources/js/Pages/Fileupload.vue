<template>
    <div>
        <Head title="Welcome" />
        <p><input type="file" v-on:change="fileSelected"></p>
        <button v-on:click="fileUpload">アップロード</button>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        data: function() {
            return {
                fileInfo: "",
            };
        },
        components: {
            Head,
            Link,
        },
        methods: {
            fileUpload(){
                const formData = new FormData()

                formData.append('file',this.fileInfo)

                axios.post('/api/fileupload',formData).then(response =>{
                    console.log(response)
                });
            }
        }
    })
</script>
