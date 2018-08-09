<template>
    <div style="display: inline-block">
        <button v-on:click="showModal">+Add Assignment</button>

        <modal name="createAssignment" :draggable="true">
            <h2>Create New Assignment</h2>

            <form v-on:submit.prevent="submitAssignment" method="post">
                Assignment Name: <input type="text" name="assignmentName" v-model="assignmentName">

                <select v-model="sectionID" v-on:change="setAssignmentUri()">
                    <option value="" selected disabled>Select Section</option>
                    <option v-for="rows in modalData" :value="rows.section.id">{{ rows.section.name }}</option>
                </select><br><br>

                Max Score: <input type="text" name="maxScore" v-model="assignmentMaxScore">
                Achieved Score: <input type="text" name="achievedScore" v-model="assignmentAchievedScore"><br>

                <div style="color: red" v-for="errors in displayErrors">
                    {{errors}}<br>
                </div><br>

                <input type="submit" value="Save">
            </form>
            <br>

            <button v-on:click="hideModal">Close</button>
        </modal>
    </div>
</template>

<script>
    import Errors from './Errors';

    export default {
        data: function(){
            return{
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                sectionID: '',
                newAssignmentURI: '/api/classes/details/assignments/0',
                displayErrors: [],
                assignmentName: '',
                assignmentMaxScore: '',
                assignmentAchievedScore: '',
            }
        },
        props: {
            modalData: {}
        },
        methods: {
            setAssignmentUri(){
                this.newAssignmentURI = '/api/classes/details/assignments/' + this.sectionID;
            },
            showModal () {
                this.$modal.show('createAssignment');
            },
            hideModal () {
                this.$modal.hide('createAssignment');
            },
            submitAssignment() {
                let uri = this.newAssignmentURI;
                this.axios.post(uri, {
                    'assignmentName': this.assignmentName,
                    'sectionID': this.sectionID,
                    'maxScore': this.assignmentMaxScore,
                    'achievedScore': this.assignmentAchievedScore,
                    headers: {
                        'csrf': this.csrf
                    }
                }).then((response) => {
                    if(response.data == "OK") {
                        this.$emit('updateTable');
                        this.hideModal();
                    }
                    else {
                        this.displayErrors = response.data;
                    }
                });
            }
        },
        components: {
            Errors
        }
    }
</script>