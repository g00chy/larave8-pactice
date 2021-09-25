<template>
    <div>
        <Head title="Welcome" />
        <input @change="selectedFile" type="file" name="file">
        <button-vue @click="upload" type="submit">アップロード</button-vue>
        <list-vue ref="list"></list-vue>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import ListVue from '@/Pages/S3/List.vue';
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import ButtonVue from '../Jetstream/Button.vue';

    export default defineComponent({
        data: function() {
            return {
            };
        },
        components: {
            Head,
            Link,
            ListVue,
            ButtonVue,
        },
        methods: {
            selectedFile: function(e) {
                // 選択された File の情報を保存しておく
                e.preventDefault();
                let files = e.target.files;
                this.uploadFile = files[0];
            },
            upload: function() {
                const vm = this;
                // FormData を利用して File を POST する
                let formData = new FormData();
                formData.append('file', this.uploadFile);
                let config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                };
                axios
                    .post('api/file', formData, config)
                    .then(function(response) {
                        console.log(vm.$refs);
                        vm.$refs.list.refreshList();
                    })
                    .catch(function(error) {
                        // error 処理
                    })
            },
        }
    })
</script>
