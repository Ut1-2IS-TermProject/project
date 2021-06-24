<template>
   <div style="padding: 2rem 3rem; text-align: left;">
        <h2>Tissue image file</h2>
        <form>
            <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" id="imageFile" @change="previewFiles">
            <label class="custom-file-label" for="customFile">{{fileName}}</label>
            </div>
            <div class="mt-3">
            <button type="button" @click="sendImageFile()" class="btn btn-primary">Upload</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['clickedNext', 'currentStep'],
        data() {
            return {
                fileName: "Choose file"
            }
        },
        watch: {
            clickedNext(val) {
                
            }
        },
        mounted() {
            this.$emit('can-continue', {value: false});
        },
        methods:{
            previewFiles(event) {
                console.log(event.target.files);
                if (event.target.files.length > 0){
                    var file = event.target.files[0];
                    this.fileName = file.name;
                }
            },
            sendImageFile(){
                var inputFile = document.getElementById('imageFile');
                var file = inputFile.files[0];
                var data = new FormData();
                data.append('file', file);
                data.append('file_name', 'image.nrrd');
                $.ajax({
                    url: "/file/upload",
                    type: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: ((response)=>{
                        if (response == true){
                            this.$emit('can-continue', {value: true});
                        }
                    }),
                    error:function(response){
                        console.log(response); 
                    }
                });
            }
        }
    }
</script>
