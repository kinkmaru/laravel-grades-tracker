<template>
    <div>
        <button v-on:click="showModal">+ Add Class</button>

        <modal name="createClass" :draggable="true">
            <h2>Add a Class</h2>
            <form v-on:submit.prevent="submitClass" method="post">
                Class Name: <input type="text" name="className" v-model="className">
                Target Grade: <input type="text" name="classTargetGrade" v-model="classTargetGrade"><br><br>
                <Errors
                    :errors="displayErrors">
                </Errors>
                <input type="submit" value="Add Class">
            </form>
            <br>

            <button v-on:click="closeModal">Cancel</button>
        </modal>

    </div>


</template>

<script>
    import Errors from './Errors.vue';

    export default{
        data: function(){
            return{
                displayErrors: [],
                counter: {},
                className: '',
                classTargetGrade: '',
                errors: [],
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },
        methods: {
            submitClass () {
                let uri = '/api/classes';
                this.axios.post(uri, {
                    'className': this.className,
                    'classTargetGrade': this.classTargetGrade,
                     headers: {
                            'csrf': this.csrf
                        }
                }).then((response) => {
                    if(response.data == "OK") {
                        this.$emit('updateTable', response.data);
                        this.hideModal();
                    }
                    else {
                        this.displayErrors = response.data;
                    }
                });
            },
            showModal () {
                this.$modal.show('createClass');
            },
            hideModal () {
                this.$modal.hide('createClass');
            },
            closeModal () {
                this.hideModal();
            },
            clearErrors() {
                this.displayErrors = [];
            },
        },
        components: {
            Errors
        }
    }
</script>