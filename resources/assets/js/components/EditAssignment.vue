<template>
    <div>
        <h1>Edit Class: <b>{{initialDisplayName}}</b></h1>
        <form v-on:submit.prevent="submitEdit" method="post">
            <input type="hidden" name="_method" value="patch">
            <input type="hidden" name="_token" :value="csrf">

            Assignment Name: <input type="text" name="assignmentName" v-model="submitName"><br>
            Max Score: <input type="text" name="maxScore" v-model="submitMaxScore"><br>
            Achieved Score: <input type="text" name="achievedScore" v-model="submitAchievedScore"><br>

            <errorComponent :errors="displayErrors"></errorComponent>

            <button type="submit">Save</button>
        </form>
    </div>

</template>

<script>
    import errorComponent from './ValidationErrors.vue';

    export default {
        data:
            function() {
                return{
                    csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    submitName: '',
                    submitMaxScore: '',
                    submitAchievedScore: '',
                    initialDisplayName: '',
                    sectionID: '',
                    assignmentID: '',
                    displayErrors: [],
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
                this.submitMaxScore = data['max_score'];
                this.submitAchievedScore = data['achieved_score'];
                this.assignmentID = data['id'];
            },
            submitEdit(){
                let uri = '/api/classes/details/assignments/' + this.assignmentID;
                this.axios.patch(uri, {
                    'assignmentName': this.submitName,
                    'maxScore': this.submitMaxScore,
                    'achievedScore': this.submitAchievedScore,
                    headers: {
                        'csrf': this.csrf
                    }
                }).then((response)=> {
                    if(response.data === 'OK')
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