<template>
   <div style="padding: 2rem 3rem; text-align: left;">
        <h2>Tissue data file (.csv)</h2>
        <form>
            <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" id="dataFile" @change="previewFiles" accept="*">
            <label class="custom-file-label" for="customFile">{{fileName}}</label>
            </div>
            <div class="mt-3">
            <button type="button" @click="sendDataFile()" class="btn btn-primary">Upload</button>
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
            sendDataFile(){
                var inputFile = document.getElementById('dataFile');
                var file = inputFile.files[0];
                var data = new FormData();
                data.append('image', file);
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
