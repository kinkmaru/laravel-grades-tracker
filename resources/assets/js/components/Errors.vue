<template>
    <div>
        <div style="color: red" v-for="error in displayErrors">
            {{error}}<br>
        </div><br>
    </div>
</template>

<script>
    export default {
        data: function(){
            return{
                displayErrors: []
            }
        },
        props: {
            errors: {}
        },
        watch: {
            errors: function(){
                debugger;
                let test = '';
                this.displayErrors = [];
                let errors = this.errors;
                let count = 0;
                for (let error in errors)
                {
                    this.displayErrors[count] = errors[error];
                    count++;
                }
            }
        }
    }
</script>