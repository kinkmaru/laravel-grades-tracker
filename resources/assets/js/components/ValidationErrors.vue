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
                this.displayErrors = [];
                let errors = this.errors;
                let count = 0;
                for (let error in errors)
                {
                    this.displayErrors.push (errors[error][0]);
                    count++;
                }
            }
        }
    }
</script>