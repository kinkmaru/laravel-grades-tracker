<template>
    <div>
        <h1>Edit Class: <b>{{initialDisplayName}}</b></h1>
        <form v-on:submit.prevent="submitEdit" method="post">
            <input type="hidden" name="_method" value="patch">
            <input type="hidden" name="_token" :value="csrf">

            Name: <input type="text" name="className" v-model="submitName"><br>
            Target Grade: <input type="text" name="classTargetGrade" v-model="submitTargetGrade"><br>

            <errorComponent :errors="displayErrors"></errorComponent>

            <button type="submit">Save</button>
        </form>
    </div>

</template>

<script>
    import errorComponent from './Errors.vue';

    export default {
        data:
            function() {
                return{
                    csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    submitName: '',
                    submitTargetGrade: '',
                    initialDisplayName: '',
                    displayErrors: [],
                    classID: ''
                }
            },
        props: {
            formText: {}
        },
        created: function () {
            this.setInitialValues(this.formText);
        },
        methods: {
            setInitialValues(data){
                this.initialDisplayName = data['name'];
                this.submitName = data['name'];
                this.submitTargetGrade = data['target_grade'];
                this.classID = data['id'];
            },
            submitEdit(){
                let uri = '/api/classes/' + this.classID;
                this.axios.patch(uri, {
                    'className': this.submitName,
                    'classTargetGrade': this.submitTargetGrade,
                    headers: {
                        'csrf': this.csrf
                    }
                }).then((response)=> {
                    if(response.data == 'OK')
                        this.$emit('editSuccess');
                    else
                        this.displayErrors = response.data;
                });
            }
        },
        components: {
            errorComponent
        }
    }
</script>